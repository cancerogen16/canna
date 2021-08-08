import { lazy } from 'react'

export default [
  {
    path: '/dashboard',
    exact: true,
    auth: true,
    dashboard: true,
    component: lazy(() => import('./views/index')),
  },
  {
    path: '/dashboard/masters',
    exact: true,
    auth: true,
    dashboard: true,
    component: lazy(() => import('./views/masters')),
  },
  {
    path: '/dashboard/discount',
    exact: true,
    auth: true,
    dashboard: true,
    component: lazy(() => import('./views/discount')),
  }
]