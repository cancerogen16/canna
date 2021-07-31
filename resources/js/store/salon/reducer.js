import { ADD_SALON, CLEAR_SALON } from "./action"

const initialState = [
    
]

export const salonsReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_SALON:{
            return [
                ...state,
                {
                    ...action
                }
            ]
        }
        case CLEAR_SALON:{
            return [
                
            ]
        }
        default:{
            return state
        }

    }

}