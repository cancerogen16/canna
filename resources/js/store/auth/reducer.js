import {AUTH_CHECK, AUTH_LOGIN, AUTH_LOGOUT, AUTH_REFRESH_TOKEN, AUTH_RESET_PASSWORD,} from './action-types';

const initialState = {
    isAuthenticated: false,
};

const authReducer = (state = initialState, {type, action = null}) => {
    switch (type) {
        case AUTH_REFRESH_TOKEN:
        case AUTH_LOGIN:
            return login(state, action);
        case AUTH_CHECK:
            return checkAuth(state, action);
        case AUTH_LOGOUT:
            return logout(state);
        case AUTH_RESET_PASSWORD:
            return resetPassword(state);
        default:
            return state;
    }
};

function login(state, action) {
    return {
        ...state, isAuthenticated: true,
    }

}

function checkAuth(state, action) {
    return {
        ...state,
        isAuthenticated: action
    };
}

function logout(state) {
    localStorage.removeItem('access_token')

    return {
        ...state, isAuthenticated: false
    }
}

function resetPassword(state) {
    return {
        ...state, resetPassword: true,
    }
}


export default authReducer;