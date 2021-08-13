import {ADD_SERVICES, CLEAR_SERVICES, DELETE_SERVICES} from "./action-types"

const initialServicesState = [
    {
        id: 2,
        category_id: 4,
        salon_id: 2,
        title: 'Услуга 2',
        price: 5901,
        duration: 1,
        image: 'https://via.placeholder.com/300x300.png/00bb55?text=services+%D0%A3%D1%81%D0%BB%D1%83%D0%B3%D0%B0+2+natus',
        excerpt: 'Занятый ими, он не говорил: «вы пошли», но: «вы изволили пойти», «я имел честь познакомиться.',
        description: 'Это не те фрикасе, — что же ты успел его так хорошо были сотворены и вмещали в себе тяжести на целый пуд больше. Пошли в гостиную, как вдруг гость объявил с весьма обходительным и учтивым помещиком Маниловым и несколько неуклюжим на взгляд Собакевичем, который с ним ставился какой-то просто медный инвалид, хромой, свернувшийся на сторону и весь в него по уши, у которой ручки, по словам пословицы. Может быть, вы имеете какие-нибудь сомнения? — О! помилуйте, ничуть. Я не стану есть. Мне лягушку.'
    }
]

const addServices = (state, action) => {
    return [
        ...action.services
    ]
}

const clearServices = () => {
    return []
}

const deleteService = (state, action) => {
    return state.filter(item => item.id !== action.id);
}

export const servicesReducer = (state = initialServicesState, action) => {
    switch (action.type) {
        case ADD_SERVICES: {
            return addServices(state, action);
        }
        case CLEAR_SERVICES: {
            return clearServices();
        }
        case DELETE_SERVICES: {

        }
        default: {
            return state
        }

    }

}