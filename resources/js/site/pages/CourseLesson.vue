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
    </div>
</template>

<script>
export default {
    name: "CourseLesson",
    data() {
        return {
            user_id: null,
            chapter_title: "",
            lesson: {},
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
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            })
            .catch(function (response) {
                console.log(response);
            });
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

.lesson-content strong {
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
