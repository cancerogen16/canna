import { EDIT_PROFILE } from "./action"

const initialState = {
    firstName: 'Тест',
    lastName: 'ТЕСТ',
    email: 'mail@mail.ru',
    phone: '+79999999999',   
}

export const profileReducer = (state = initialState, action) => {

    switch(action.type){
        case EDIT_PROFILE:{
            return {
                ...state,
                ...action
            }
        }
        default:{
            return state
        }

    }

}