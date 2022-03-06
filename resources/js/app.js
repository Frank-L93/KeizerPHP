import { createApp, h } from 'vue'
import VueCookies from 'vue-cookies'
import { App, plugin } from '@inertiajs/inertia-vue3'
import 'v-calendar/dist/style.css';

const el = document.getElementById('app')


createApp({
    render: () => h(App, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => import(`@/Pages/${name}`).then(m => m.default),
    })
}).mixin({
    methods: {
        route: window.route,
        title: title => `SchaakManager - ${title}`,
    }
}).use(plugin).use(VueCookies).mount(el)
