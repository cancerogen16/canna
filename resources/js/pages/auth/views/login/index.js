import React from 'react';
import { useSelector } from 'react-redux';
import { Redirect } from 'react-router-dom';
import Login from '../../../../components/Public/Login';


export default function Page(props){
    const auth = useSelector(state => state.auth)
    
    if(auth.isAuthenticated){
        return <Redirect to={{
            pathname: props.history.location.state.from.pathname,
            state: { from: props.location }
        }}/>
    }
    return  <div className="login-page__block">
                <Login  />
            </div>
}