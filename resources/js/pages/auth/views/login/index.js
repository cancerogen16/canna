import React from 'react';
import Login from '../../../../components/login';
export default function Page(props){
    return  <div className="login-page__block">
                <Login {...props} />
            </div>
}