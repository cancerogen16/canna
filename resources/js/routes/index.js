import React from 'react'
import {BrowserRouter as Router, Switch} from 'react-router-dom'

import routes from './routes'
import PrivateRoute from './Private'
import PublicRoute from './Public'
import Layout from '../layout'
import DashboardRoute from './Dashboard'

const Routes = () => (<>
        <Router>
            <Layout>
                <Switch>
                    {routes.map((route, i) => {
                        console.log(route)

                        if (route.auth) {
                            if (route.dashboard) {
                                return <DashboardRoute key={i} {...route} />
                            }
                            return <PrivateRoute key={i} {...route} />
                        }

                        return <PublicRoute key={i} {...route} />
                    })}
                </Switch>
            </Layout>
        </Router></>
)

export default Routes