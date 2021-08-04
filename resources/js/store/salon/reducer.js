import { ADD_SALON, CLEAR_SALON, ADD_SALONS, CREATE_SALON } from "./action"

const initialSalonsState = [
    
]
const initialSalonState = {
    
}

export const salonsReducer = (state = initialSalonsState, action) => {

    switch(action.type){
        case ADD_SALONS:{
            return [
                ...action.salons
            ]
        }
        case CLEAR_SALON:{
            return [
                
            ]
        }
        default:{
            return state
        }

    }

}
export const salonReducer = (state = initialSalonState, action) => {

    switch(action.type){
        case ADD_SALON:{
            return {
                ...action
            }
        }
        case CREATE_SALON:{
            return {
                ...action
            }
        }
        case CLEAR_SALON:{
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
        default:{
            return state
        }

    }

}