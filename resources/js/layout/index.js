import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import { connect } from 'react-redux'
import { withRouter } from 'react-router-dom'



// import components
import PrivateLayout from './Private'
import PublicLayout from './Public'
import DashboardLayout from './Dashboard'

function Layout(props) {

  const { isAuthenticated, children} = props

  if (isAuthenticated) {
      if (props.location.pathname.includes("dashboard")) {
        return <DashboardLayout {...props} >{children}</DashboardLayout>
      }
    return <PrivateLayout {...props}>{children}</PrivateLayout>
  }
  return <PublicLayout {...props}>{children}</PublicLayout>
}

Layout.displayName = 'Layout';

Layout.propTypes = {
  isAuthenticated: PropTypes.bool.isRequired,
  profile: PropTypes.object,
  children: PropTypes.node.isRequired,
  //dispatch: PropTypes.func.isRequired,
}

const mapStateToProps = state => {
  return {
    isAuthenticated: state.auth.isAuthenticated,
    profile: state.profile
  }
}

export default withRouter(connect(mapStateToProps)(Layout))