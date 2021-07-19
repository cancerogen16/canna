import { ADD_SALON } from "./action"

const initialState = [
    {
        id: 1,
        title: 'Nail Bar', 
        main_photo: '/img/1.jpg',
        city: 'Москва', 
        address: 'Ул. Ленина д. 4', 
        phone: "+79999999999", 
        description: 'Самый лучший салон в городе', 
        rating: 5
    },
    {
        id: 2,
        title: 'Расческа', 
        main_photo: '/img/1.jpg',
        city: 'Москва', 
        address: 'Ул. Ленина д. 4', 
        phone: "+79999999999", 
        description: 'Самый лучший салон в городе', 
        rating: 5
    },
    {
        id: 3,
        title: 'Мастерская Стилистов', 
        main_photo: '/img/1.jpg',
        city: 'Москва', 
        address: 'Ул. Ленина д. 4', 
        phone: "+79999999999", 
        description: 'Самый лучший салон в городе', 
        rating: 5
    },
    {
        id: 4,
        title: 'Салон №4', 
        main_photo: '/img/1.jpg',
        city: 'Москва', 
        address: 'Ул. Ленина д. 4', 
        phone: "+79999999999", 
        description: 'Самый лучший салон в городе', 
        rating: 5
    }
]

export const salonsReducer = (state = initialState, action) => {

    switch(action.type){
        case ADD_SALON:{
            return [
                ...state,
                {
                    ...action
                }
            ]
        }
        default:{
            return state
        }

    }

}