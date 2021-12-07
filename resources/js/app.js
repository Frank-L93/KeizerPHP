import { createApp, h } from 'vue'

import { App, plugin } from '@inertiajs/inertia-vue3'

const el = document.getElementById('app')


createApp({
    render: () => h(App, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => import(`@/Pages/${name}`).then(m => m.default),
    })
}).mixin({ methods: {
        route: window.route,
        title: title => `KeizerPHP - ${title}`,
    }}).use(plugin).mount(el)
