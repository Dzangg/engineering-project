import {createApp} from 'vue';
import ListGesture from '../vue-components/Gesture/ListGesture.vue';

const selector = '#asdasdas';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                ListGesture
            },
        });
        app.mount(appElement);
    }
});


