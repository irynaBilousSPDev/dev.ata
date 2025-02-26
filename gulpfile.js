const cache = require('gulp-cache');
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const {exec} = require('child_process');

const paths = {
    styles: {
        src: 'assets/src/scss/**/*.scss',
        dest: 'assets/dist/css/'
    },
    scripts: {
        entry: './assets/src/js/main.js',
        dest: 'assets/dist/js/'
    }
};

// Compile SCSS → CSS
function styles() {
    return gulp
        .src(paths.styles.src, {sourcemaps: true})
        .pipe(sourcemaps.init())
        .pipe(
            sass({
                includePaths: ['node_modules']
            }).on('error', sass.logError)
        )
        .pipe(postcss([autoprefixer()]))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.styles.dest));
}

//  Run Webpack for JavaScript
function scripts(cb) {
    exec('npx webpack', (err, stdout, stderr) => {
        console.log(stdout);
        console.error(stderr);
        cb(err);
    });
}


//  Watch SCSS, JS
function watchFiles() {
    gulp.watch(paths.styles.src, styles);
    gulp.watch('assets/src/js/**/*.js', scripts);
}
function clearCache(done) {
    return cache.clearAll(done);
}


//  Export tasks
exports.clearCache = clearCache;
exports.styles = styles;
exports.scripts = scripts;
exports.default = gulp.series(gulp.parallel(styles, scripts, clearCache), watchFiles);
