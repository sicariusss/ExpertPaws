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
                                       placeholder="Имя">
                            </div>
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="email" v-model="email" required
                                       placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="subject" v-model="subject" required
                                       autocomplete="off" placeholder="Тема">
                            </div>
                        </div>

                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                            <textarea type="text" class="form-control" id="message" v-model="message" rows="5" required
                                      autocomplete="off" placeholder="Сообщение"/>
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
            user_id: null,
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
            if (this.name.length > 0 && this.email.length > 0 && this.subject.length > 0 && this.message.length) {
                axios.post('api/contacts', {
                    name: this.name,
                    email: this.email,
                    subject: this.subject,
                    message: this.message,
                    user_id: this.user_id ?? null,
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
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name ?? ''
            this.email = window.Laravel.user.email ?? ''
            this.user_id = window.Laravel.user.id ?? null
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
                console.log(response);
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
</style>
