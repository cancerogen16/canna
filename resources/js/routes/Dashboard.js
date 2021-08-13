import React, {Suspense} from 'react'
import PropTypes from 'prop-types'
import {Redirect, Route} from 'react-router-dom'
import {connect, useDispatch} from 'react-redux'

const DashboardRoute = ({component: Component, isAuthenticated, userSalon, user, ...rest}) => {
    const dispatch = useDispatch();
    return <Route {...rest} render={props => {
        console.log('dash', props)
        return <Suspense fallback={<div>Loading...</div>}>


            {

                isAuthenticated
                    ? <Component {...props}/>
                    : <Redirect to={{
                        pathname: '/login',
                        state: {from: props.location},
                    }}/>
            }
        </Suspense>
    }}/>
}

DashboardRoute.propTypes = {
    component: PropTypes.object.isRequired,
    location: PropTypes.object,
    isAuthenticated: PropTypes.bool.isRequired,
    user: PropTypes.object
}

// Retrieve data from store as props
function mapStateToProps(store) {
    return {
        isAuthenticated: store.auth.isAuthenticated,
        role: store.user.role_id,
        user: store.user
    }
}

export default connect(mapStateToProps)(DashboardRoute)