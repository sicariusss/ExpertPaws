<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Курсы
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                {{course.title}}
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
            user_id: null,
        }
    },
    beforeCreate() {
        let app = this;
        axios.get('api/courses/' + this.$route.params.slug)
            .then(function (response) {
                app.course = response.data.course;
                document.title = 'Курс "' + app.course.title + '" - Expert Paws';
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

</style>
