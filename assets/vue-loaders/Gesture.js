import {createApp} from 'vue';
import Gesture from '../vue-components/Gesture/Gesture.vue';

const selector = '#list-gesture-container';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                Gesture
            },
        });
        app.mount(appElement);
    }
});


