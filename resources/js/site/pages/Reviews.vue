<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Клиенты
            </div>
        </div>
        <div class="row pb-4">
            <div class="component-title-max">
                Отзывы
            </div>
        </div>
        <div class="mt-5" v-if="reviews.length > 0">
            <Splide :options="textOptions" aria-label="text-reviews">
                <SplideSlide v-for="review in reviews">
                    <div class="text-slider-item">
                        <div class="text-slider-desc">
                            <i class="fa-solid fa-quote-left"></i>
                            {{ review.description }}
                            <i class="fa-solid fa-quote-right"></i>
                            <div class="text-slider-name">
                                ~ {{
                                    review.anon === false
                                        ? review.user.name ?? 'Анонимный котик'
                                        : 'Анонимный котик'
                                }}
                            </div>
                        </div>
                    </div>
                </SplideSlide>
            </Splide>
        </div>
        <div class="my-5" v-if="gallery.length > 0">
            <div class="row justify-content-center">
                <div class="col-lg-3 gallery-item mb-4" v-for="item in gallery">
                    <img class="gallery-item-image" alt="review-image" :src="item.image"
                         v-on:click="show[item.id] = true"/>
                    <div class="gallery-image-block" v-if="show[item.id] === true">
                        <div class="row justify-content-center p-2 p-lg-5">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                                        <img class="gallery-show-image" alt="review-image" :src="item.image"/>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                                        <button v-on:click="show[item.id] = false" class="gallery-image-close">
                                            <i class="fa-solid fa-xmark fa-2xl"></i>
                                        </button>
                                        <div class="text-slider-desc">
                                            <i class="fa-solid fa-quote-left"></i>
                                            {{ item.description }}
                                            <i class="fa-solid fa-quote-right"></i>
                                            <div class="text-slider-name">
                                                ~ {{
                                                    item.anon === false
                                                        ? item.user.name ?? 'Анонимный котик'
                                                        : 'Анонимный котик'
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12">
                <div class="review-form" v-if="authenticated">
                    <div class="row justify-content-center text-center">
                        <div class="review-form-title py-3 py-lg-4">
                            Нам важно Ваше мнение!
                        </div>
                        <div class="review-form-remark">
                            Отзывы не имеющие отношения к нам и нашему сайту, содержащие ненормативную лексику или любые
                            выражения нарушающие законы РФ будут отклонены.
                        </div>
                    </div>
                    <form>
                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                            <textarea type="text" maxlength="350" class="form-control" id="message"
                                      v-model="description" rows="4"
                                      required
                                      autocomplete="off" placeholder="Отзыв"/>
                            </div>
                        </div>
                        <div class="review-form-remark mt-3">
                            Если Вы оставите отзыв с фотографией Вашего котика, он будет опубликован в галерее :)
                        </div>
                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                                <input class="form-control" type="file" id="image" v-on:change="uploadImage">
                            </div>
                        </div>
                        <div class="form-group row mt-lg-3">
                            <div class="col-12 mt-3 mt-lg-0">
                                <input class="form-check-input" type="checkbox" value="" id="anon" v-model="anon">
                                <label class="form-check-label ms-2" for="anon" style="font-size: 17px; color: #fff;">
                                    Оставить анонимно
                                </label>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-lg-3" v-if="errorrev">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="review-error-block">
                                    {{ errorrev }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mt-lg-4">
                            <div class="col-auto mt-4 mt-lg-0">
                                <button type="submit" class="btn btn-outline-paw px-5" @click="handleSubmit">
                                    Оставить отзыв
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div v-else-if="!authenticated">
                    <div class="my-5 text-center review-auth">
                        <router-link to="/login">Войдите</router-link>
                        , чтобы оставить свой отзыв
                    </div>
                </div>
            </div>
        </div>
        <div class="success-review-block" v-if="successrev" v-on:click="successrev=null">
            <i class="close-review-success fa-solid fa-xmark fa-2xl"></i>
            <div v-html="successrev" class="success-review-window">
            </div>
        </div>
    </div>
</template>

<script>

import {Splide, SplideSlide} from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';

export default {
    name: "Reviews",
    components: {
        Splide,
        SplideSlide
    },
    data() {
        return {
            reviews: {},
            gallery: {},
            show: [],
            user_id: null,
            file: "",
            description: "",
            anon: null,
            successrev: null,
            errorrev: null,
            authenticated: false
        }
    },
    setup() {
        const textOptions = {
            rewind: true,
            gap: '.5rem',
            autoplay: true,
            arrows: false,
            perPage: 3,
            type: 'loop',
            perMove: 1,
            breakpoints: {
                1199: {
                    perPage: 2,
                },
                767: {
                    perPage: 1,
                }
            }
        };
        return {textOptions};
    },
    created() {
        if (window.Laravel.authenticated) {
            this.authenticated = true;
            this.user_id = window.Laravel.auth_id ?? null
        }
    },
    methods: {
        uploadImage(e) {
            let files = e.target.files || e.dataTransfer.files;
            this.file = files[0];
        },
        handleSubmit(e) {
            e.preventDefault()
            let app = this;
            if (!window.Laravel.authenticated) {
                window.location.href = "/login";
            } else {
                if (app.description.length <= 0) {
                    app.errorrev = 'Введите отзыв';
                } else {
                    let formData = new FormData();
                    formData.append('image', this.file)
                    formData.append('description', this.description)
                    formData.append('user_id', this.user_id)
                    formData.append('anon', this.anon ?? 'false')

                    axios.post('api/reviews/create', formData)
                        .then(response => {
                            if (response.data.success) {
                                app.successrev = 'Отзыв отправлен, <br> он будет опубликован после проверки :)';
                                app.errorrev = null;
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                }
            }
        }
    },
    mounted() {
        let app = this;
        axios.get('api/reviews')
            .then(function (response) {
                app.reviews = response.data.reviews;
            })
            .catch(function (response) {
                console.error(response);
            });
        axios.get('api/gallery')
            .then(function (response) {
                app.gallery = response.data.gallery;
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

.text-slider-item {
    box-sizing: content-box;
}

.text-slider-item .text-slider-desc {
    font-style: italic;
    margin: 0 15px 0 15px;
    padding: 20px 20px 30px 20px;
    background: rgba(255, 255, 255, 0.1);
    position: relative;
    border-radius: 6px;
    z-index: 1;
}

.text-slider-item .fa-quote-left {
    display: inline-block;
    left: -5px;
    position: relative;
    color: rgba(255, 255, 255, 0.25);
    font-size: 26px;
}

.text-slider-item .fa-quote-right {
    display: inline-block;
    right: -5px;
    position: relative;
    top: 10px;
    color: rgba(255, 255, 255, 0.25);
    font-size: 26px;
}

.text-slider-item .text-slider-name {
    font-style: normal;
    font-size: 18px;
    font-weight: bold;
    margin-top: 30px;
    color: #fff;
    font-family: "Raleway", sans-serif;
}

.splide__pagination__page.is-active {
    background: #ffc60b;
    opacity: 1;
}

.splide__pagination {
    padding-top: 30px;
    position: unset;
}

.gallery-item-image {
    width: 100%;
    object-fit: cover;
    height: 300px;
    border-radius: 20px;
    cursor: pointer;
}

.gallery-image-block {
    width: 80vw;
    min-height: 80vh;
    background: rgba(0, 0, 0, 0.9);
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 999;
    display: flex;
    align-items: center;
    border-radius: 1rem;
}

.gallery-show-image {
    max-width: 70vh;
    width: 100%;
    border-radius: 1rem;
    object-fit: contain;
}

.gallery-image-block .text-slider-desc {
    margin: 0 15px 0 15px;
    padding: 20px 20px 30px 20px;
    position: relative;
    z-index: 1;
    font-size: 24px;
}

.gallery-image-block .fa-quote-left {
    display: inline-block;
    left: -5px;
    position: relative;
    color: rgba(255, 255, 255, 0.25);
    font-size: 30px;
}

.gallery-image-block .fa-quote-right {
    display: inline-block;
    right: -5px;
    position: relative;
    top: 10px;
    color: rgba(255, 255, 255, 0.25);
    font-size: 30px;
}

.gallery-image-block .text-slider-name {
    font-style: normal;
    font-size: 26px;
    font-weight: bold;
    margin-top: 30px;
    color: #fff;
    font-family: "Raleway", sans-serif;
}

.gallery-image-close {
    position: absolute;
    top: 2.5vh;
    right: 2vw;
    background: transparent;
    color: #ffc60b;
    border: none;
    z-index: 1000;
}

.review-auth {
    font-size: 26px;
    font-weight: bold;
    margin-top: 30px;
    color: #fff;
    font-family: "Raleway", sans-serif;
}

.review-auth a {
    color: #ffc60b;
}

.review-form {
    padding: 20px;
    background: rgba(255, 255, 255, 0.08);
    width: 100%;
    color: #444444;
}

.review-form input, .review-form textarea {
    padding: 10px 15px;
    border-radius: 0;
    box-shadow: none;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.08);
    border: 0;
    transition: 0.3s;
    color: #fff;
}

.review-form input:focus, .review-form textarea:focus {
    background-color: rgba(255, 255, 255, 0.11);
    color: #fff;
    border: 0;
    box-shadow: none;
}

.review-form input[type=checkbox] {
    box-shadow: none;
    transition: 0.3s;
    color: #fff;
    vertical-align: top;
    background: rgba(255, 255, 255, 0.08) no-repeat center;
    background-size: contain;
    padding: 10px;
}

.review-form input:checked[type=checkbox] {
    background-color: #ffc60b;
    color: black;
    background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path fill='none' stroke='black' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/></svg>");
}

input[type=file]::file-selector-button {
    background: rgba(255, 255, 255, 0.08);
    color: #fff;
    border: 1px black solid;
}

input[type=file]::-webkit-file-upload-button {
    background: rgba(255, 255, 255, 0.08);
    color: #fff;
    border: 1px black solid;
}

input[type=file]:hover::file-selector-button {
    color: black;
    border: 1px black solid;
}

.review-form-title {
    line-height: 1.2;
    font-size: 36px;
    font-weight: bold;
    color: #ffc60b;
    font-family: "Raleway", sans-serif;
}

.review-form-remark {
    font-size: 14px;
    color: #fff;
    font-family: "Raleway", sans-serif;
    width: 50%;
}

.review-error-block {
    color: red;
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    font-weight: 600;
    text-align: center;
}

.success-review-block {
    height: 250px;
    background: rgba(0, 0, 0, 0.9);
    position: absolute;
    left: 50%;
    bottom: 5%;
    transform: translate(-50%, -50%);
    z-index: 999;
    display: flex;
    align-items: center;
    border-radius: 1rem;
    border: 2px solid #ffc60b;
    cursor: pointer;
    width: 450px;
}

.success-review-window {
    width: 100%;
    text-align: center;
    color: #fff;
    font-size: 25px;
    font-weight: 600;
    font-family: "Montserrat", sans-serif;
}

.close-review-success {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #ffc60b;
}

@media (max-width: 450px) {
    .success-review-block {
        width: 95vw;
    }
}

@media (max-width: 1400px) {
    .gallery-image-block {
        width: 90vw;
    }

    .gallery-image-block .text-slider-desc {
        font-size: 20px;
    }

    .gallery-image-block .fa-quote-left,
    .gallery-image-block .fa-quote-right {
        font-size: 25px;
    }

    .gallery-image-block .text-slider-name {
        font-size: 23px;
    }

    .review-form-remark {
        width: 75%;
    }
}

@media (max-width: 991px) {
    .gallery-show-image {
        height: 40vh;
    }

    .gallery-image-block .text-slider-desc {
        font-size: 15px;
    }

    .gallery-image-block .fa-quote-left,
    .gallery-image-block .fa-quote-right {
        font-size: 20px;
    }

    .gallery-image-block .text-slider-name {
        font-size: 16px;
    }

    .review-form-remark {
        width: 100%;
    }
}

@media (max-width: 400px) {
    .gallery-show-image {
        height: 30vh;
    }
}
</style>
