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
        path: '/listing-info/:id',
        component: require('./views/ListingInfo'),
        meta: {
            auth: undefined,
        },
    },
    {
        path: '/create-listing',
        name: 'create',
        component: require('./components/CreateListing'),
        meta: {
            auth: true,
            redirect: {
                name: 'login'
            },
        },
    },
    {
        path: '/user-listings',
        name: 'user-listings',
        component: require('./components/UsersListings'),
        meta: {
            auth: true,
            redirect: {
                name: 'login'
            },
        },
    },
    {
        path: '/favorite-listings',
        name: 'favorites',
        component: require('./components/FavoriteListings'),
        meta: {
            auth: true,
            redirect: {
                name: 'login'
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
