import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/home.vue')
    },
    {
        path: '/settings',
        component: require('./views/settings.vue')
    },
    {
        path: '/appsettings',
        component: require('./views/appsettings.vue')
    },
    {
        path: '/comments',
        component: require('./views/comments.vue')
    },
    {
        path: '/manual',
        component: require('./views/manual.vue')
    },
    {
        path: '/hashtags',
        component: require('./views/hashtags.vue')
    },
    {
        path: '/process',
        component: require('./views/process.vue')
    },
    {
        path: '/timed',
        component: require('./views/timed.vue')
    },
    {
        path: '/schedule',
        component: require('./views/schedule.vue')
    },
    {
        path: '/debug',
        component: require('./views/debug.vue')
    }
]


export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
})