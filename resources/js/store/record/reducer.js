import { ADD_TIMES } from "./action-types"


const initialState = {
    user_id: '',
    service_id: '',
    master_id: '',
    start_datetime: '',
    name: '',
    phone: '',
    comment: '',
}


const addTimesAll = (action) => {
    return [
        ...action.times
    ]
}


export const timesReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_TIMES:{
            return addTimesAll(action);
        }
        default:{
            return state
        }

    }

}