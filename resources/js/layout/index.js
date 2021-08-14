import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { connect, useDispatch, useSelector } from 'react-redux'
import { withRouter } from 'react-router-dom'



// import components
import PrivateLayout from './Private'
import PublicLayout from './Public'
import DashboardLayout from './Dashboard'
import { useSnack } from '../store/error/useSnack'
import Alert from '../components/Dialogs/Alert'


function Layout(props) {

 


  
  const { isAuthenticated, children} = props
  console.log(isAuthenticated)
  if (isAuthenticated) {
      if (props.location.pathname.includes("dashboard")) {
        return <DashboardLayout {...props} >{children}</DashboardLayout>
      }
    return <PrivateLayout {...props}>{children}</PrivateLayout>
  }
  return <Alert><PublicLayout {...props}>{children}</PublicLayout></Alert>
}

Layout.displayName = 'Layout';

Layout.propTypes = {
  isAuthenticated: PropTypes.bool.isRequired,
  user: PropTypes.object,
  children: PropTypes.node.isRequired,
  //dispatch: PropTypes.func.isRequired,
}

const mapStateToProps = state => {
  return {
    isAuthenticated: state.auth.isAuthenticated,
    user: state.user
  }
}

export default withRouter(connect(mapStateToProps)(Layout))