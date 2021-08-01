import React from 'react'
import PropTypes from 'prop-types'
import Header from '../components/header'
import Auch from '../components/auch'
import { Container } from '@material-ui/core'




const containerStyle = {
  paddingTop: '3.5rem',
}

const displayName = 'Public Layout'
const propTypes = {
  children: PropTypes.node.isRequired,
}

function PublicLayout({ children }) {
  return <div >
    <Header>
    <Auch/>
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