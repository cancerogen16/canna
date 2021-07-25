import { ADD_CATEGORY, CLEAR_CATEGORY } from "./action"

const initialState = [
    
]


export const categoryReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_CATEGORY:{
            return [
                ...state,
                {
                    ...action
                }
            ]
        }
        case CLEAR_CATEGORY:{
            return [
                
            ]
        }
        default:{
            return state
        }

    }

}