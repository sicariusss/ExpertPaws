<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Обучение
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Курсы
            </div>
        </div>
        <div class="row mb-5 mt-3">
            <div class="col-12">
                <div class="courses-block-item" v-for="course in courses">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <img class="courses-block-item-image" :src="course.preview" alt="course-preview">
                        </div>
                        <div class="col-lg-6 d-flex flex-column justify-content-between mt-4 mt-lg-0">
                            <div class="row">
                                <div class="course-block-item-title">
                                    {{ course.title }}
                                </div>
                                <div class="course-block-item-desc my-3">
                                    {{ course.short_description }}
                                </div>
                                <div class="course-block-item-props">
                                    <ul>
                                        <li>
                                            Специальность: {{ course.school }}
                                        </li>
                                        <li>
                                            Объем программы: {{ course.hours }} часов
                                        </li>
                                        <li>
                                            Цена: {{ course.price }} ₽
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row justify-content-lg-end">
                                <div class="col-auto">
                                    <router-link :to="course.slug" class="course-block-item-link">Подробнее о
                                        курсе...
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

.courses-block-item {
    padding: 20px;
    background: rgba(255, 255, 255, 0.08);
    width: 100%;
    color: #fff;
    margin-top: 5px;
    border-left: 2px solid rgba(255, 255, 255, 0.2);
    position: relative;
    z-index: 0;
}

.courses-block-item ul {
    padding-left: 20px;
}

.courses-block-item ul li {
    padding-bottom: 10px;
}

.courses-block-item::before {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    border-radius: 50px;
    left: -9px;
    top: 0;
    background: #ffc60b;
    border: 2px solid #ffc60b;
}

.courses-block-item-image {
    width: 100%;
    border-radius: 1rem;
    max-height: 400px;
    object-fit: cover;
}

.course-block-item-title {
    font-size: 30px;
    font-weight: 600;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
}

.course-block-item-desc {
    font-size: 18px;
    font-family: "Raleway", sans-serif;
}

.course-block-item-props {
    font-size: 17px;
    font-family: "Raleway", sans-serif;
}

.course-block-item-link {
    text-decoration: none;
    font-size: 20px;
    font-weight: 500;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
    transition: ease-in-out 0.3s;
    position: relative;
}

.course-block-item-link:after {
    display: block;
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -5px;
    background-color: #ffc60b;
    visibility: hidden;
    transition: all 0.3s ease-in-out 0s;
}

.course-block-item-link:hover:after {
    visibility: visible;
    width: 60%;
}

.course-block-item-link:hover, .course-block-item-link:focus {
    color: #fff;
}
</style>

<script>
export default {
    name: "Courses",
    data() {
        return {
            user_id: null,
            courses: {},
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null
        }
    },
    mounted() {
        let app = this;
        axios.get('api/courses')
            .then(function (response) {
                app.courses = response.data.courses;
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
