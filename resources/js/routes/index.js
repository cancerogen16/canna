import React from 'react'
import {BrowserRouter as Router, Switch} from 'react-router-dom'

import routes from './routes'
import PrivateRoute from './Private'
import PublicRoute from './Public'
import DashboardRoute from './Dashboard'
import Layout from '../layout'

const Routes = () => (<>
        <Router>
            <Layout>
                <Switch>
                    {routes.map((route, i) => {
                        
                        if (route.auth) {
                            
                            return <PrivateRoute key={i} {...route} />
                        }
                        return <PublicRoute key={i} {...route} />
                    })}
                </Switch>
            </Layout>
        </Router></>
)

export default Routes