import HTTP from '../HTTP';
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
    HTTP.get('sanctum/csrf-cookie')
        .then(() => {
          HTTP.post('api/authorization/login', credentials)
              .then(res => {
                console.log(res)
                dispatch(authLogin(res.data.data.token));
                dispatch(editProfile(res.data.data.user));
                return res.data.data.token;
              })
              .then(token => {
                localStorage.setItem('access_token', token);
                HTTP.defaults.headers.common['Authorization'] = `Bearer ${token}`
              });
        });
  }

  export const fetchRegistre = (credentials) => (dispatch, getState) => {
    HTTP.get('sanctum/csrf-cookie')
    .then(() => {
      HTTP.post('api/authorization/register', credentials)
              .then(res => {
                console.log(res)
                dispatch(authLogin(res.data.data.token));
                dispatch(editProfile(res.data.data.user));
                return res.data.data.token;
              })
              .then(token => {
                localStorage.setItem('access_token', token);
                HTTP.defaults.headers.common['Authorization'] = `Bearer ${token}`
              });
      });
  }
  
  export const fetchLogout = (credentials) => (dispatch, getState) => {
    dispatch(authCheck())
    HTTP.post('api/authorization/logout')
      .then(dispatch(authLogout()));
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