import { Avatar } from '@material-ui/core';
import React from 'react';
import { useUserBar } from './useUserBar';

export default function UserBar(){

    const {user, handleLogout} = useUserBar();
    
    return  <div className="userbar">
                <Avatar className="userbar__avatar" alt="Пользователь" src={user.avatar} />
                <div className="userbar__group">
                    <span className="userbar__name">
                        {`Имя: ${user.name}`} 
                    </span>
                    <button onClick={handleLogout} className="userbar__logout">Выйти</button>
                </div>
            </div>
}