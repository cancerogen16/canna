import { Avatar } from '@material-ui/core';
import React from 'react';
import { useHukUserBar } from './useHukUserBar';

export default function UserBar(){

    const {profile, handleLogout} = useHukUserBar();
    console.log(profile)
    return  <div className="userbar">
                <Avatar className="userbar__avatar" alt="Пользователь" src={profile.avatar} />
                <div className="userbar__group">
                    <span className="userbar__name">
                        {`Имя: ${profile.name}`} 
                    </span>
                    <button onClick={handleLogout} className="userbar__logout">Выйти</button>
                </div>
            </div>
}