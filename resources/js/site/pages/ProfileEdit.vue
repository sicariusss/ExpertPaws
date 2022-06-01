<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Аккаунт
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Редактирование
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
                                <input type="text" class="form-control" id="address" v-model="address"
                                       placeholder="Адрес">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mt-lg-4">
                            <div class="col-auto mt-4 mt-lg-0">
                                <button type="submit" class="btn btn-outline-paw px-5" @click="handleSubmitInfo">
                                    Изменить данные
                                </button>
                            </div>
                        </div>
                    </form>

                    <form>
                        <div class="form-group row mt-5">
                            <div class="col-12 mt-3 mt-lg-0">
                                <input type="password" class="form-control" id="password" v-model="password" required
                                       autocomplete="off" placeholder="Пароль">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mt-lg-4">
                            <div class="col-auto mt-4 mt-lg-0">
                                <button type="submit" class="btn btn-outline-paw px-5" @click="handleSubmitPass">
                                    Изменить пароль
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProfileEdit",
    data() {
        return {
            surname: "",
            name: "",
            patronymic: "",
            email: "",
            phone: "",
            password: "",
            address: ""
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null

            let app = this;
            axios.get('api/users/' + this.user_id)
                .then(function (response) {
                    app.user = response.data.user[0];
                    app.surname = app.user.surname ?? ''
                    app.name = app.user.name ?? ''
                    app.patronymic = app.user.patronymic ?? ''
                    // app.photo = app.user.photo ?? ''
                    app.email = app.user.email ?? ''
                    app.phone = app.user.phone ?? ''
                    app.address = app.user.address ?? ''
                })
                .catch(function (response) {
                    console.log(response);
                });
        }
    },
    methods: {
        handleSubmitInfo(e) {
            e.preventDefault()
            if (this.name.length > 0 && this.email.length > 0) {
                axios.patch('api/user', {
                    surname: this.surname,
                    name: this.name,
                    patronymic: this.patronymic,
                    email: this.email,
                    phone: this.phone,
                    address: this.address,
                })
                    .then(response => {
                        if (response.data.success) {
                            console.log(response)
                            // TODO: вывод сообщение об успехе
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        },
        handleSubmitPass(e) {
            e.preventDefault()
            if (this.password.length > 8) {
                axios.patch('api/user', {
                    password: this.password,
                })
                    .then(response => {
                        if (response.data.success) {
                            console.log(response)
                            // TODO: вывод сообщение об успехе
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.authenticated) {
            window.location.href = "/";
        }
        document.title = to.name;
        next();
    }
}
</script>
