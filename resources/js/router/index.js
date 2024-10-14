import   { createRouter, createWebHistory  } from "vue-router";

import homePageIndex from '../components/pages/home/index.vue'
import notFound from '../components/notFound.vue'
import ProductShow from '../components/pages/product/index.vue'
import CartShow from '../components/pages/cart/index.vue'
import Register from '../components/pages/auth/register.vue';
import Login from '../components/pages/auth/login.vue';
import Pay from '../components/pages/pay/index.vue';
import Profile from '../components/pages/auth/profile.vue';
import Categories from '../components/pages/categories/index.vue';
import CategoriesShow from '../components/pages/categories/show.vue';


const routes = [
    //pages
    {
        path: '/',
        component: homePageIndex,
        name: 'home',
    },
    // noFound
    {
        path: '/:pathMatch(.*)*',
        component: notFound,
    },
    //
    {
        path: '/product/:id',
        name: 'product.show',
        component: ProductShow,
        props: true // Pass the id as a prop to the component
    }
    ,
    {
        path: '/cart/',
        name: 'cart.show',
        component: CartShow,
    },
    { path: '/register', component: Register , name:'logout'},
    { path: '/login', component: Login , name:'login'},

    { path: '/pay', component: Pay , name:'pay'},

    { path: '/profile', component: Profile , name:'profile'},

    { path: '/categories', component: Categories , name:'categories'},
    {
        path: '/categories/:id',
        name: 'categories.show',
        component: CategoriesShow,
        props: true // Pass the id as a prop to the component
    }
]

const router = createRouter({ 
    history: createWebHistory(),
    routes, 
});

export default router