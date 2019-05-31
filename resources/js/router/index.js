import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

import Home from '../pages/Home'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    }
];

const router = createRouter();

export default router;


function createRouter()
{
    const router = new Router({
        mode: 'history',
        routes
    });

    return router
}