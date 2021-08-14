import {ADD_ACTION, CLEAR_ACTION, DELETE_ACTION} from "./action-types"

const initialState = []

const addAction = (state, action) => {
    return [
        ...action.actions
    ]
}

const clearAction = () => {
    return []
}

const deleteAction = (state, action) => {
    return state.filter(item => item.id !== action.id)
}

export const actionReducer = (state = initialState, action) => {
    switch (action.type) {
        case ADD_ACTION: {
            return addAction(state, action);
        }
        case CLEAR_ACTION: {
            return clearAction();
        }
        case DELETE_ACTION: {
            return deleteAction(state, action)
        }
        default: {
            return state
        }
    }
}