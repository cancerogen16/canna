import HTTP from '../../utils/HTTP';
import { clearUser } from '../user/action';
import { setUserWithThunk, updateSalonUserFetch } from '../user/thunks';
import { authCheck, authLogin, authLogout } from './actions';
import { addError} from '../error/action';

export const fetchLogin = (credentials) => (dispatch, getState) => {

    HTTP.get('sanctum/csrf-cookie')
        .then(() => {
            HTTP.post('api/authorization/login', credentials)
                .then(res => {
                    const {token, user} = res.data;
                    dispatch(authLogin(token));
                    dispatch(setUserWithThunk(user));
                    
                    localStorage.setItem('access_token', token);
                    HTTP.defaults.headers.common['Authorization'] = `Bearer ${token}`
                    dispatch(updateSalonUserFetch(user.id))
                })
                .catch(err => { 
                    if (err.response) { 
                        console.log(err.response)
                        dispatch(addError({code: status, message: err.response.data.email})) 
                    } else if (err.request) { 
                        console.log(err.request)
                        dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
                    } else { 
                        dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
                    }})
        }).catch(err => { 
            if (err.response) { 
                console.log(err.response)
                dispatch(addError({code: status, message: err.response.data.email})) 
            } else if (err.request) { 
                console.log(err.request)
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})

}

export const fetchRegistre = (credentials) => (dispatch, getState) => {

    HTTP.get('sanctum/csrf-cookie')
        .then(() => {
            HTTP.post('api/authorization/register', credentials)
                .then(res => {
                    const {token, user} = res.data;
                    dispatch(authLogin(token));
                    dispatch(setUserWithThunk(user));
                    localStorage.setItem('access_token', token);
                    HTTP.defaults.headers.common['Authorization'] = `Bearer ${token}`
                }).catch(err => { 
                    if (err.response) { 
                        dispatch(addError({code: status, message: err.response.data.email})) 
                    } else if (err.request) { 
                        dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
                    } else { 
                        dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
                    }})
        });

  }
  

export const fetchLogout = (credentials) => (dispatch, getState) => {
    
    dispatch(authCheck())

    HTTP.post('api/authorization/logout')
      .then(dispatch(authLogout()))
      .then(localStorage.removeItem('access_token'))
      .then(dispatch(clearUser()))
    } 
  
export const checkTokenStorage = () => (dispatch, getState) => {

    const isAuthenticated = !!localStorage.getItem('access_token');
    dispatch(authCheck(isAuthenticated));

    if (isAuthenticated) {

      HTTP.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('access_token')}`;

    }

}