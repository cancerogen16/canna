import {ADD_SERVICE, CLEAR_SERVICE, DELETE_SERVICE} from "./action-types"

const initialServicesState = []

const addService = (state, action) => {
    return [
    ]
}

const clearServices = () => {
    return []
}

export const serviceReducer = (state = initialServicesState, action) => {
    switch (action.type) {
        case ADD_SERVICE: {
            return addServices(state, action);
        }
        case CLEAR_SERVICE: {
            return clearServices();
        }
        case DELETE_SERVICE: {
            return deleteService(state, action);
        }
        default: {
            return state
        }
    }
}