<template>
    <div class="container">
        <div class="row home-block">
            <div class="col-md-12">
<!--                на 767 px надо маленький-->
                <div class="home-title mb-4">
                    Expert Paws
                </div>
                <div class="home-desc mb-4">
                    <span>Фелинологическая</span> обучающая платформа
                </div>
                <div class="home-navbar">
                    <router-link class="nav-active" to="/">Главная</router-link>
                    <router-link to="/about">О нас</router-link>
                    <router-link to="/courses">Курсы</router-link>
                    <router-link to="/products">Товары</router-link>
                    <router-link to="/reviews">Отзывы</router-link>
                    <router-link to="/contacts">Контакты</router-link>
                </div>
                <div class="social-links mt-4">
                    <a href="https://vk.com/id565266410" target="_blank"><i class="fa-brands fa-vk"></i></a>
                    <a href="https://twitter.com/amSicarius" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100076719524798" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.home-block {
    align-items: center;
    height: 100vh;
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
        return {}
    },
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>
