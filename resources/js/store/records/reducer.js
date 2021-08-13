import {ADD_RECORD, CLEAR_RECORD} from "./action-types"

const initialState = []

export const recordsReducer = (state = initialState, action) => {
    switch (action.type) {
        case ADD_RECORD: {
            return [
                ...state,
                {
                    ...action
                }
            ]
        }
        case CLEAR_RECORD: {
            return []
        }
        default: {
            return state
        }
    }
}