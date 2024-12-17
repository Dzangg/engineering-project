import {createApp} from 'vue';
import Navbar from '../vue-components/Semantic/Navbar.vue';

const selector = '#navbar-container';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                Navbar
            },
        });
        app.mount(appElement);
    }
});


