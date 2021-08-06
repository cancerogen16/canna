import React, { useEffect, useState } from 'react'
import PropTypes from 'prop-types'
import Header from '../components/header'
import UserBar from '../components/userBar'
import Alert from '../components/alert'
import Navigation from '../components/navigation'
import { Container, Grid } from '@material-ui/core'
import { useDispatch, useSelector } from 'react-redux'
import { clearSalon } from '../store/salon/action'
import { updateSalonUserFetch } from '../store/user/action'


const containerStyle = {
  paddingTop: '3.5rem',
}

const displayName = 'Мой салон'
const propTypes = {
  children: PropTypes.node.isRequired,
}



function DashboardLayout({ children, history, user }) {
  const [open, setOpen] = useState(!user.salon);
  const dispatch = useDispatch();
  
  const handleNot = () => {
    history.push({
        pathname: '/',
        state: {pathname: history.location.pathname}
      })
  }
  useEffect(() =>{
    
  }, [])
  const handleYes = () => {
   
    dispatch(clearSalon());
    setOpen(false);

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
        
          open={open} 
          title="Создать салон?"
          handleNot={handleNot} 
          handleYes={handleYes}
          >
            Мы не нашли в базе информацию о вашем салоне
        </Alert>

  </div>
}

DashboardLayout.dispatch = displayName
DashboardLayout.propTypes = propTypes

export default DashboardLayout