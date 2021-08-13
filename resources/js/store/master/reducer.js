import {ADD_MASTERS, CLEAR_MASTERS, DELETE_MASTER} from "./action-types"

const initialMsastersState = []

const initialMsasterState = {}

const addMasters = (state, action) => {
    return [
        ...action.masters
    ]
}

const clearMasters = () => {
    return []
}

const deleteMaster = (state, action) => {
    return state.filter(item => item.id !== action.id);
}

export const masterReducer = (state = initialMsastersState, action) => {
    switch (action.type) {
        case ADD_MASTERS: {
            return addMasters(state, action);
        }
        case CLEAR_MASTERS: {
            return clearMasters();
        }
        case DELETE_MASTER: {
            return deleteMaster(state, action);
        }
        default: {
            return state
        }
    }
}