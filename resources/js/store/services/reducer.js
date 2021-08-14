import { ADD_SERVICES, CLEAR_SERVICES, DELETE_SERVICES } from "./action-types"

const initialServicesState = []

    


const addServices = (state, action) => {
    return [
        ...action.services
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
        case ADD_SERVICES:{
            return addServices(state, action);
        }
        case CLEAR_SERVICES:{
            return clearServices();
        }
        case DELETE_SERVICES:{
            
        }
        default:{
            return state
        }

    }

}