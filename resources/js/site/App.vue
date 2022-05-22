<template>
    <div v-if="$route.path !== '/'">
        <Navbar/>
    </div>
    <div>
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
