import React from 'react'
import PropTypes from 'prop-types'
import Header from '../components/header'
import UserBar from '../components/userBar'
import { Container } from '@material-ui/core'


const containerStyle = {
  paddingTop: '3.5rem',
}

const displayName = 'Private Layout'
const propTypes = {
  children: PropTypes.node.isRequired,
}

function PrivateLayout({ children }) {
  return <div>
    <Header>
      <UserBar />
    </Header>
    <Container maxWidth="lg">
    <main>
      { children }
    </main>
    </Container>
  </div>
}

PrivateLayout.dispatch = displayName
PrivateLayout.propTypes = propTypes

export default PrivateLayout