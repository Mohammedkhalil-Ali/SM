import './bootstrap';
import router from './router.js';
import 'aos/dist/aos.css'
import 'aos/dist/aos.js'
import axios from './axios'
import { createApp } from 'vue';
import { createPinia } from 'pinia'
const pinia = createPinia()
const app=createApp({})
app.use(router)
app.use(pinia)
app.provide('$axios', axios)
app.mount("#app");