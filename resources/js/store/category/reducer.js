import { EDIT_CATEGORY } from "./action"

const initialState = [
    {
        id:1,
        title: "Парикмахер"
    }
]


export const categoryReducer = (state = initialState, action) => {

    switch(action.type){
        case EDIT_CATEGORY:{
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