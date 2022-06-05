<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Покупка курса
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Данные
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="selling-note">
                Пожалуйста введите Ваши данные
            </div>
        </div>
        <div class="selling-form mt-3 mb-5">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <form>
                        <div class="form-group row">
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="surname" v-model="surname"
                                       required placeholder="Фамилия (обязательно)">
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="name" v-model="name" required
                                       placeholder="Имя (обязательно)">
                            </div>
                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="patronymic" v-model="patronymic"
                                       required placeholder="Отчество (обязательно)">
                            </div>
                        </div>

                        <div class="form-group row mt-lg-3">
                            <div class="col-lg-12 mt-3 mt-lg-0">
                                <input type="email" class="form-control" id="email" v-model="email" required
                                       placeholder="Email (обязательно)">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mt-5">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-paw px-3 px-lg-5" @click="handleSubmit">
                                    Перейти к оплате
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
    name: "Selling",
    data() {
        return {
            surname: "",
            name: "",
            patronymic: "",
            email: "",
            course: {},
            user_id: null,
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id

            let app = this;
            let base_url = window.location.origin;
            axios.get(base_url + '/api/users/' + this.user_id)
                .then(function (response) {
                    app.user = response.data.user[0];
                    app.surname = app.user.surname ?? ''
                    app.name = app.user.name ?? ''
                    app.patronymic = app.user.patronymic ?? ''
                    app.email = app.user.email ?? ''
                })
                .catch(function (response) {
                    console.log(response);
                });
        }
    },
    beforeCreate() {
        let app = this;
        let base_url = window.location.origin;
        axios.get(base_url + '/api/courses/' + this.$route.params.slug)
            .then(function (response) {
                app.course = response.data.course;
                document.title = 'Покупка курса "' + app.course.title + '" - Expert Paws';
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.surname.length > 0 && this.name.length > 0 && this.patronymic.length > 0 && this.email.length > 0) {
                let app = this;
                let base_url = window.location.origin;
                axios.patch(base_url + '/api/user', {
                    surname: this.surname,
                    name: this.name,
                    patronymic: this.patronymic,
                    email: this.email,
                })
                    .then(response => {
                        if (response.data.success) {
                            app.$router.push('/' + app.$route.params.slug + '/payment');
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
            return next('/');
        }
        document.title = to.name;
        next();
    }
}
</script>

<style>
.selling-note {
    font-size: 30px;
    font-family: "Raleway", sans-serif;
    text-align: center;
}

.selling-form {
    padding: 30px 20px;
    background: rgba(255, 255, 255, 0.08);
    width: 100%;
}

.selling-form input {
    padding: 10px 15px;
    border-radius: 0;
    box-shadow: none;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.08);
    border: 0;
    transition: 0.3s;
    color: #fff;
}

.selling-form input:focus {
    background-color: rgba(255, 255, 255, 0.11);
    color: #fff;
    border: 0;
    box-shadow: none;
}
</style>
