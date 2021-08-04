import { CLEAR_USER } from "../user/action"
import { ADD_ACTION, CLEAR_ACTION, DELETE_ACTION } from "./action"

const initialState = [
    {
        id: 1,
        salon_id: 22,
        name: 'Акция 1',
        photo: '',
        description: '',
        price: 7168,
        start_at: '',
        end_at: 'до 22.10.2012'
    },
    {
        id: 8,
        salon_id: 26,
        name: 'Акция 8',
        photo: '',
        description: '',
        price: 8710,
        start_at: '',
        end_at: 'до 25.09.2021'
    }
]


export const actionReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_ACTION:{
            return {
                ...state,
                ...action
            }
        }
        case CLEAR_USER:{
            return [

            ]
        }
        case DELETE_ACTION:{
            return state.filter(item => item.id !== action.id)
        }
        default:{
            return state
        }

    }

}