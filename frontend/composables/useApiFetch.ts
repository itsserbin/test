import type {CookieRef} from "#app";

export function useApiFetch(path: string, options: any = {}): Promise<any> {
    const token: CookieRef<any> = useCookie('XSRF-TOKEN')

    let headers: any = {};

    if (token.value) {
        headers['X-XSRF-TOKEN'] = token.value as string;
    }

    if (process.server) {
        headers = {
            ...headers,
            ...useRequestHeaders(['referer', 'cookie'])
        }
    }

    return $fetch('http://localhost:48080/' + path, {
        credentials: 'include',
        watch: false,
        ...options,
        headers: {
            ...headers,
            ...options?.headers
        },
    })
}
