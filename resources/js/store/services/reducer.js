import {ADD_ALL_SERVICES, ADD_ONE_SERVICE, CLEAR_SERVICES, UPDATE_SERVICE, DELETE_SERVICE} from "./action-types"

const initialServicesState = []

const addServicesAll = (state, action) => {
    return [
        ...action.services
    ]
}

const addServiceOne = (state, action) => {
    return [
        ...state,
        action
    ]
}

const clearServices = () => {
    return []
}

const updateService = (state, action) => {
    return state.map(item => {
        return item.id === action.service.id ? action.service : item;
    });
}

const deleteService = (state, action) => {
    return state.filter(item => item.id !== action.id);
}

export const servicesReducer = (state = initialServicesState, action) => {
    switch (action.type) {
        case ADD_ALL_SERVICES: {
            return addServicesAll(state, action);
        }
        case CLEAR_SERVICES: {
            return clearServices();
        }
        case UPDATE_SERVICE: {
            return updateService(state, action);
        }
        case ADD_ONE_SERVICE: {
            return addServiceOne(state, action);
        }
        case DELETE_SERVICE: {
            return deleteService(state, action)
        }
        default: {
            return state
        }
    }
}