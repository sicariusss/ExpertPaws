<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Курс
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-lg-center align-items-center">
                <div class="course-title text-center my-5 my-lg-0">
                    {{ course.title }}
                </div>
            </div>
            <div class="col-lg-6">
                <img class="course-image" :src="course.preview" alt="course-image">
            </div>
        </div>
        <div class="row justify-content-center align-items-center px-3 px-sm-5 px-lg-0 mt-5 pt-lg-5 mb-5">
            <div
                class="col-md-6 col-lg-3 p-3 p-md-5 p-lg-0 d-flex flex-column justify-content-center align-items-center position-relative props-col-1">
                <i class="props-icons fa-solid fa-calendar-day"></i>
                <div class="props-title mt-4 mb-2">
                    Старт курса
                </div>
                <div class="props-desc">
                    Сразу после покупки
                </div>
            </div>
            <div
                class="col-md-6 col-lg-3 p-3 p-md-5 p-lg-0 d-flex flex-column justify-content-center align-items-center position-relative props-col-2">
                <i class="props-icons fa-solid fa-book-open-reader"></i>
                <div class="props-title mt-4 mb-2">
                    Формат курса
                </div>
                <div class="props-desc">
                    Текстовый материал
                </div>
            </div>
            <div
                class="col-md-6 col-lg-3 p-3 p-md-5 p-lg-0 d-flex flex-column justify-content-center align-items-center position-relative props-col-3">
                <i class="props-icons fa-solid fa-clock"></i>
                <div class="props-title mt-4 mb-2">
                    Объем курса
                </div>
                <div class="props-desc">
                    {{ course.hours + ' часов' }}
                </div>
            </div>
            <div
                class="col-md-6 col-lg-3 p-3 p-md-5 p-lg-0 d-flex flex-column justify-content-center align-items-center position-relative">
                <i class="props-icons fa-solid fa-graduation-cap"></i>
                <div class="props-title mt-4 mb-2">
                    Специальность
                </div>
                <div class="props-desc">
                    {{ course.school }}
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="course-description p-3 p-lg-4" v-html="course.full_description"></div>
        </div>
        <div class="row justify-content-center align-items-center py-3">
            <div class="course-program-block" v-if="chapters.length">
                <div class="course-program-title text-center my-3">
                    Программа курса
                </div>
                <div class="row justify-content-center align-items-stretch">
                    <div class="chapter-item mx-3" v-for="chapter in chapters">
                        <img class="chapter-item-image" :src="chapter.icon" alt="chapter-image">
                        <div class="chapter-item-title">
                            {{ chapter.title }}
                        </div>
                        <div class="chapter-item-lessons mt-2 ms-2">
                            <div v-for="lesson in chapter.lessons">
                                • {{ lesson.title }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else-if="!chapters.length">
                <div class="row justify-content-center my-5">
                    <div class="col-md-10 col-lg-6 no-chapters text-center p-4">
                        Курс скоро появится! Зайдите, пожалуйста, попозже или
                        <router-link to="/contacts">напишите нам</router-link>
                        , чтобы узнать больше.
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-5" v-if="chapters.length">
            <div class="course-question col-auto text-center">
                Остались вопросы?
                <router-link to="/contacts">Напишите нам!</router-link>
            </div>
        </div>
        <div class="row justify-content-center my-5" v-if="chapters.length">
            <div class="my-3 col-auto">
                <router-link :to="'/' + course.slug + '/buy'" class="course-price">
                    <div class="course-price-box">
                        <div class="course-box-text">
                            <div>
                                Купить курс
                            </div>
                            <div>
                                Цена: {{ course.price }} ₽
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Course",
    data() {
        return {
            course: {},
            chapters: {},
            user_id: null,
        }
    },
    beforeCreate() {
        let app = this;
        axios.get('api/courses/' + this.$route.params.slug)
            .then(function (response) {
                app.course = response.data.course;
                document.title = 'Курс "' + app.course.title + '" - Expert Paws';
                axios.get('api/chapters/' + app.course.id)
                    .then(function (response) {
                        app.chapters = response.data.chapters;
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null
        }
    },
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>

<style>
.course-title {
    font-size: 40px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #fff;
    transition: ease-in-out 0.3s;
}

.course-image {
    width: 100%;
    border-radius: 1rem;
    max-height: 500px;
    object-fit: cover;
}

.props-icons {
    color: #ffc60b;
    font-size: 3rem;
}

.props-title {
    font-size: 20px;
    font-weight: 600;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
    text-align: center;
}

.props-desc {
    font-size: 18px;
    font-family: "Raleway", sans-serif;
    text-align: center;
}

.props-col-1, .props-col-2, .props-col-3 {
    border-right: 2px solid #ffc60b;
}

.course-description {
    font-size: 20px;
    font-weight: 500;
    font-family: "Raleway", sans-serif;
}

.course-program-title {
    font-size: 40px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
}

.chapter-item {
    width: 350px;
    border-radius: 1rem;
    border: 2px solid #ffc60b;
    background: rgba(255, 255, 255, 0.08);
    position: relative;
    padding: 4rem 1rem 1rem;
    margin-top: 70px;
}

.chapter-item-image {
    width: 90px;
    position: absolute;
    top: -3rem;
    left: 130px;
}

.chapter-item-title {
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
    text-align: center;
}

.chapter-item-lessons {
    font-size: 16px;
    font-weight: 500;
    font-family: "Raleway", sans-serif;
}

.no-chapters {
    border-radius: 1rem;
    border: 2px solid #ffc60b;
    font-size: 18px;
    font-family: "Raleway", sans-serif;
    font-weight: 500;
}

.no-chapters a {
    color: #ffc60b;
    font-weight: bold;
}

.course-question {
    font-size: 26px;
    font-family: "Raleway", sans-serif;
    font-weight: 600;
}

.course-question a {
    color: #ffc60b;
    font-weight: 700;
}

.course-price {
    color: #ffc60b;
    font-size: 30px;
    font-family: "Montserrat", sans-serif;
    font-weight: 700;
    text-decoration: none;
    transition: ease-in-out 0.3s;
}

.course-price:hover {
    color: #fff;
    transition: ease-in-out 0.3s;
}

.course-price-box {
    position: relative;
    display: flex;
    align-items: center;
    padding: 2rem 5rem;
    background: rgb(255 255 255 / 11%);
    transition: ease-in-out 0.3s;
    cursor: pointer;
    border-radius: 5px;
}

.course-price-box::before {
    position: absolute;
    content: "";
    left: -15px;
    top: -15px;
    height: 100%;
    width: 100%;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 5px;
    transition: all 0.3s ease-out 0s;
    transform: translateZ(-1px);
}

.course-box-text {
    margin-top: -15px;
    margin-left: -15px;
}

@media (max-width: 991px) {
    .props-col-2 {
        border-right: none;
        border-bottom: 2px solid #ffc60b;
    }

    .props-col-1 {
        border-bottom: 2px solid #ffc60b;
    }
}

@media (max-width: 767px) {
    .props-col-3 {
        border-right: none;
        border-bottom: 2px solid #ffc60b;
    }

    .props-col-1 {
        border-right: none;
        border-bottom: 2px solid #ffc60b;
    }
}

@media (max-width: 450px) {
    .course-price {
        font-size: 25px;
        font-weight: 600;
    }

    .course-price-box {
        padding: 2rem 3rem;
    }

    .chapter-item-image {
        left: 35%;
    }
}
</style>
