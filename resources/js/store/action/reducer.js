import { ADD_ACTION, CLEAR_ACTION, DELETE_ACTION } from "./action-types"


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

const addAction = (state, action) => {
    return {
        ...state,
        ...action
    }
}

const clearAction = () => {
    return [

    ]
}

const deleteAction = (state, action) => {
    return state.filter(item => item.id !== action.id)
}

export const actionReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_ACTION:{
            return addAction(state, action);
        }
        case CLEAR_ACTION:{
            return clearAction();
        }
        case DELETE_ACTION:{
            return deleteAction(state, action)
        }
        default:{
            return state
        }

    }

}