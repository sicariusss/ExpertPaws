import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Courses from "../pages/Courses";
import Products from "../pages/Products";
import Gallery from "../pages/Gallery";
import Contacts from "../pages/Contacts";

export const routes = [
    {
        name: 'Expert Paws',
        path: '/',
        component: Home
    },
    {
        name: 'О нас - Expert Paws',
        path: '/about',
        component: About
    },
    {
        name: 'Регистрация - Expert Paws',
        path: '/register',
        component: Register
    },
    {
        name: 'Вход - Expert Paws',
        path: '/login',
        component: Login
    },
    {
        name: 'Курсы - Expert Paws',
        path: '/courses',
        component: Courses
    },
    {
        name: 'Товары - Expert Paws',
        path: '/products',
        component: Products
    },
    {
        name: 'Отзывы - Expert Paws',
        path: '/reviews',
        component: Gallery
    },
    {
        name: 'Связаться с нами - Expert Paws',
        path: '/contacts',
        component: Contacts
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
