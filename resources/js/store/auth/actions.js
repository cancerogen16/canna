import HTTP from '../HTTP';
import { clearUser, setUserWithThunk} from '../user/action';
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
                const {token, user} = res.data.data;
                console.log(res)
                  dispatch(authLogin(token));
                  dispatch(setUserWithThunk(user));
                  localStorage.setItem('access_token', token);
                  HTTP.defaults.headers.common['Authorization'] = `Bearer ${token}`
                
              })
              .catch(res => console.log(res));
        });
  }

  export const fetchRegistre = (credentials) => (dispatch, getState) => {
    HTTP.get('sanctum/csrf-cookie')
    .then(() => {
      HTTP.post('api/authorization/register', credentials)
              .then(res => {
                const {token, user} = res.data.data;
                console.log(res)
                dispatch(authLogin(token));
                dispatch(setUserWithThunk(user));
                localStorage.setItem('access_token', token);
                HTTP.defaults.headers.common['Authorization'] = `Bearer ${token}`
              });
      });
  }
  

  export const fetchLogout = (credentials) => (dispatch, getState) => {
    dispatch(authCheck())
    
    HTTP.post('api/authorization/logout')
      .then(dispatch(authLogout()))
      .then(localStorage.removeItem('access_token'))
      .then(dispatch(clearUser()));
    } 
  
  export const checkTokenStorage = () => (dispatch, getState) => {
    const isAuthenticated = !!localStorage.getItem('access_token');
    dispatch(authCheck(isAuthenticated));
    if (isAuthenticated) {
      HTTP.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('access_token')}`;
    }
  }

  export function authCheck(payload) {

    return {
      type: AUTH_CHECK,
      payload
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