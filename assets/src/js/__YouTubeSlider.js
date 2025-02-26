import 'slick-carousel';
import $ from "jquery";

// youtube_api_key = AIzaSyAmv-a8SXP2ckayL-RawlIGSR6VA4oS3-E

function loadYouTubeAPI(callback) {
    if (typeof YT === 'undefined' || typeof YT.Player === 'undefined') {
        let script = document.createElement('script');
        script.src = "https://www.youtube.com/iframe_api";
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);

        window.onYouTubeIframeAPIReady = function () {
            console.log("YouTube API Loaded!");
            if (callback) callback();
        };
    } else {
        if (callback) callback();
    }
}


export async function fetchYouTubeShorts(sliderContainer) {

    if (!sliderContainer) {
        console.error(`Error: sliderContainer not found in the DOM.`);
        return;
    }

    const youtubePlaylistId = sliderContainer.dataset.youtubePlaylist;
    const youtubeApiKey = document.body.dataset.youtubeApiKey;

    if (!youtubePlaylistId || !youtubeApiKey) {
        console.error("YouTube API Key or Playlist ID is missing.");
        return;
    }

    try {
        // console.log("Fetching YouTube API...");
        loadYouTubeAPI(() => console.log("YouTube API Loaded"));

        const response = await fetch(
            `https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=10&playlistId=${youtubePlaylistId}&key=${youtubeApiKey}`
        );

        if (!response.ok) throw new Error(`Failed to fetch YouTube videos: ${response.statusText}`);

        const data = await response.json();
        addVideosToSlider(data.items, sliderContainer);
    } catch (error) {
        console.error("Error fetching YouTube videos:", error);
    }
}

function waitForElement(selector, callback) {
    const observer = new MutationObserver((mutations, observer) => {
        document.querySelectorAll(selector).forEach(element => {
            observer.disconnect();
            callback(element);
        });
    });
    observer.observe(document.body, {childList: true, subtree: true});
}

function addVideosToSlider(videos, sliderContainer) {
    sliderContainer.innerHTML = "";
    videos.forEach(video => {
        const videoId = video.snippet.resourceId?.videoId;
        if (!videoId) return;

        const slide = document.createElement("div");
        slide.classList.add("youtube-slide");
        slide.setAttribute("data-video-id", videoId);
        slide.innerHTML = `
            <div class="youtube-wrapper">
                <img src="https://img.youtube.com/vi/${videoId}/hqdefault.jpg" alt="${video.snippet.title}" class="youtube-thumbnail">
                <button class="youtube-play">▶</button>
            </div>
        `;

        sliderContainer.appendChild(slide);
    });
    initializeSlick(sliderContainer);
    setupVideoPlayback();
}

export function initializeSlick(selector) {
    $(selector).slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev"></button>',
        nextArrow: '<button class="slick-next"></button>',
        dots: false,
        autoplay: false,
        variableWidth: true,
        // centerMode: true,
        // centerPadding: '20px',
        lazyLoad: "ondemand",
        responsive: [
            {breakpoint: 1366, settings: {slidesToShow: 4}},
            {breakpoint: 1025, settings: {slidesToShow: 3}},
            {breakpoint: 768, settings: {slidesToShow: 2}},
            {breakpoint: 480, settings: {slidesToShow: 1}}
        ]
    }).on('beforeChange', stopAllVideos)
        .on('afterChange', function () {
            setTimeout(playCurrentSlideVideo, 500);
        });

    $(".youtube-slider").on('click', '.slick-prev, .slick-next', function () {
        setTimeout(playCurrentSlideVideo, 500);
    });
}

function setupVideoPlayback() {
    document.querySelectorAll(".youtube-play").forEach(button => {
        button.addEventListener("click", function () {
            stopAllVideos();

            const wrapper = this.closest(".youtube-wrapper");
            if (!wrapper) return;

            const videoId = wrapper.closest(".youtube-slide")?.getAttribute("data-video-id");
            if (!videoId) return;

            playVideo(wrapper, videoId, this);

        });
    });

    window.addEventListener("scroll", () => {
        document.querySelectorAll(".youtube-slide").forEach(slide => {
            const rect = slide.getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > window.innerHeight) {
                stopAllVideos();
            }
        });
    });
}

function stopAllVideos() {
    document.querySelectorAll(".youtube-wrapper iframe").forEach(iframe => {
        iframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":[]}', '*');
    });
}

function playCurrentSlideVideo() {
    const currentSlide = $('.slick-current.slick-active');
    if (!currentSlide) return;

    const playButton = currentSlide.find(".youtube-play");

    if (playButton) {
        playButton.click();
    }
}


function playVideo(wrapper, videoId) {
    wrapper.innerHTML = `
        <iframe 
            src="https://www.youtube-nocookie.com/embed/${videoId}?enablejsapi=1&modestbranding=0&rel=0&showinfo=0&autoplay=1&controls=1&mute=1&playsinline=1" 
            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
        </iframe>  
    `;
    // Append Pause Button
    const pauseButton = document.createElement("button");
    pauseButton.classList.add("youtube-pause");
    pauseButton.innerText = "❚❚";

    const iframe = wrapper.querySelector("iframe");
    iframe.addEventListener("load", () => {
        const player = new YT.Player(iframe, {
            events: {
                'onStateChange': function (event) {
                    if (event.data === YT.PlayerState.PAUSED) {

                        wrapper.appendChild(pauseButton);
                        pauseButton.addEventListener("click", () => {
                            if (wrapper.contains(pauseButton)) {
                                wrapper.removeChild(pauseButton);
                            }
                            stopAllVideos()
                            player.playVideo();
                        });

                    } else if (event.data === YT.PlayerState.PLAYING) {

                        if (wrapper.contains(pauseButton)) {
                            wrapper.removeChild(pauseButton);
                        }

                    } else if (event.data === YT.PlayerState.ENDED) {

                        player.seekTo(0, true); // Restart video from beginning
                        player.pauseVideo(); // Pause video

                        $(".youtube-slider").slick("slickNext");
                        setTimeout(() => {
                            // player.playVideo(); // Play video again

                        }, 500);
                    }
                }
            }
        });
    });
}