import { lazy } from 'react'

export default [
  {
    path: '/',
    exact: true,
    component: lazy(() => import('./views/index')),
  },
  {
    path: '/salon/:id',
    exact: true,
    component: lazy(() => import('./views/salon')),
  }
]