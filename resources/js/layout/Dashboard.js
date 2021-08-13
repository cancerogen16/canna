import React, {useEffect, useState} from 'react'
import PropTypes from 'prop-types'
import Header from '../components/Header'
import UserBar from '../components/Private/UserBar'

import {Container, Grid} from '@material-ui/core'
import {useDispatch} from 'react-redux'
import Navigation from '../components/Dashboard/Navigation'


const containerStyle = {
    paddingTop: '3.5rem',
}

const displayName = 'Мой салон'
const propTypes = {
    children: PropTypes.node.isRequired,
}


function DashboardLayout({children, history, user}) {
    const [open, setOpen] = useState(!user.salon);
    const dispatch = useDispatch();

    const handleNot = () => {
        history.push({
            pathname: '/',
            state: {pathname: history.location.pathname}
        })
    }
    useEffect(() => {
        //dispatch(fetchSalonsOneId(user.id))
    }, [])
    const handleYes = () => {

        //dispatch(clearSalon());
        setOpen(false);

    }
    console.log(user)
    return <div>
        <Header>
            <UserBar/>
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
                        {children}
                    </main>
                </Grid>


            </ Grid>
        </Container>
        {/* <Alert
        
          open={open} 
          title="Создать салон?"
          handleNot={handleNot} 
          handleYes={handleYes}
          >
            Мы не нашли в базе информацию о вашем салоне
        </Alert> */}
        {/* <Modal open={open}>
          <FormSalon  handleYes={handleYes}/>
        </Modal> */}

    </div>
}

DashboardLayout.dispatch = displayName
DashboardLayout.propTypes = propTypes

export default DashboardLayout