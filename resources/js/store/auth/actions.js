import {AUTH_CHECK, AUTH_LOGIN, AUTH_LOGOUT, AUTH_REFRESH_TOKEN, AUTH_RESET_PASSWORD, AUTH_USER,} from './action-types';

export function authCheck(action) {
    return {
        type: AUTH_CHECK,
        action
    }
}

export function authLogin(action) {
    return {
        type: AUTH_LOGIN,
        action,
    };
}

export function authLogout() {
    return {
        type: AUTH_LOGOUT,
    }
}

export function authRefreshToken(action) {
    return {
        type: AUTH_REFRESH_TOKEN,
        action
    }
}

export function authResetPassword() {
    return {
        type: AUTH_RESET_PASSWORD,
    }
}

export function authUser(action) {
    return {
        type: AUTH_USER,
        action
    }
}