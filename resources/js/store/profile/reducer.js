import { EDIT_PROFILE } from "./action"

const initialState = {
    
    name: '',
    email: '',
    role_id: ''  
}

export const profileReducer = (state = initialState, action) => {

    switch(action.type){
        case EDIT_PROFILE:{
            return {
                ...state,
                ...action
            }
        }
        default:{
            return state
        }

    }

}