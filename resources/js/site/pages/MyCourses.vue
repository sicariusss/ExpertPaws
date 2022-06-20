<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Обучение
            </div>
        </div>
        <div class="row pb-4">
            <div class="component-title-max">
                Мои курсы
            </div>
        </div>
        <div class="row mt-3 align-items-stretch justify-content-center" v-if="user_courses.length">
            <div class="my-courses-item p-0" :class="'my-item-' + user_courses.length" v-for="course in user_courses">
                <router-link class="my-courses-link" :to="'/course/' + course.slug">
                    <img class="my-courses-image" :src="course.preview" alt="course-preview">
                    <div class="p-4">
                        <div class="my-courses-title">
                            {{ course.title }}
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
        <div class="row justify-content-center py-5" v-else>
            <div class="col-auto py-5 no-courses text-center">
                Вы еще не купили ни одного курса <br>
                <router-link to="/courses">Начать обучение
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyCourses",
    data() {
        return {
            user_id: null,
            user_courses: {}
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null

            let app = this;
            let base_url = window.location.origin;
            axios.get(base_url + '/api/user/courses/' + this.user_id)
                .then(function (response) {
                    app.user_courses = response.data.user_courses;
                })
                .catch(function (response) {
                    console.error(response);
                });
        }
    },
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>

<style>
.my-courses-item {
    border-radius: 1rem;
    background: rgba(255, 255, 255, 0.08);
    overflow: hidden;
    margin-bottom: 5%;
}

.my-item-1 {
    margin-left: 5%;
    margin-right: 5%;
    width: 40%;
}

.my-item-2 {
    margin-left: 2%;
    margin-right: 2%;
    width: 46%;
}

.my-item-3 {
    margin-left: 1%;
    margin-right: 1%;
    width: 31%;
}

.my-courses-image {
    height: 350px;
    object-fit: cover;
    width: 100%;
}

.my-courses-title {
    font-size: 24px;
    font-weight: 600;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
    position: relative;
}

.my-courses-title:after {
    display: block;
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    background-color: #ffc60b;
    visibility: hidden;
    transition: all 0.3s ease-in-out 0s;
}

.my-courses-item:hover .my-courses-title:after {
    visibility: visible;
    width: 40%;
}

.my-courses-item:hover .my-courses-title, .my-courses-link:hover .my-courses-title {
    color: #fff;
}

.my-courses-link {
    text-decoration: none;
    width: 100%;
    height: 100%;
}

.no-courses {
    font-size: 25px;
    font-weight: 500;
    font-family: "Montserrat", sans-serif;
    color: #fff;
}

.no-courses a {
    color: #ffc60b;
    text-decoration: none;
}

@media (max-width: 1400px) {
    .my-item-1 {
        margin-left: 5%;
        margin-right: 5%;
        width: 50%;
    }
}

@media (max-width: 1200px) {
    .my-item-3 {
        margin-left: 2%;
        margin-right: 2%;
        width: 46%;
    }
}

@media (max-width: 991px) {
    .my-item-1 {
        margin-left: 5%;
        margin-right: 5%;
        width: 70%;
    }

    .my-item-2, .my-item-3 {
        margin-left: 5%;
        margin-right: 5%;
        width: 80%;
    }
}

@media (max-width: 767px) {
    .my-item-1, .my-item-2, .my-item-3 {
        margin-left: 3%;
        margin-right: 3%;
        width: 94%;
    }
}
</style>
