import { ADD_MASTERS, DELETE_MASTER, CLEAR_MASTERS } from "./action-types"


const initialMastersState = [
    
]

const initialMasterState = {
    
}

const addMasters = (state, action) => {
    return [
        ...action
    ]
}

const clearMasters = () => {
    return [
        
    ]
}

const deleteMaster = (state, action) => {

    return state.filter(item => item.id !== action.id);
    
}

export const masterReducer = (state = initialMastersState, action) => {

    switch(action.type){
        case ADD_MASTERS:{
            return addMasters(state, action);
        }
        case CLEAR_MASTERS:{
            return clearMasters();
        }
        case DELETE_MASTER:{
            return deleteMaster(state, action);
        }
        default:{
            return state
        }

    }

}