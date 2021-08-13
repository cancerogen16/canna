import {ADD_SALONS, CLEAR_SALONS} from "./action-types"

const initialSalonsState = []

const addSalons = (action) => {
    return [
        ...action.salons
    ]
}

const clearSalons = () => {
    return []
}

export const salonsReducer = (state = initialSalonsState, action) => {
    switch (action.type) {
        case ADD_SALONS: {
            return addSalons(action)
        }
        case CLEAR_SALONS: {
            return clearSalons()
        }
        default: {
            return state
        }
    }
}