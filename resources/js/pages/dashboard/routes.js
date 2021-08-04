import { lazy } from 'react'

export default [
  {
    path: '/dashboard',
    exact: true,
    auth: true,
    role: 2,
    component: lazy(() => import('./views/index')),
  },
  {
    path: '/dashboard/masters',
    exact: true,
    auth: true,
    role: 2,
    component: lazy(() => import('./views/masters')),
  },
  {
    path: '/dashboard/actions',
    exact: true,
    auth: true,
    role: 2,
    component: lazy(() => import('./views/actions')),
  }
]