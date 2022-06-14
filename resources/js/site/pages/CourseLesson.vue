<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Обучение
            </div>
        </div>
        <div class="row py-4">
            <div class="lesson-title-mini">
                Глава: {{ chapter_title }}
            </div>
            <div class="lesson-title-max">
                {{ lesson.title }}
            </div>
        </div>
        <div class="my-4 lesson-content">
            {{ lesson.content }}
        </div>
        <div class="row py-4">
            <div class="lesson-title-questions">
                Контрольные вопросы
            </div>
            <div class="row my-3" v-for="question in questions">
                <div class="question-content">
                    Вопрос: {{ question.content }}
                </div>
                <div class="row" v-for="answer in question.answers">
                    <div class="col-auto px-3 px-lg-5">
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" :name="'radio-' + question.id"
                                   :id="'radio-' + answer.id">
                            <label class="form-check-label answer-content mx-3" :for="'radio-' + answer.id">
                                {{ answer.content }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-paw px-5" @click="handleSubmit">
                        Проверить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CourseLesson",
    data() {
        return {
            user_id: null,
            course_id: null,
            chapter_title: "",
            lesson: {},
            questions: {},
        }
    },
    created() {
        let app = this;
        let base_url = window.location.origin;

        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null
        }

        axios.get(base_url + '/api/lesson/' + this.$route.params.lessonSlug)
            .then(function (response) {
                app.lesson = response.data.lesson;
                axios.get(base_url + '/api/chapter/' + app.lesson.chapter_id)
                    .then(function (response) {
                        app.chapter_title = response.data.chapter.title;
                        app.course_id = response.data.chapter.course_id;
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
                axios.get(base_url + '/api/questions/' + app.lesson.id)
                    .then(function (response) {
                        app.questions = response.data.questions;
                        console.log(app.questions);
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            let app = this;
            let base_url = window.location.origin;
            axios.post(base_url + '/api/progress/set', {
                course_id: app.course_id,
                user_id: app.user_id,
                lesson_id: app.lesson.id,
            })
                .then(response => {
                    if (response.data.success) {
                        console.error(response);
                    } else {
                        this.error = response.data.message
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.authenticated) {
            return next('/');
        } else {
            let base_url = window.location.origin;
            axios.get(base_url + '/api/user/courses/' + window.Laravel.auth_id)
                .then(function (response) {
                    let user_courses = response.data.user_courses;
                    if (user_courses.find(x => x.slug === to.params.courseSlug) !== undefined) {
                        axios.get(base_url + '/api/lesson/' + to.params.lessonSlug)
                            .then(function (response) {
                                document.title = response.data.lesson.title + ' - Expert Paws';
                            })
                            .catch(function (response) {
                                console.log(response);
                            });
                        next();
                    } else {
                        return next('/');
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        }
    }
}
</script>

<style>
.lesson-title-mini {
    font-size: 18px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffffffcf;
    transition: ease-in-out 0.3s;
}

.lesson-title-max {
    font-size: 30px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #fff;
    transition: ease-in-out 0.3s;
}

.lesson-content {
    font-size: 22px;
    color: #fff;
    font-family: "Raleway", sans-serif;
}

.lesson-content b {
    color: #ffc60b;
}

.lesson-title-questions {
    font-size: 22px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #fff;
    transition: ease-in-out 0.3s;
}

.question-content {
    font-size: 22px;
    font-weight: 600;
    font-family: "Raleway", sans-serif;
    color: #fff;
    transition: ease-in-out 0.3s;
}

.answer-content {
    font-size: 22px;
    font-weight: 600;
    font-family: "Raleway", sans-serif;
    color: #fff;
    transition: ease-in-out 0.3s;
    cursor: pointer;
    margin-top: 5px;
}

.answer-content:hover {
    color: #ffc60b;
}

@media (max-width: 500px) {
    .lesson-title-mini {
        font-size: 16px;
    }

    .lesson-title-max {
        font-size: 24px;
    }
}
</style>
