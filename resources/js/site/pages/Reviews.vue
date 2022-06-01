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
        <div class="mt-5">
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
                                        ? review.user.surname + ' ' + review.user.name ?? 'Анонимный котик'
                                        : 'Анонимный котик'
                                }}
                            </div>
                        </div>
                    </div>
                </SplideSlide>
            </Splide>
        </div>
        <div class="my-5">
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
                                                        ? item.user.surname + ' ' + item.user.name ?? 'Анонимный котик'
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
    </div>
</template>

<script>

import {Splide, SplideSlide} from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';

export default {
    name: "Reviews",
    components: {
        Splide,
        SplideSlide,
    },
    data() {
        return {
            reviews: {},
            gallery: {},
            show: [],
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
                },
            }
        };

        return {textOptions};
    },
    mounted() {
        let app = this;
        axios.get('api/reviews')
            .then(function (response) {
                app.reviews = response.data.reviews;
                console.log(app.reviews)
            })
            .catch(function (response) {
                console.log(response);
            });
        axios.get('api/gallery')
            .then(function (response) {
                app.gallery = response.data.gallery;
                console.log(app.gallery)
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
    z-index: 900;
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

@media (max-width: 1400px) {
    .gallery-image-block {
        width: 90vw;
    }

    .gallery-image-block .text-slider-desc {
        font-size: 20px;
    }

    .gallery-image-block .fa-quote-left {
        font-size: 25px;
    }

    .gallery-image-block .fa-quote-right {
        font-size: 25px;
    }

    .gallery-image-block .text-slider-name {
        font-size: 23px;
    }
}

@media (max-width: 991px) {
    .gallery-show-image {
        height: 40vh;
    }

    .gallery-image-block .text-slider-desc {
        font-size: 15px;
    }

    .gallery-image-block .fa-quote-left {
        font-size: 20px;
    }

    .gallery-image-block .fa-quote-right {
        font-size: 20px;
    }

    .gallery-image-block .text-slider-name {
        font-size: 16px;
    }
}

@media (max-width: 400px) {
    .gallery-show-image {
        height: 30vh;
    }
}
</style>
