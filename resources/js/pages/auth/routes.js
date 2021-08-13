import {lazy} from 'react'

export default [
    {
        path: '/login',
        exact: true,
        component: lazy(() => import('./views/login')),
    },
    {
        path: '/register',
        exact: true,
        auth: true,
        component: lazy(() => import('./views/register')),
    },
]