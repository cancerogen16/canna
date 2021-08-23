import { ADD_TIMES } from "./action-types"


const initialState = [
    
]


const addTimesAll = (action) => {
    return [
        ...action.times
    ]
}


export const timesReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_TIMES:{
            return addTimesAll(action);
        }
        default:{
            return state
        }

    }

}