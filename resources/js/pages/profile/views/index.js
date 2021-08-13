import React from 'react'
import {useSelector} from 'react-redux'

export default function Page() {

    const profile = useSelector(state => state.profile);
    return (<><h1>Ваш e-mail: {profile.email}</h1>
        <h1>Ваш токен: {profile.token}</h1></>)
}