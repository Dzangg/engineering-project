import {createApp} from 'vue';
import Category from '../vue-components/Gesture/Category.vue';

const selector = '#category-container';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                Category
            },
        });
        app.mount(appElement);
    }
});


