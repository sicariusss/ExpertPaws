<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Аккаунт
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Вход
            </div>
        </div>
        <div class="auth-block mt-3">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <form>
                        <div class="form-group row justify-content-center">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="email" class="form-control" id="email" v-model="email" required
                                       placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mt-lg-3">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="password" class="form-control" id="password" v-model="password" required
                                       autocomplete="off" placeholder="Пароль">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-lg-3" v-if="login_error">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="login-error-block">
                                    {{ login_error }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mt-lg-4">
                            <div class="col-auto mt-4 mt-lg-0">
                                <button type="submit" class="btn btn-outline-paw px-5" @click="handleSubmit">
                                    Войти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.login-error-block {
    color: red;
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    font-weight: 600;
    text-align: center;
}
</style>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            error: null,
            login_error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            let app = this;
            if (this.email.length <= 0) {
                app.login_error = 'Введите email';
            } else if (this.password.length <= 0) {
                app.login_error = 'Введите пароль';
            } else {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('api/login', {
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            console.log(response.data)
                            if (response.data.success) {
                                window.location.href = "/profile"
                            } else {
                                app.login_error = 'Неверный email или пароль';
                            }
                        })
                        .catch(function (error) {
                            app.login_error = 'Неверный email или пароль';
                            console.error(error);
                        });
                })
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.authenticated) {
            return next('/');
        }
        document.title = to.name;
        next();
    }
}
</script>
