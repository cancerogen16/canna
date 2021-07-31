import React, {Suspense} from 'react'
import PropTypes from 'prop-types'
import { Route, Redirect } from 'react-router-dom'
import { connect } from 'react-redux'

const DashboardRoute = ({ component: Component, isAuthenticated, isRole, ...rest }) => {
 
   
    return <Route {...rest} render={props => {
        return <Suspense fallback={<div>Loading...</div>}>
          
            {
                  isRole == 2
                    ? <Component {...props}/>
                    : <Redirect to={{
                        pathname: '/',
                        state: { from: props.location },
                    }}/>
            }
        </Suspense>
    }}/>
}

DashboardRoute.propTypes = {
  component: PropTypes.object.isRequired,
  location: PropTypes.object,
  isAuthenticated: PropTypes.bool.isRequired,
  isRole: PropTypes.any,
}

// Retrieve data from store as props
function mapStateToProps(store) {
  return {
    isAuthenticated: store.auth.isAuthenticated,
    isRole: store.user.role_id
  }
}

export default connect(mapStateToProps)(DashboardRoute)