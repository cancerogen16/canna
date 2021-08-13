import React, {Suspense} from 'react'
import PropTypes from 'prop-types'
import {Redirect, Route} from 'react-router-dom'
import {connect} from 'react-redux'

const PrivateRoute = ({component: Component, isAuthenticated, user, ...rest}) => {

    console.log('privet', user);
    return <Route {...rest} render={props => {

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

PrivateRoute.propTypes = {
    component: PropTypes.object.isRequired,
    location: PropTypes.object,
    isAuthenticated: PropTypes.bool.isRequired,
    user: PropTypes.any
}

// Retrieve data from store as props
function mapStateToProps(store) {
    return {
        isAuthenticated: store.auth.isAuthenticated,
        role: store.user.role_id,
        user: store.user
    }
}

export default connect(mapStateToProps)(PrivateRoute)