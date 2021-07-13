import React from 'react'
import PropTypes from 'prop-types'


const containerStyle = {
  paddingTop: '3.5rem',
}

const displayName = 'Private Layout'
const propTypes = {
  children: PropTypes.node.isRequired,
}

function PrivateLayout({ children }) {
  return <div style={containerStyle}>
    
    <main style={{ minHeight: '100vh'}}>
        privet
      { children }
     
    </main>

  </div>
}

PrivateLayout.dispatch = displayName
PrivateLayout.propTypes = propTypes

export default PrivateLayout