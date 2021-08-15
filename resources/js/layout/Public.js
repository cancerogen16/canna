import React, { useEffect } from 'react'
import PropTypes from 'prop-types'
import Header from '../components/Header'
import { Container, Snackbar } from '@material-ui/core'
import Auth from '../components/Public/Auth'
import { useSelector } from 'react-redux'
import { SnackbarProvider, useSnackbar } from 'notistack';
import Alert from '../components/Dialogs/Alert'
import { useSnack } from '../store/error/useSnack'




const containerStyle = {
  paddingTop: '3.5rem',
}

const displayName = 'Public Layout'
const propTypes = {
  children: PropTypes.node.isRequired,
}

function PublicLayout({ children }) { 
  const err = useSelector(state => state.error);
  const {snack} = useSnack();
 
  return <div >
    <Header>
    <Auth/>
    </Header>
    <Container maxWidth="lg">
    <main >
      { children }
    </main>
    
    </Container>
  </div>
}

PublicLayout.dispatch = displayName
PublicLayout.propTypes = propTypes

export default PublicLayout