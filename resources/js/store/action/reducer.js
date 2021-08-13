import {ADD_ACTION, CLEAR_ACTION, DELETE_ACTION} from "./action-types"


const initialState = [
    {
        id: 1,
        salon_id: 22,
        name: 'Акция 1',
        photo: 'https://via.placeholder.com/300x300.png/005577?text=actions+%D0%90%D0%BA%D1%86%D0%B8%D1%8F+1+aliquam',
        description: 'Иногда, глядя на запятки, хлыснул его совершенно изумил его. И — Помещик, казалось, был характер Манилова. На крыльцо со «вчерашнего вечера еще вкуснее. — уж больше не завезет, и тут же день был испущен — Вот я сейчас только, чтобы накласть его в рот, и высечь; я тебе дал пятьдесят — Нет, брат, в обращенных к своему взводу: «Ребята, вперед!» какой-нибудь заглохнувшей бедной деревушки, не могут покушать в руке, и, обмакнувши их в тот чуть не серебром, а какого даже человек, — Что все знакомые.',
        price: 7168,
        start_at: '2021-06-13 05:00:00',
        end_at: 'до 22.10.2012'
    },
    {
        id: 8,
        salon_id: 26,
        name: 'Акция 8',
        photo: 'https://via.placeholder.com/300x300.png/008866?text=actions+%D0%90%D0%BA%D1%86%D0%B8%D1%8F+8+natus',
        description: 'Из нее несколько коротковато, но остряка и дорого, черт знает что очень красивыми рядками. Заметно было, — право, милая. — Ничего нет уже не могу судить, но теперь, — такого неповорота редко глядел на двор в платье из виду дивный экипаж. По крайней мере пусть сядет верхом на то, — Послушайте, матушка… эх, какие страсти! Да вот эта, что даже горела во всех наизусть; он обыкновенно, куря трубку, и бог знает что в дороге. Из одного другое было совершенно успел Чичиков взглянул на вечную носку, и.',
        price: 8710,
        start_at: '2021-06-19 17:00:00',
        end_at: 'до 25.09.2021'
    }
]

const addAction = (state, action) => {
    return {
        ...state,
        ...action
    }
}

const clearAction = () => {
    return []
}

const deleteAction = (state, action) => {
    return state.filter(item => item.id !== action.id)
}

export const actionReducer = (state = initialState, action) => {

    switch (action.type) {
        case ADD_ACTION: {
            return addAction(state, action);
        }
        case CLEAR_ACTION: {
            return clearAction();
        }
        case DELETE_ACTION: {
            return deleteAction(state, action)
        }
        default: {
            return state
        }

    }

}