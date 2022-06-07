<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Покупка курса
            </div>
        </div>
        <div class="row pb-4">
            <div class="component-title-max">
                Завершение
            </div>
        </div>
        <div class="row justify-content-center mt-3 mb-5">
            <div class="purrchase-title">
                Спасибо за покупку!
            </div>
            <div class="purrchase-desc">
                Чек отправлен на указанную Вами почту
            </div>
        </div>

        <!--            <div>-->
        <!--                Курс уже доступен Вам!-->
        <!--                <router-link to="/my-courses">Перейти к моим курсам</router-link>-->
        <!--            </div>-->
        <div class="row justify-content-center my-4">
            <div class="receipt col-sm-10 col-md-8 col-lg-4">
                <h2 class="receipt-title">Expert Paws</h2>
                <p class="receipt-subtitle">{{ user.surname + ' ' + user.name + ' ' + user.patronymic }}</p>
                <p class="receipt-subtitle">{{ user.email }}</p>
                <ul class="receipt-lines">
                    <li class="receipt-line">
                        <span class="receipt-line-item">Курс: {{ course.title }}</span>
                        <span class="receipt-line-price">{{ course.price }} ₽</span>
                    </li>
                </ul>
                <p class="receipt-total">
                    <span class="receipt-total-item">Итого</span>
                    <span class="receipt-total-price">{{ course.price }} ₽</span>
                </p>
                <p class="receipt-back">
                    <a href="#">Перейти к курсу</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Purchase",
    data() {
        return {
            course: {},
            user_id: null,
            user: {},
            surname: "",
            name: "",
            patronymic: "",
            email: "",
        }
    },
    created() {

        let app = this;
        let base_url = window.location.origin;

        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null

            axios.get(base_url + '/api/users/' + this.user_id)
                .then(function (response) {
                    app.user = response.data.user[0];
                    app.surname = app.user.surname ?? ''
                    app.name = app.user.name ?? ''
                    app.patronymic = app.user.patronymic ?? ''
                    app.email = app.user.email ?? '-'
                })
                .catch(function (response) {
                    console.log(response);
                });
        }

        axios.get(base_url + '/api/courses/' + this.$route.params.slug)
            .then(function (response) {
                app.course = response.data.course;
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.authenticated) {
            return next('/');
        }

        document.title = to.name;
        next();
    }
}
</script>

<style>

.purrchase-title {
    font-size: 40px;
    font-family: "Raleway", sans-serif;
    text-align: center;
    font-weight: 700;
    color: #ffc60b;
}

.purrchase-desc {
    font-size: 22px;
    font-family: "Raleway", sans-serif;
    text-align: center;
    font-weight: 600;
}

.receipt {
    color: black;
    position: relative;
    flex: none;
    padding: 30px 0;
    background: #fff;
    font-family: "Raleway", sans-serif;
    font-weight: 600;
    clip-path: polygon(100% 0, 100% calc(100% - 6px), 98% 100%, 96% calc(100% - 6px), 94% 100%, 92% calc(100% - 6px), 90% 100%, 88% calc(100% - 6px), 86% 100%, 84% calc(100% - 6px), 82% 100%, 80% calc(100% - 6px), 78% 100%, 76% calc(100% - 6px), 74% 100%, 72% calc(100% - 6px), 70% 100%, 68% calc(100% - 6px), 66% 100%, 64% calc(100% - 6px), 62% 100%, 60% calc(100% - 6px), 58% 100%, 56% calc(100% - 6px), 54% 100%, 52% calc(100% - 6px), 50% 100%, 48% calc(100% - 6px), 46% 100%, 44% calc(100% - 6px), 42% 100%, 40% calc(100% - 6px), 38% 100%, 36% calc(100% - 6px), 34% 100%, 32% calc(100% - 6px), 30% 100%, 28% calc(100% - 6px), 26% 100%, 24% calc(100% - 6px), 22% 100%, 20% calc(100% - 6px), 18% 100%, 16% calc(100% - 6px), 14% 100%, 12% calc(100% - 6px), 10% 100%, 8% calc(100% - 6px), 6% 100%, 4% calc(100% - 6px), 2% 100%, 0 calc(100% - 6px), 0 0);
}

.receipt-title {
    margin-bottom: 15px;
    padding: 0 30px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    font-size: 40px;
    color: #00b09b;
}

.receipt-subtitle {
    padding: 0 30px;
    font-family: 'Work Sans', sans-serif;
    font-weight: 300;
    font-size: 18px;
}

.receipt-lines {
    margin-top: 50px;
    padding: 30px;
    border-top: 1px dashed #dce2d6;
}

.receipt-line {
    display: flex;
    margin: 20px 0;
    justify-content: space-between;
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 18px;
}

.receipt-line-item {
    font-weight: 300;
}

.receipt-line-price {
    font-weight: 400;
}

.receipt-total {
    display: flex;
    margin: 20px 0;
    padding: 30px;
    justify-content: space-between;
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 24px;
    background-color: #eff7e8;
}

.receipt-total-item, .receipt-total-price {
    font-weight: 400;
}

.receipt-back {
    text-align: center;
}

</style>
