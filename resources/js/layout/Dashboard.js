import React, { useEffect, useState } from 'react'
import PropTypes from 'prop-types'
import Header from '../components/Header'
import UserBar from '../components/Private/UserBar'

import { Container, Grid } from '@material-ui/core'
import { useDispatch, useSelector } from 'react-redux'
import { clearSalon } from '../store/salon/action'
import { clearMaster } from '../store/master/action'
import { updateSalonUserFetch } from '../store/user/action'
import Navigation from '../components/Dashboard/Navigation'
import Alert from '../components/Dialogs/Alert'
import Modal from '../components/Dialogs/Modal'
import FormSalon from '../components/Dashboard/FormSalon'
import FormMaster from '../components/Dashboard/FormMaster'
import { fetchSalonInfo, fetchSalonsOneId } from '../store/salon/thunks'
import { fetchMasters } from '../store/master/thunks'
import { fetchCategoryAll } from '../store/category/thunks'

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

  useEffect(() => {
    if(user.salon) {
        dispatch(fetchSalonInfo(user.salon));
        dispatch(fetchCategoryAll());
    }

},[])
 
  return <div>
      <Header>
        <UserBar />
      </Header>
      <Container maxWidth="lg">
      <Grid container spacing={3}>
          <Grid item xs={2}>
            
            <Navigation items={[
              {
                href: '/dashboard',
                title: 'Мой салон'
              },
              {
                href: '/dashboard/masters',
                title: 'Сотрудники'
              },
              {
                href: '/dashboard/services',
                title: 'Услуги салона'
              },
              {
                href: '/dashboard/discount',
                title: 'Акции'
              },
              {
                href: '/dashboard/records',
                title: 'Записи'
              },
              {
                href: '/',
                title: 'Выход'
              },
            ]}/>
          </Grid>
          
          <Grid item xs={10}>
          <main>
            { children }
          </main>
          </Grid>

      </ Grid>
      </Container>

  </div>
}

DashboardLayout.dispatch = displayName
DashboardLayout.propTypes = propTypes

export default DashboardLayout