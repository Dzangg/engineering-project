import {createApp} from 'vue';
import GridGesture from '../vue-components/Gesture/GridGesture.vue';

const selector = '#grid-container';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                GridGesture
            },
        });
        app.mount(appElement);
    }
});


