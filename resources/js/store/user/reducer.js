import { CLEAR_USER, SET_USER, UPDATE_SALON_USER } from "./action-types"


const initialState = {
    id:'',
    name: '',
    email: '',
    role_id: '',
    salon: ''  
}

const setUser = (state, action) => {
    return {
        ...state,
        ...action
    }
}

const clearUser = () => {
    return {
        id: '',
        name: '',
        email: '',
        role_id: '' ,
        salon: ''
    }
}

const updateSalon = (state, action) => {
    return {
        ...state,
        salon: action.salon
    }
}

export const userReducer = (state = initialState, action) => {

    switch(action.type){
        case SET_USER:{
            return setUser(state, action);
        }
        case CLEAR_USER:{
            return clearUser();
        }
        case UPDATE_SALON_USER:{
            return updateSalon(state, action)
        }
        default:{
            return state
        }

    }

}