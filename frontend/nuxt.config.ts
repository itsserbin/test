import path from 'path';

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: {enabled: true},
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    },
    css: ['~/assets/css/main.css'],
    modules: [
        'nuxt-primevue',
        '@pinia/nuxt',
    ],
    pinia: {
        storesDirs: ['./stores/**'],
    },
    primevue: {
        unstyled: true,
        // @ts-ignore
        importPT: {from: path.resolve(__dirname, './assets/presets/lara/')}
    }
})
