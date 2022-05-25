<template>
    <div v-if="$route.path !== '/'">
        <Navbar/>
    </div>
    <div class="container">
        <router-view v-slot="{ Component }">
            <transition name="slide-fade" mode="out-in">
                <component :is="Component"/>
            </transition>
        </router-view>
    </div>
</template>

<script>
import Navbar from "./components/Navbar";

export default {
    name: "App",
    components: {Navbar},
    data() {
        return {
            authenticated: false,
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.authenticated = true
        }
    },
}
</script>

<style>
.component-block {
    margin-top: 20px;
    margin-bottom: 50px;
    overflow: hidden;
    width: 100%;
    transition: ease-in-out 0.4s;
    padding: 1.3rem;
    background: rgba(0, 0, 0, 0.9);
}

.component-title-mini {
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    color: #aaaaaa;
    font-family: "Montserrat", sans-serif;
}

.component-title-mini:after {
    content: "";
    width: 100px;
    height: 1px;
    display: inline-block;
    background: #ffc60b;
    margin: 4px 8px;
}

.component-title-max {
    font-size: 36px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #fff;
    text-decoration: none;
    transition: ease-in-out 0.3s;
}

.btn-outline-paw {
    color: #ffc60b;
    border-color: #ffc60b;
    font-size: 15px;
    font-weight: 500;
    font-family: "Montserrat", sans-serif;
    transition: ease-in-out 0.3s;
}

.btn-outline-paw:hover {
    color: #fff;
    background-color: rgba(255, 198, 11, 0.6);
    border-color: #ffc60b;
    transition: ease-in-out 0.3s;
}

.btn-check:focus + .btn-outline-paw, .btn-outline-paw:focus {
    box-shadow: 0 0 0 0.25rem #a58008;
}

.btn-check:checked + .btn-outline-paw, .btn-check:active + .btn-outline-paw, .btn-outline-paw:active, .btn-outline-paw.active, .btn-outline-paw.dropdown-toggle.show {
    color: #fff;
    background-color: rgba(255, 198, 11, 0.6);
    border-color: #ffc60b;
}

.btn-check:checked + .btn-outline-paw:focus, .btn-check:active + .btn-outline-paw:focus, .btn-outline-paw:active:focus, .btn-outline-paw.active:focus, .btn-outline-paw.dropdown-toggle.show:focus {
    box-shadow: 0 0 0 0.25rem #a58008;
}
</style>
