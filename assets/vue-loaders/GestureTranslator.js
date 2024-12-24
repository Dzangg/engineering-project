import {createApp} from 'vue';
import GestureTranslator from '../vue-components/Translator/GestureTranslator.vue';

const selector = '#translator-container';
document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.querySelector(selector);

    if (appElement) {
        const app = createApp({
            components: {
                GestureTranslator
            },
        });
        app.mount(appElement);
    }
});


