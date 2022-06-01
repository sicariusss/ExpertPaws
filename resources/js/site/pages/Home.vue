<template>
    <div>
        <div class="row justify-content-end home-mobile-nav">
            <div class="col-auto" v-if="windowWidth<=767">
                <button v-on:click="bar = true;" :style="bar ? 'color:transparent' : null" class="navbar-burger">
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
        <div class="container">
            <div class="row home-block">
                <div class="col-md-12">
                    <div class="home-title mb-4">
                        Expert Paws
                    </div>
                    <div class="home-desc mb-4">
                        <span>Фелинологическая</span> обучающая платформа
                    </div>
                    <div class="home-navbar" v-if="windowWidth>767">
                        <router-link class="nav-active" to="/">Главная</router-link>
                        <router-link to="/about">О нас</router-link>
                        <router-link to="/courses">Курсы</router-link>
                        <router-link to="/reviews">Отзывы</router-link>
                        <router-link to="/contacts">Контакты</router-link>
                    </div>
                    <div class="social-links mt-4">
                        <a href="https://vk.com/id565266410" target="_blank"><i class="fa-brands fa-vk"></i></a>
                        <a href="https://twitter.com/amSicarius" target="_blank"><i
                            class="fa-brands fa-twitter"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100076719524798" target="_blank"><i
                            class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.home-block {
    height: calc(100vh - 70px);
    align-items: center;
}

.home-mobile-nav {
    padding: 16px 0;
    width: 100vw;
}

.home-title {
    line-height: 1;
    transition: ease-in-out 0.3s;
    font-size: 48px;
    font-weight: 700;
    font-family: 'Montserrat', sans-serif;
    color: #fff;
}

.home-desc {
    color: rgba(255, 255, 255, 0.8);
    font-size: 24px;
    font-weight: 500;
    font-family: "Raleway", sans-serif;
}

.home-desc span {
    color: white;
    border-bottom: 2px solid #ffc60b;
}

.home-navbar {
    display: inline-flex;
    transition: ease-in-out 0.3s;
    position: relative;
    align-items: center;
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    font-weight: 400;
}

.home-navbar a {
    position: relative;
    text-decoration: none;
    color: rgba(255, 255, 255, 0.8);
    margin-left: 10px;
    margin-right: 10px;
    transition: ease-in-out 0.3s;
}

.home-navbar a:hover, .home-navbar a:focus {
    color: white;
}

.home-navbar a:after {
    display: block;
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -5px;
    left: 0;
    background-color: #ffc60b;
    visibility: hidden;
    transition: all 0.3s ease-in-out 0s;
}

.home-navbar a:hover:after {
    visibility: visible;
    width: 60%;
}

.nav-active {
    color: white !important;
    margin-left: 0 !important;
}

.home-navbar .nav-active:after {
    visibility: visible !important;
    width: 60% !important;
}

.social-links {
    display: flex;
}

.social-links a {
    font-size: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    line-height: 1;
    margin-right: 10px;
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

.social-links a:hover {
    background: #ffc300d1
}
</style>

<script>
export default {
    name: "Home",
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
        if (window.Laravel.authenticated) {
            this.authenticated = true

            this.user_id = window.Laravel.auth_id ?? null

            let app = this;
            axios.get('api/users/' + this.user_id)
                .then(function (response) {
                    app.user = response.data.user[0];
                    app.fullName = app.user.surname + ' ' + app.user.name ?? ''
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
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    },
    mounted() {
        window.onresize = () => {
            this.windowWidth = window.innerWidth
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
}
</script>
