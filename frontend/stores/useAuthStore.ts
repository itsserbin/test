import {useApiFetch} from "~/composables/useApiFetch";

export const useCounterStore = defineStore('auth', async () => {
    const user = ref();
    const isLoggedIn = computed(() => !!user.value);

    async function login(credentials: object = {}) {
        await useApiFetch('/sanctum/csrf-cookie')

        return await useApiFetch('api/login', {
            method: 'POST',
            body: credentials
        })
    }

    async function register(credentials: object) {
        const response = await useApiFetch('api/register', {
            method: 'POST',
            body: credentials
        });

        user.value = null
        navigateTo('/')
    }

    async function logout() {
        await useApiFetch('api/login', {
            method: 'POST',
        })
        user.value = null
        navigateTo('/')
    }

    return {
        user,
        login,
        logout
    }
})