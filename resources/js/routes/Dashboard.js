import React, {Suspense, useEffect} from 'react'
import PropTypes, { any } from 'prop-types'
import { Route, Redirect } from 'react-router-dom'
import { connect, useDispatch } from 'react-redux'
import { Dashboard } from '@material-ui/icons'
import { updateSalonUserFetch } from '../store/user/thunks'
import FormSalon from '../components/Dashboard/FormSalon'
import Modal from '../components/Dialogs/Modal'
import { fetchSalonByUserId } from '../store/salon/thunks'

const DashboardRoute = ({ component: Component, isAuthenticated, userSalon, user,  ...rest }) => {
  const dispatch = useDispatch();
    return <Route {...rest} render={props => {
        console.log('dash',props)
        return <Suspense fallback={<div>Loading...</div>}>

            

            {
              
                  isAuthenticated
                    ? <Component {...props}/>
                    : <Redirect to={{
                        pathname: '/login',
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