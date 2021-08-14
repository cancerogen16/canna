import {ADD_MASTER, CLEAR_MASTER, DELETE_MASTER} from "./action-types"

const initialMastersState = []

const addMaster = (state, action) => {
    return [
    ]
}

const clearMasters = () => {
    return []
}

const deleteMaster = (state, action) => {
    return state.filter(item => item.id !== action.id);
}

export const masterReducer = (state = initialMastersState, action) => {
    switch (action.type) {
        case ADD_MASTER: {
            return addMasters(state, action);
        }
        case CLEAR_MASTER: {
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