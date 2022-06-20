<template>
    <div class="navbar-block">
        <div class="container">
            <div class="row justify-content-between align-items-center py-3">
                <div class="col-auto">
                    <router-link to="/" class="navbar-logo">Expert Paws</router-link>
                </div>
                <div class="col-auto" v-if="windowWidth>=1200">
                    <div class="navbar-links">
                        <router-link to="/">Главная</router-link>
                        <router-link to="/about">О нас</router-link>
                        <router-link to="/courses">Курсы</router-link>
                        <router-link to="/reviews">Отзывы</router-link>
                        <router-link to="/contacts">Контакты</router-link>
                        <div v-if="authenticated">
                            <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                                {{ fullName }} <img :src="photo" alt="user" class="user-photo">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <router-link class="dropdown-item" to="/profile">Профиль</router-link>
                                </li>
                                <li v-if="!isUser"><a class="dropdown-item" href="/crm">CRM</a>
                                </li>
                                <li><a class="dropdown-item" style="cursor: pointer" @click="logout">Выйти</a></li>
                            </ul>
                        </div>
                        <div v-else>
                            <router-link to="/login">Вход</router-link>
                            <router-link to="/register">Регистрация</router-link>
                        </div>
                    </div>
                </div>
                <div class="col-auto" v-else-if="windowWidth<1200">
                    <button v-on:click="bar = true" class="navbar-burger" v-if="!bar">
                        <i class="fa-solid fa-bars fa-2xl"></i>
                    </button>
                    <div class="mobile-navbar" v-if="bar">
                        <button v-on:click="bar = false" class="navbar-close" v-if="bar">
                            <i class="fa-solid fa-xmark fa-2xl"></i>
                        </button>
                        <div class="navbar-links">
                            <button class="btn dropdown-toggle" data-bs-toggle="dropdown" v-if="authenticated">
                                {{ fullName }} <img :src="photo" alt="user" class="user-photo">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <router-link v-on:click="bar = false" class="dropdown-item" to="/profile">Профиль
                                    </router-link>
                                </li>
                                <li v-if="!isUser"><a class="dropdown-item" href="/crm">CRM</a>
                                </li>
                                <li><a class="dropdown-item" style="cursor: pointer" @click="logout">Выйти</a></li>
                            </ul>
                            <router-link v-on:click="bar = false" to="/">Главная</router-link>
                            <router-link v-on:click="bar = false" to="/about">О нас</router-link>
                            <router-link v-on:click="bar = false" to="/courses">Курсы</router-link>
                            <router-link v-on:click="bar = false" to="/reviews">Отзывы</router-link>
                            <router-link v-on:click="bar = false" to="/contacts">Контакты</router-link>
                            <div v-if="!authenticated" class="d-flex flex-column align-items-end">
                                <router-link v-on:click="bar = false" to="/login">Вход</router-link>
                                <router-link v-on:click="bar = false" to="/register">Регистрация</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Navbar",
    data() {
        return {
            authenticated: false,
            isUser: true,
            fullName: '',
            photo: '',
            windowWidth: window.innerWidth,
            bar: false,
        }
    },
    created() {
        console.log(this.$route.path)
        if (window.Laravel.authenticated) {
            this.authenticated = true

            this.user_id = window.Laravel.auth_id ?? null

            let app = this;
            let base_url = window.location.origin;

            axios.get(base_url + '/api/users/' + this.user_id)
                .then(function (response) {
                    app.user = response.data.user[0];
                    app.fullName = app.user.name ?? ''
                    app.photo = app.user.photo ?? ''
                    app.role = app.user.role_id ?? ''

                    if (app.role === 1 || app.role === 2 || app.role === 3) {
                        app.isUser = false;
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
    },
    mounted() {
        window.onresize = () => {
            this.windowWidth = window.innerWidth
        }
    },
}
</script>

<style>
.navbar-block {
    background: rgba(0, 0, 0, 0.4);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 997;
}

.navbar-logo {
    text-decoration: none;
    line-height: 1;
    transition: ease-in-out 0.3s;
    font-size: 2.5rem;
    font-weight: 700;
    font-family: 'Montserrat', sans-serif;
    color: #fff;
}

.navbar-logo:hover {
    color: #ffc60b;
}

.user-photo {
    width: 30px;
    height: 30px;
    border: 2px solid #ffc60b;
    border-radius: 50%;
}

.dropdown-toggle::after {
    color: #ffc60b;
}

.navbar-links {
    display: inline-flex;
    transition: ease-in-out 0.3s;
    position: relative;
    align-items: center;
    font-family: 'Montserrat', sans-serif;
    font-size: 16px;
    font-weight: 400;
}

.navbar-links a {
    position: relative;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.8);
    padding-left: 10px;
    padding-right: 10px;
    transition: ease-in-out 0.3s;
}

.navbar-links .dropdown-toggle {
    transition: ease-in-out 0.3s;
    position: relative;
    font-family: 'Montserrat', sans-serif;
    font-size: 16px;
    font-weight: 400;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.8);
    padding-top: 8px;
}

.navbar-links .dropdown-toggle:hover, .navbar-links .dropdown-toggle:focus {
    color: #ffc60b;
}

.navbar-links .dropdown-toggle:hover:after, .navbar-links .dropdown-toggle:focus:after {
    color: #ffc60b;
}

.navbar-links .dropdown-toggle:after {
    vertical-align: 0.15em;
    color: white;
    transition: ease-in-out 0.3s;
}

.navbar-links a:hover, .navbar-links a:focus {
    color: white;
}

.navbar-links a:after {
    display: block;
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -3px;
    left: 7px;
    background-color: #ffc60b;
    visibility: hidden;
    transition: all 0.3s ease-in-out 0s;
}

.navbar-links a:hover:after {
    visibility: visible;
    width: 60%;
}

.navbar-links a.router-link-active:after {
    visibility: visible;
    width: 60%;
}

.navbar-links a.router-link-active {
    color: white;
}

.navbar-links .dropdown-menu a:after {
    display: block;
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 3px;
    left: 10px;
    background-color: #ffc60b;
    visibility: hidden;
    transition: all 0.3s ease-in-out 0s;
}

.navbar-links .dropdown-menu a:hover:after {
    visibility: visible;
    width: 30%;
}

.navbar-links .dropdown-menu a.router-link-active:after {
    visibility: visible;
    width: 60%;
}

.navbar-links .dropdown-menu a.router-link-active {
    color: white;
}

.btn-check:focus + .btn, .btn:focus {
    outline: 0;
    box-shadow: none;
}

.dropdown-menu {
    padding: 0.5rem 0;
    font-size: 0.9rem;
    color: white;
    background-color: #000000e3;
    border: 1px solid #ffc60b94;
    min-width: 8rem;
}

.dropdown-item:hover, .dropdown-item:focus {
    background-color: transparent;
}

.navbar-burger {
    background: transparent;
    color: #ffc60b;
    border: none;
}

.mobile-navbar {
    height: 100vh;
    width: 100vw;
    background: rgba(0, 0, 0, 0.8);
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
}

.mobile-navbar .navbar-close {
    position: absolute;
    top: 2.5vh;
    right: 5vw;
    background: transparent;
    color: #ffc60b;
    border: none;
    z-index: 1000;
}

.mobile-navbar .navbar-links {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    font-size: 2rem;
    font-weight: 600;
    padding-top: 7vh;
    right: 4vw;
}

.mobile-navbar .dropdown-menu {
    font-size: 1.5rem;
    font-weight: 500;
    position: relative !important;
    transform: none !important;
    min-width: 11rem;
}

.mobile-navbar .dropdown-toggle {
    font-size: 2rem;
    font-weight: 600;
    padding-bottom: 0;
}
</style>
