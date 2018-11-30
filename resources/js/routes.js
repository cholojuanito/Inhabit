import Router from 'vue-router';

let routes = [{
        path: '/',
        name: 'landing',
        component: require('./views/Landing'),
        meta: {
            auth: undefined,
        },
    },
    {
        path: '/browse',
        name: 'browse',
        component: require('./components/ListingResults'),
        meta: {
            auth: undefined,
        },
    },
    {
        path: '/listing-info',
        component: require('./views/ListingInfo'),
        meta: {
            auth: undefined,
        },
    },
    {
        path: '/createListing',
        name: 'create',
        component: require('./components/CreateListing'),
        meta: {
            auth: true
        },
    },
    {
        path: '/user-listings',
        name: 'userListings',
        meta: {
            auth: {
                redirect: {
                    name: 'login'
                },
            },
        },
    },
    {
        path: '/login',
        name: 'login',
        component: require('./views/Login'),
        meta: {
            auth: false
        },
    },
    {
        path: '/register',
        name: 'sign-up',
        component: require('./views/SignUp'),
        meta: {
            auth: false
        },
    },
];

export default new Router({
    history: true,
    mode: 'history',
    routes,
});
