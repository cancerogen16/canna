import { CLEAR_USER } from "../user/action"
import { ADD_MASTER, CLEAR_MASTER, DELETE_MASTER } from "./action"

const initialState = [
    {
        id: 1,
        salon_id: '',
        name: 'Анастасия Иванова',
        slug: '',
        position: 'Мастер депиляции',
        photo: '',
        experience: '',
        description: '',
        rating: ''
    },
    {
        id: 2,
        salon_id: '',
        name: 'Анастасия Иванова',
        slug: '',
        position: 'Мастер депиляции',
        photo: '',
        experience: '',
        description: '',
        rating: ''
    },
    {
        id: 3,
        salon_id: '',
        name: 'Анастасия Иванова',
        slug: '',
        position: 'Мастер депиляции',
        photo: '',
        experience: '',
        description: '',
        rating: ''
    }
]


export const masterReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_MASTER:{
            return {
                ...state,
                ...action
            }
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