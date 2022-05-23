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
</style>
