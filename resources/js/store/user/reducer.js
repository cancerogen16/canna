import { SET_USER, CLEAR_USER } from "./action"

const initialState = {
    
    name: '',
    email: '',
    role_id: ''  
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
                name: '',
                email: '',
                role_id: '' 
            }
        }
        default:{
            return state
        }

    }

}