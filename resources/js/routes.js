const routes = [
    { path: '/', component: () => import('./pages/Task.vue') },
    { path: '/create', component: () => import('./pages/Create.vue') },
    { path: '/completed', component: () => import('./pages/Completed.vue') },
]

export default routes
