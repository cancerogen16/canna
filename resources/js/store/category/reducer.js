import { ADD_CATEGORY, CLEAR_CATEGORY } from "./action-types"


const initialState = [
    
]


const addCategory = (action, state) => {
    return [
        ...state,
        {
            ...action
        }
    ]
}

const clearCategory = (action, state) => {
    return [
                
    ]
}

export const categoryReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_CATEGORY:{
            return addCategory(action, state);
        }
        case CLEAR_CATEGORY:{
            return clearCategory(action, state);
        }
        default:{
            return state
        }

    }

}