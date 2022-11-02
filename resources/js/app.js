import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler'
import home from './components/Home.vue'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const app = createApp({})

app.component('home', home)

app.mount('#app')
