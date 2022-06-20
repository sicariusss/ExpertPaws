<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Контакты
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Связаться с нами
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="row align-items-center contact-box-text">
                        <div class="col-12 contact-box-title">
                            Позвоните нам
                        </div>
                        <div class="col-12 contact-box-desc" v-for="phone in phones">
                            <a :href="'tel:' + phone.content" :title="phone.title">{{ phone.content }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="row align-items-center contact-box-text">
                        <div class="col-12 contact-box-title">
                            Напишите нам
                        </div>
                        <div class="col-12 contact-box-desc" v-for="email in emails">
                            <a :href="'mailto:' + email.content" target="_blank" :title="email.title">{{
                                    email.content
                                }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-lg-3">
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-share-nodes"></i>
                    </div>
                    <div class="row align-items-center contact-box-text">
                        <div class="col-12 contact-box-title">
                            Наши социальные сети
                        </div>
                        <div class="contacts-social-links">
                            <a v-for="social in socials" :href="social.content" target="_blank" :title="social.title"
                               v-html="getSocialIcon(social.title)">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0 d-flex align-items-stretch">
                <div class="contact-box">
                    <div class="box-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="row align-items-center contact-box-text">
                        <div class="col-12 contact-box-title">
                            Наш адрес
                        </div>
                        <div class="col-12 contact-box-desc" v-for="address in addresses">
                            <a :href="address.content" target="_blank" :title="address.title">{{ address.title }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="form-block">
                    <form>
                        <div class="form-group row mt-lg-3">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="name" v-model="name" required
                                       placeholder="Имя (обязательно)">
                            </div>
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="email" v-model="email" required
                                       placeholder="Email (обязательно)">
                            </div>
                        </div>

                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="subject" v-model="subject" required
                                       autocomplete="off" placeholder="Тема (обязательно)">
                            </div>
                        </div>

                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                            <textarea type="text" class="form-control" id="message" v-model="message" rows="5" required
                                      autocomplete="off" placeholder="Сообщение (обязательно)"/>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mt-lg-4">
                            <div class="col-auto mt-4 mt-lg-0">
                                <button type="submit" class="btn btn-outline-paw px-5" @click="handleSubmit">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="error-block" v-if="errormes" v-on:click="errormes=null">
            <i class="close-error fa-solid fa-xmark fa-2xl"></i>
            <div class="error-window">
                Вы не заполнили поля:
                <div v-for="(v, k) in errormes" :key="k">
                    <div v-for="errorm in v" :key="errorm">
                        {{ errorm }}
                    </div>
                </div>
            </div>
        </div>
        <div class="success-block" v-if="successmes" v-on:click="successmes=null">
            <i class="close-success fa-solid fa-xmark fa-2xl"></i>
            <div v-html="successmes" class="success-window">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Contacts",
    data() {
        return {
            emails: [],
            phones: [],
            socials: [],
            addresses: [],
            name: "",
            email: "",
            subject: "",
            message: "",
            errormes: null,
            successmes: null,
            user_id: null,
            user: {}
        }
    },
    methods: {
        getSocialIcon(title) {
            if (title === 'vk') {
                return '<i class="fa-brands fa-vk"></i>';
            } else if (title === 'twitter') {
                return '<i class="fa-brands fa-twitter"></i>';
            } else if (title === 'facebook') {
                return '<i class="fa-brands fa-facebook"></i>';
            } else {
                return '<i class="fa-solid fa-share-nodes"></i>';
            }
        },
        handleSubmit(e) {
            e.preventDefault()
            let app = this;
            axios.post('api/contacts', {
                name: this.name,
                email: this.email,
                subject: this.subject,
                message: this.message,
                user_id: this.user_id ?? null
            })
                .then(response => {
                    if (response.data.success) {
                        app.successmes = 'Обращение оставлено, <br> ответ придет Вам на почту :)'
                    } else {
                        console.error(response);
                        app.errormes = response.data.message
                    }
                })
                .catch(function (error) {
                    app.errormes = error.response.data.errors
                });
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null

            let app = this;
            axios.get('api/users/' + this.user_id)
                .then(function (response) {
                    app.user = response.data.user[0];
                    app.name = app.user.name ?? ''
                    app.email = app.user.email ?? ''
                })
                .catch(function (response) {
                    console.error(response);
                });
        }
    },
    mounted() {
        let app = this;
        axios.get('api/contacts')
            .then(function (response) {
                app.emails = response.data.emails;
                app.phones = response.data.phones;
                app.socials = response.data.socials;
                app.addresses = response.data.addresses;
            })
            .catch(function (response) {
                console.error(response);
            });
    },
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>

<style>
.contact-box {
    color: #444444;
    padding: 20px;
    width: 100%;
    background: rgba(255, 255, 255, 0.08);
    align-items: center;
    display: flex;
}

.box-icon {
    color: #ffc60b;
    border-radius: 50%;
    padding: 1rem;
    float: left;
    background: rgba(255, 255, 255, 0.1);
    width: 55px;
    height: 55px;
    text-align: center;
}

.box-icon svg {
    vertical-align: text-bottom;
    width: 20px;
    height: 20px;
}

.contact-box-title {
    font-family: "Raleway", sans-serif;
    font-size: 20px;
    color: rgba(255, 255, 255, 0.5);
    font-weight: 700;
}

.contact-box-desc a {
    color: #fff;
    line-height: 24px;
    font-size: 15px;
    text-decoration: none;
    font-family: "Montserrat", sans-serif;
    transition: 0.3s;
}

.contact-box-desc a:hover {
    color: #ffc60b;
}

.contacts-social-links {
    color: #fff;
    display: flex;
    margin-top: .2rem;
    margin-left: 1px;
    transition: 0.3s;
}

.contacts-social-links a {
    font-size: 18px;
    display: inline-block;
    color: #fff;
    line-height: 1;
    margin-right: 12px;
    transition: 0.3s;
}

.contacts-social-links a:hover {
    color: #ffc60b;
    transition: 0.3s;
}

.contact-box-text {
    padding-left: 1.5rem;
}

@media (max-width: 450px) {
    .contact-box-text {
        padding-left: 0.6rem;
    }

    .box-icon {
        padding: 0.8rem;
        width: 40px;
        height: 40px;
    }

    .box-icon svg {
        width: 15px;
        height: 15px;
        margin-bottom: 10px;
    }

    .contact-box-title {
        font-size: 17px;
    }

    .contact-box-desc a {
        font-size: 14px;
    }
}

.form-block {
    padding: 20px;
    background: rgba(255, 255, 255, 0.08);
    width: 100%;
    color: #444444;
}

.form-block input, .form-block textarea {
    padding: 10px 15px;
    border-radius: 0;
    box-shadow: none;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.08);
    border: 0;
    transition: 0.3s;
    color: #fff;
}

.form-block input:focus, .form-block textarea:focus {
    background-color: rgba(255, 255, 255, 0.11);
    color: #fff;
    border: 0;
    box-shadow: none;
}

.error-block, .success-block {
    height: 250px;
    background: rgba(0, 0, 0, 0.9);
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 999;
    display: flex;
    align-items: center;
    border-radius: 1rem;
    border: 2px solid #ffc60b;
    cursor: pointer;
}

.error-block {
    border: 2px solid red;
    width: 400px;
}

.success-block {
    border: 2px solid green;
    width: 450px;
}

.error-window, .success-window {
    width: 100%;
    text-align: center;
    color: #fff;
    font-size: 25px;
    font-weight: 600;
    font-family: "Montserrat", sans-serif;
}

.close-error, .close-success {
    position: absolute;
    top: 10px;
    right: 15px;
}

.close-error {
    color: red;
}

.close-success {
    color: green;
}

@media (max-width: 450px) {
    .error-block, .success-block {
        width: 95vw;
    }
}
</style>
