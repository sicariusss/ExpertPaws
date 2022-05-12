<template>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" v-if="main === false">
            <div class="collapse navbar-collapse">
                <!-- for logged-in user-->
                <div class="navbar-nav" v-if="authenticated">
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
                    <router-link to="/books" class="nav-item nav-link">Books</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>

                    <a v-if="role_id === 1 || role_id === 2 || role_id === 3" href="/crm/users"
                       class="nav-item nav-link">CRM</a>
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/login" class="nav-item nav-link">login</router-link>
                    <router-link to="/register" class="nav-item nav-link">Register
                    </router-link>
                    <router-link to="/about" class="nav-item nav-link">About</router-link>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" v-if="main">
            <div class="collapse navbar-collapse">
                <!-- for logged-in user-->
                <div class="navbar-nav" v-if="authenticated">
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
                    <router-link to="/books" class="nav-item nav-link">Books</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>

                    <a v-if="role_id === 1 || role_id === 2 || role_id === 3" href="/crm/users"
                       class="nav-item nav-link">CRM</a>
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/login" class="nav-item nav-link">login</router-link>
                    <router-link to="/register" class="nav-item nav-link">Register
                    </router-link>
                    <router-link to="/about" class="nav-item nav-link">About</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view v-slot="{ Component }">
            <transition name="slide-fade" mode="out-in">
                <component :is="Component"/>
            </transition>
        </router-view>
    </div>
</template>

<style>
.slide-fade-enter-active {
    transition: all 0.4s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.4s ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(20px);
    opacity: 0;
}
</style>

<script>
export default {
    name: "App",
    data() {
        return {
            authenticated: false,
            main: false,
            role_id: 0,
        }
    },
    watch: {
        $route: function () {
            if (this.$route.path === "/") {
                this.main = true;
                console.log(this.main)
            }
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.authenticated = true
            console.log(this.authenticated)
        }
        if (window.Laravel.user) {
            this.role_id = window.Laravel.user.role_id
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
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
        }
    },
}
</script>
