import React from 'react'
import PropTypes from 'prop-types'
import Header from '../components/Header'
import {Container} from '@material-ui/core'
import Auth from '../components/Public/Auth'

const containerStyle = {
    paddingTop: '3.5rem',
}

const displayName = 'Public Layout'
const propTypes = {
    children: PropTypes.node.isRequired,
}

function PublicLayout({children}) {
    return <div>
        <Header>
            <Auth/>
        </Header>
        <Container maxWidth="lg">
            <main>
                {children}
            </main>
        </Container>
    </div>
}

PublicLayout.dispatch = displayName
PublicLayout.propTypes = propTypes

export default PublicLayout