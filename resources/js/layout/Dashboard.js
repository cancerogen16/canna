import React from 'react'
import PropTypes from 'prop-types'
import Header from '../components/header'
import UserBar from '../components/userBar'
import Alert from '../components/alert'
import Navigation from '../components/navigation'
import { Container, Grid } from '@material-ui/core'


const containerStyle = {
  paddingTop: '3.5rem',
}

const displayName = 'Мой салон'
const propTypes = {
  children: PropTypes.node.isRequired,
}



function DashboardLayout({ children, history, user }) {
  const handleNot = () => {
    history.push({
        pathname: '/',
        state: {pathname: history.location.pathname}
      })
  }
  console.log(user)
  return <div>
      <Header>
        <UserBar />
      </Header>
      <Container maxWidth="lg">
      <Grid container spacing={3}>
          <Grid item xs={2}>
            <Navigation/>
          </Grid>
          
          <Grid item xs={10}>
          <main>
            { children }
          </main>
          </Grid>
            
          
      </ Grid>
      </Container>
      <Alert 
          open={user.role_id == 2} 
          title="Создать салон?"
          handleNot={handleNot} 
          >

        </Alert>

  </div>
}

DashboardLayout.dispatch = displayName
DashboardLayout.propTypes = propTypes

export default DashboardLayout