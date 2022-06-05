<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Покупка курса
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Оплата
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="selling-note">
                Введите данные своей карты
            </div>
        </div>
        <div class="row justify-content-center align-items-end mb-5">
            <div class="col-auto">
                <form>
                    <div class="payment-form mt-3">
                        <div class="form-group row mt-lg-3">
                            <div class="col-lg-12 mt-3 mt-lg-0">
                                <input type="number" class="form-control" id="cardnumber" v-model="cardnumber" required
                                       placeholder="0000 0000 0000 0000">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="carddate" v-model="carddate" required
                                       placeholder="ММ/ГГ">
                            </div>
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <input type="number" class="form-control" id="cardcode" v-model="cardcode" required
                                       placeholder="CCV">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-3 mt-lg-0">
                                <input type="text" class="form-control" id="cardname" v-model="cardname" required
                                       placeholder="IVANOV IVAN" style="text-transform: uppercase;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mt-5">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-paw px-4 px-lg-5" @click="handleSubmit">
                                Оплатить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Selling",
    data() {
        return {
            course: {},
            user_id: null,
            cardnumber: "",
            carddate: "",
            cardname: "",
            cardcode: "",
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id
        }
    },
    beforeCreate() {
        let app = this;
        let base_url = window.location.origin;
        axios.get(base_url + '/api/courses/' + this.$route.params.slug)
            .then(function (response) {
                app.course = response.data.course;
                document.title = 'Оплата курса "' + app.course.title + '" - Expert Paws';
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.cardname.length > 0 && this.cardnumber.length > 0 && this.carddate.length > 0 && this.cardcode.length > 0) {
                this.$router.push('/about');
            }
        }
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
.selling-note {
    font-size: 30px;
    font-family: "Raleway", sans-serif;
    text-align: center;
}

.payment-form {
    width: 30rem;
    height: 17rem;
    border-radius: 1rem;
    border: 2px solid #ffc60b;
    background: rgba(255, 255, 255, 0.08);
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}

.payment-form input {
    padding: 10px 15px;
    border-radius: 0;
    box-shadow: none;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.08);
    border: 0;
    transition: 0.3s;
    color: #fff;
}

.payment-form input:focus {
    background-color: rgba(255, 255, 255, 0.11);
    color: #fff;
    border: 0;
    box-shadow: none;
}

@media (max-width: 550px) {
    .payment-form {
        width: 100%;
        padding: 1rem;
    }
}
</style>
