<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Аккаунт
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Регистрация
            </div>
        </div>
        <div class="auth-block mt-3">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <form>
                        <div class="form-group row">
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="surname" v-model="surname"
                                       placeholder="Фамилия">
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="name" v-model="name" required
                                       placeholder="Имя (обязательно)">
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="patronymic" v-model="patronymic"
                                       placeholder="Отчество">
                            </div>
                        </div>

                        <div class="form-group row mt-lg-3">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="email" class="form-control" id="email" v-model="email" required
                                       placeholder="Email (обязательно)">
                            </div>
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="number" class="form-control" id="phone" v-model="phone"
                                       placeholder="Телефон">
                            </div>
                        </div>

                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                                <input type="password" class="form-control" id="password" v-model="password" required
                                       autocomplete="off" placeholder="Пароль (обязательно)">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-lg-3" v-if="reg_error">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="reg-error-block">
                                    {{ reg_error }}
                                </div>
                            </div>
                        </div>
                        <div class="personal-data my-4">
                            Нажимая на кнопку, Вы даете согласие на
                            <router-link to="/personal-data">обработку персональных данных</router-link>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-paw" @click="handleSubmit">
                                    Зарегистрироваться
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
.personal-data {
    font-size: 15px;
    color: #fff;
    font-family: "Raleway", sans-serif;
    text-align: center;
}

.personal-data a {
    color: #ffc60b;
}

.reg-error-block {
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
            surname: "",
            name: "",
            patronymic: "",
            email: "",
            phone: "",
            password: "",
            reg_error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            let app = this;
            if (this.password.length <= 0) {
                app.reg_error = 'Введите пароль';
            } else if (this.email.length <= 0) {
                app.reg_error = 'Введите email';
            } else if (this.name.length <= 0) {
                app.reg_error = 'Введите имя';
            } else {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('api/register', {
                        surname: this.surname,
                        name: this.name,
                        patronymic: this.patronymic,
                        email: this.email,
                        phone: this.phone,
                        password: this.password
                    })
                        .then(response => {
                            if (response.data.success) {
                                window.location.href = "/login"
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
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
