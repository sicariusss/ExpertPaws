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
    </div>
</template>

<script>
export default {
    name: "CourseMain",
    data() {
        return {
            course: {},
            chapters: {},
            user_id: null,
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
                    if (user_courses.find(x => x.slug === to.params.slug) !== undefined) {
                        axios.get(base_url + '/api/courses/' + to.params.slug)
                            .then(function (response) {
                                document.title = response.data.course.title + ' - Expert Paws';
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

<style scoped>

</style>
