import './bootstrap';
import {createApp} from 'vue'

import MainComponent from '../js/components/MainComponent.vue'
const app = createApp({});

app.component('MainComponent',MainComponent);

app.mount('#app');
