import { lazy } from 'react'

export default [
  {
    path: '/profile',
    exact: true,
    auth: true,
    component: lazy(() => import('./views/index')),
  }
]