import { EDIT_PROFILE } from "./action"

const initialState = {
    
    email: '',
    token: ''   
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