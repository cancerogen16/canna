import { ADD_ALL_MASTERS, ADD_ONE_MASTER, CLEAR_MASTERS, DELETE_MASTER } from "./action-types"


const initialMastersState = []


const addMastersAll = (state, action) => {
    
    return [
        ...action.masters
    ]
}

const addMasterOne = (state, action) => {
    return [
        ...state,
        action
    ]
}


const clearMasters = () => {
    return [
        
    ]
}

const deleteMaster = (state, action) => {

    return state.filter(item => item.id !== action.id);
    
}

export const mastersReducer = (state = initialMastersState, action) => {

    switch(action.type){
        case ADD_ALL_MASTERS:{
            return addMastersAll(state, action);
        }
        case CLEAR_MASTERS:{
            return clearMasters();
        }
        case ADD_ONE_MASTER:{
            return addMasterOne(state, action);
        }
        case DELETE_MASTER: {
            return deleteMaster(state, action)
        }
        default:{
            return state
        }

    }

}