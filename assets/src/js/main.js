import 'bootstrap';

import General from './_generalScripts';

const App = {
    init() {
        function initGeneral() {
            return new General();
        }
        initGeneral();
    },
};

document.addEventListener('DOMContentLoaded', () => {
    App.init();
});
