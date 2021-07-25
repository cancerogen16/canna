import { editProfile } from '../profile/action';
import {
    AUTH_CHECK,
    AUTH_LOGIN,
    AUTH_LOGOUT,
    AUTH_REFRESH_TOKEN,
    AUTH_RESET_PASSWORD,
    AUTH_USER,
  } from './action-types';
  

  export const fetchLogin = (credentials) => (dispatch, getState) => {
    fetch('/api/authorization/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify(credentials),
    })
    .then(res => res.json())
    .then(res => {
      dispatch(authLogin(res.data.token));
      dispatch(editProfile(res.data.user));
      return res.data.token;
    }).then(token => localStorage.setItem('access_token', token));
  }

  export const fetchRegistre = (credentials) => (dispatch, getState) => {
    fetch('/api/authorization/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify(credentials),
    })
    .then(res => res.json())
    .then(res => {
      dispatch(authLogin(res.data.token));
      localStorage.setItem('access_token', res.data.token);
    });
  }
  
  export function authCheck() {
    return {
      type: AUTH_CHECK,
    }
  }
  
  export function authLogin(payload) {
    return {
      type: AUTH_LOGIN,
      payload,
    };
  }
  
  export function authLogout() {
    return {
      type: AUTH_LOGOUT,
    }
  }
  
  export function authRefreshToken(payload) {
    return {
      type: AUTH_REFRESH_TOKEN,
      payload
    }
  }
  
  export function authResetPassword() {
    return {
      type: AUTH_RESET_PASSWORD,
    }
  }
  
  export function authUser(payload) {
    return {
      type: AUTH_USER,
      payload
    }
  }