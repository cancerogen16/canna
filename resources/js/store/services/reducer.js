import { ADD_ALL_SERVICES, ADD_ONE_SERVICE, CLEAR_SERVICES, DELETE_SERVICE } from "./action-types"


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
    return [

    ]
}

const deleteService = (state, action) => {

    return state.filter(item => item.id !== action.id);

}

export const servicesReducer = (state = initialServicesState, action) => {

    switch(action.type){
        case ADD_ALL_SERVICES:{
            return addServicesAll(state, action);
        }
        case CLEAR_SERVICES:{
            return clearServices();
        }
        case ADD_ONE_SERVICE:{
            return addServiceOne(state, action);
        }
        case DELETE_SERVICE: {
            return deleteService(state, action)
        }
        default:{
            return state
        }

    }

}