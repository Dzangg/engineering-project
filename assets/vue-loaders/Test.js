import {createApp} from 'vue';
import Test from '../vue-components/Gesture/Test.vue';

const selector = '#haha';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                Test
            },
        });
        app.mount(appElement);
    }
});


