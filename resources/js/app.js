import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import {createVuetify} from "vuetify";

import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import 'vuetify/styles'

import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import {VDataTable} from 'vuetify/labs/VDataTable'
import {VDataTableVirtual} from 'vuetify/labs/VDataTable'
import '../assets/variables.scss'
import draggable from "vuedraggable";


const myCustomLightTheme = {
    dark: false,
    options: {
        customProperties: true
    },
    colors: {
        surface: '#F5F5F5',
        primary: '#d09923',
        secondary: '#d09923',
        error: '#B00020',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FB8C00',
    },
}


const vuetify = createVuetify({
    components: {...components, VDataTable, VDataTableVirtual, draggable},
    directives,
    theme: {
        defaultTheme: 'myCustomLightTheme',
        themes: {
            myCustomLightTheme,
        },
    },
    defaultAssets: {
        font: {
            family: 'cairo'
        }
    },
    locale: {
        locale: 'ar',
        rtl: {
            ar: true,
        },
    },
})

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(vuetify)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
