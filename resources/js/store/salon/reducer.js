import { ADD_SALON, CLEAR_SALON, CREATE_SALON } from "./action-types"

const initialSalonState = {
    
}

const addSalon = (action) => {
    
    return {
        ...action
    }

}

const createSalon = (action) => {
    
    return {
        ...action
    }

}

const clearSalon = () => {
    
    return {
        user_id: '',
        title: '', 
        slug: '',
        main_photo: '', 
        city: '', 
        address: '', 
        phone: '', 
        description: '', 
        rating: '',
        worktime: ''
    }

}



export const salonReducer = (state = initialSalonState, action) => {

    switch(action.type){
        case ADD_SALON:{
            return addSalon(action)
        }
        case CREATE_SALON:{
            return createSalon(action)
        }
        case CLEAR_SALON:{
            return clearSalon();
        }
        default:{
            return state
        }

    }

}