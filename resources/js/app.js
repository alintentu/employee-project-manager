import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue'; // Your main Vue component
import axios from 'axios';

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.mount('#app');
