import {createApp} from 'vue';
import GestureSequence from '../vue-components/Gesture/GestureSequence.vue';

const selector = '#gesture-sequence-container';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                GestureSequence
            },
        });
        app.mount(appElement);
    }
});


