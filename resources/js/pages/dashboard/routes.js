import { lazy } from 'react'

export default [
  {
    path: '/dashboard',
    exact: true,
    auth: true,
    role: 2,
    component: lazy(() => import('./views/index')),
  }
]