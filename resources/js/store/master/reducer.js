import { CLEAR_USER } from "../user/action"
import { ADD_MASTERS, CLEAR_MASTER, DELETE_MASTER } from "./action"

const initialMsastersState = [
    
]

const initialMsasterState = {
    
}

export const masterReducer = (state = initialMsastersState, action) => {

    switch(action.type){
        case ADD_MASTERS:{
            return [
                ...action.masters
            ]
        }
        case CLEAR_USER:{
            return [

            ]
        }
        case DELETE_MASTER:{
            return state.filter(item => item.id !== action.id)
        }
        default:{
            return state
        }

    }

}