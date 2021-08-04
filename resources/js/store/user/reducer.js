import { SET_USER, CLEAR_USER, UPDATE_SALON_USER } from "./action"

const initialState = {
    id:'',
    name: '',
    email: '',
    role_id: '',
    salon: ''  
}

export const userReducer = (state = initialState, action) => {

    switch(action.type){
        case SET_USER:{
            return {
                ...state,
                ...action
            }
        }
        case CLEAR_USER:{
            return {
                ...state,
                id: '',
                name: '',
                email: '',
                role_id: '' ,
                salon: ''
            }
        }
        case UPDATE_SALON_USER:{
            return {
                ...state,
                salon: action.salon
            }
        }
        default:{
            return state
        }

    }

}