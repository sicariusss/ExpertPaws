<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Обучение
            </div>
        </div>
        <div class="row pb-4">
            <div class="component-title-max">
                {{ course.title }}
            </div>
        </div>
        <div class="row py-3">
            <div class="last-progress">
                Ваш прогресс:
                <router-link v-if="last_progress"
                             :to="'/course/' + this.$route.params.slug + '/' + lastChapterSlug(last_progress) + '/' + last_progress.lesson.slug">
                    {{ last_str }}
                </router-link>
            </div>
        </div>
        <div class="row my-3 mx-1">
            <div class="col-12">
                <div class="lessons-block" v-for="chapter in chapters">
                    <div class="lessons-block-title">
                        {{ chapter.title }}
                    </div>
                    <div class="lessons-block-progress my-2">
                        {{ percentProgress(chapter) + '%' }}
                    </div>
                    <ul>
                        <li v-for="lesson in chapter.lessons">
                            <div v-if="isActive(lesson)">
                                <router-link
                                    :to="'/course/' + this.$route.params.slug + '/'+ chapter.slug +'/' + lesson.slug">
                                    {{ lesson.title }}
                                </router-link>
                            </div>
                            <div v-else-if="!(isActive(lesson))">
                                {{ lesson.title }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CourseMain",
    data() {
        return {
            course: {},
            chapters: {},
            progresses: {},
            user_id: null,
            last_progress: null,
            last_str: ""
        }
    },
    created() {
        let app = this;
        let base_url = window.location.origin;

        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null
        }

        axios.get(base_url + '/api/courses/' + this.$route.params.slug)
            .then(function (response) {
                app.course = response.data.course;
                axios.get(base_url + '/api/chapters/' + app.course.id)
                    .then(function (response) {
                        app.chapters = response.data.chapters;
                        axios.get(base_url + '/api/progresses/' + app.course.id + '/' + app.user_id)
                            .then(function (response) {
                                app.progresses = response.data.progresses;
                                app.last_progress = response.data.last_progress.last_model;
                                app.last_str = response.data.last_progress.last_str;
                            })
                            .catch(function (response) {
                                console.error(response);
                            });
                    })
                    .catch(function (response) {
                        console.error(response);
                    });
            })
            .catch(function (response) {
                console.error(response);
            });
    },
    methods: {
        isActive(lesson) {
            let progresses = Array.from(this.progresses);
            return progresses.find(x => x.lesson_id === lesson.id) !== undefined;
        },
        percentProgress(chapter) {
            let percent = 0;
            let lessons = chapter.lessons;
            let lessonValue = (100 / Number(lessons.length));
            lessons.forEach(lesson => {
                let progresses = Array.from(this.progresses);
                if (progresses.find(x => x.lesson_id === lesson.id) !== undefined) {
                    percent = Number(percent) + Number(lessonValue);
                }
            })
            return Math.round(percent);
        },
        lastChapterSlug(lastProgress) {
            let chapterId = lastProgress.lesson.chapter_id;
            let chapters = Array.from(this.chapters);
            let chapterSlug = '';
            chapters.forEach(chapter => {
                if (chapter.id === chapterId) {
                    chapterSlug = chapter.slug;
                }
            })
            return chapterSlug;
        },
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.authenticated) {
            return next('/');
        } else {
            let base_url = window.location.origin;
            axios.get(base_url + '/api/user/courses/' + window.Laravel.auth_id)
                .then(function (response) {
                    let user_courses = response.data.user_courses;
                    if (user_courses.find(x => x.slug === to.params.slug) !== undefined) {
                        axios.get(base_url + '/api/courses/' + to.params.slug)
                            .then(function (response) {
                                document.title = response.data.course.title + ' - Expert Paws';
                            })
                            .catch(function (response) {
                                console.error(response);
                            });
                        next();
                    } else {
                        return next('/');
                    }
                })
                .catch(function (response) {
                    console.error(response);
                });
        }
    }
}
</script>

<style>
.last-progress {
    font-weight: 600;
    font-size: 24px;
    color: #ffc60b;
    font-family: "Raleway", sans-serif;
}

.last-progress a {
    color: #ffc60b;
}

.lessons-block {
    padding: 0 0 20px 20px;
    margin-top: -2px;
    border-left: 2px solid rgba(255, 255, 255, 0.2);
    position: relative;
}

.lessons-block ul {
    padding-left: 20px;
}

.lessons-block ul li {
    padding-bottom: 10px;
    font-size: 18px;
    font-weight: 600;
    font-family: "Raleway", sans-serif;
    color: rgb(255 255 255 / 60%);
}

.lessons-block ul li a {
    color: #fff;
}

.lessons-block::before {
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

.lessons-block-title {
    line-height: 18px;
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
    margin-bottom: 10px;
}

.lessons-block-progress {
    font-size: 16px;
    background: rgba(255, 255, 255, 0.15);
    padding: 5px 15px;
    display: inline-block;
    font-weight: 600;
    margin-bottom: 10px;
    font-family: "Raleway", sans-serif;
}
</style>
