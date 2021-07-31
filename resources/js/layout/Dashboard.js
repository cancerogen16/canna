import React from 'react'
import PropTypes from 'prop-types'
import Header from '../components/header'
import UserBar from '../components/userBar'
import Alert from '../components/alert'


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
  return <div>
    <Header>
      <UserBar />
    </Header>
    <main>
      <Alert 
        open={user.role_id == 3} 
        title="Создать салон?"
        handleNot={handleNot} 
        >
          Мы не нашли в базе информацию о вашем салоне
        </Alert>
      { children }
    </main>

  </div>
}

DashboardLayout.dispatch = displayName
DashboardLayout.propTypes = propTypes

export default DashboardLayout