import {createApp} from 'vue';
import Dashboard from '../vue-components/Dashboard.vue';

const selector = '#app';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                Dashboard
            },
        });
        app.mount(appElement);
    }
});


