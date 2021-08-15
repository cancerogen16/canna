import { ADD_ERROR, DEL_ERROR } from "./action-types"


const initialState = [
    
]


const addError = (state, action) => {
    return [
        ...state,
        action
    ]
    
}

const delError = (state, action) => {

    return state.filter((item, index) => index !== action.index);
    
}

export const errorReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_ERROR:{
            return addError(state, action);
        }
        case DEL_ERROR:{
            return delError(state, action);
        }
        default:{
            return state
        }

    }

}