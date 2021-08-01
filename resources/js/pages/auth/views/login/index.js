import React from 'react';
import { useSelector } from 'react-redux';
import { Redirect } from 'react-router-dom';
import Login from '../../../../components/login';

export default function Page(props){

    const auth = useSelector(state => state.auth);
    console.log(auth)


    console.log('login', props)
    const handleAuch = () => {
        console.log('login', props)
        props.history.push({
            pathname: '/',
          })
    }
    if(auth.isAuthenticated){
        return <Redirect to='/dashboard'/>
    }
    return  <div className="login-page__block">
                <Login  />
            </div>
}