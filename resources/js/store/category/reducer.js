import { ADD_CATEGORY } from "./action"

const initialState = [
    
]


export const categoryReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_CATEGORY:{
            console.log(action.id)
            return [
                ...state,
                {
                    ...action
                }
            ]
        }
        default:{
            return state
        }

    }

}