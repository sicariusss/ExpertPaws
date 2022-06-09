import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Courses from "../pages/Courses";
import Contacts from "../pages/Contacts";
import Profile from "../pages/Profile";
import Callbacks from "../pages/Callbacks";
import Reviews from "../pages/Reviews";
import ProfileEdit from "../pages/ProfileEdit";
import PersonalData from "../pages/PersonalData";
import Course from "../pages/Course";
import Selling from "../pages/Selling";
import Payment from "../pages/Payment";
import Purchase from "../pages/Purchase";
import MyCourses from "../pages/MyCourses";
import CourseMain from "../pages/CourseMain";
import CourseLesson from "../pages/CourseLesson";

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
        name: 'Отзывы - Expert Paws',
        path: '/reviews',
        component: Reviews
    },
    {
        name: 'Связаться с нами - Expert Paws',
        path: '/contacts',
        component: Contacts
    },
    {
        name: 'Мой профиль - Expert Paws',
        path: '/profile',
        component: Profile
    },
    {
        name: 'Мои обращения - Expert Paws',
        path: '/callbacks',
        component: Callbacks
    },
    {
        name: 'Редактировать профиль - Expert Paws',
        path: '/profile-edit',
        component: ProfileEdit
    },
    {
        name: 'Политика обработки персональных данных - Expert Paws',
        path: '/personal-data',
        component: PersonalData
    },
    {
        name: 'Курс - Expert Paws',
        path: '/:slug',
        component: Course
    },
    {
        name: 'Покупка курса - Expert Paws',
        path: '/:slug/buy',
        component: Selling
    },
    {
        name: 'Оплата курса - Expert Paws',
        path: '/:slug/payment',
        component: Payment
    },
    {
        name: 'Спасибо за покупку - Expert Paws',
        path: '/:slug/purrchase',
        component: Purchase
    },
    {
        name: 'Мои курсы - Expert Paws',
        path: '/my-courses',
        component: MyCourses
    },
    {
        name: 'Обучение, Курс - Expert Paws',
        path: '/course/:slug',
        component: CourseMain
    },
    {
        name: 'Обучение, Урок - Expert Paws',
        path: '/course/:courseSlug/:chapterSlug/:lessonSlug',
        component: CourseLesson
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
