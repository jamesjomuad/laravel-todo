const routes = [
    { path: '/', component: () => import('./pages/Task.vue') },
    { path: '/create', component: () => import('./pages/Create.vue') }
]

export default routes
