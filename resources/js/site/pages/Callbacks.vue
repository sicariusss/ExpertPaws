<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Обратная связь
            </div>
        </div>
        <div class="row pb-4">
            <div class="component-title-max">
                Мои обращения
            </div>
        </div>
        <div class="row" v-if="callbacks.length">
            <div class="col-12">
                <div class="callback-block" v-for="callback in callbacks">
                    <div class="callback-block-title">
                        {{ 'Обращение за ' + new Date(callback.created_at).toLocaleDateString() }}
                    </div>
                    <div class="callback-block-date my-2">
                        {{ new Date(callback.created_at).toLocaleTimeString() }}
                    </div>
                    <ul>
                        <li>
                            {{ 'Имя: ' + callback.name }}
                        </li>
                        <li>
                            {{ 'Email: ' + callback.email }}
                        </li>
                        <li>
                            {{ 'Тема: ' + callback.subject }}
                        </li>
                    </ul>
                    <p>
                        {{ callback.message }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center py-5" v-else>
            <div class="col-auto py-5 no-callbacks text-center">
                У вас нету обращений <br>
                <router-link to="/contacts">Хотите связаться с нами?
                </router-link>
            </div>
            <div style="width: min-content; text-align: center; display:none">
                ———————————No callbacks?———————————
                ⠀⣞⢽⢪⢣⢣⢣⢫⡺⡵⣝⡮⣗⢷⢽⢽⢽⣮⡷⡽⣜⣜⢮⢺⣜⢷⢽⢝⡽⣝
                ⠸⡸⠜⠕⠕⠁⢁⢇⢏⢽⢺⣪⡳⡝⣎⣏⢯⢞⡿⣟⣷⣳⢯⡷⣽⢽⢯⣳⣫⠇
                ⠀⠀⢀⢀⢄⢬⢪⡪⡎⣆⡈⠚⠜⠕⠇⠗⠝⢕⢯⢫⣞⣯⣿⣻⡽⣏⢗⣗⠏⠀
                ⠀⠪⡪⡪⣪⢪⢺⢸⢢⢓⢆⢤⢀⠀⠀⠀⠀⠈⢊⢞⡾⣿⡯⣏⢮⠷⠁⠀⠀
                ⠀⠀⠀⠈⠊⠆⡃⠕⢕⢇⢇⢇⢇⢇⢏⢎⢎⢆⢄⠀⢑⣽⣿⢝⠲⠉⠀⠀⠀⠀
                ⠀⠀⠀⠀⠀⡿⠂⠠⠀⡇⢇⠕⢈⣀⠀⠁⠡⠣⡣⡫⣂⣿⠯⢪⠰⠂⠀⠀⠀⠀
                ⠀⠀⠀⠀⡦⡙⡂⢀⢤⢣⠣⡈⣾⡃⠠⠄⠀⡄⢱⣌⣶⢏⢊⠂⠀⠀⠀⠀⠀⠀
                ⠀⠀⠀⠀⢝⡲⣜⡮⡏⢎⢌⢂⠙⠢⠐⢀⢘⢵⣽⣿⡿⠁⠁⠀⠀⠀⠀⠀⠀⠀
                ⠀⠀⠀⠀⠨⣺⡺⡕⡕⡱⡑⡆⡕⡅⡕⡜⡼⢽⡻⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                ⠀⠀⠀⠀⣼⣳⣫⣾⣵⣗⡵⡱⡡⢣⢑⢕⢜⢕⡝⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                ⠀⠀⠀⣴⣿⣾⣿⣿⣿⡿⡽⡑⢌⠪⡢⡣⣣⡟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                ⠀⠀⠀⡟⡾⣿⢿⢿⢵⣽⣾⣼⣘⢸⢸⣞⡟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                ⠀⠀⠀⠀⠁⠇⠡⠩⡫⢿⣝⡻⡮⣒⢽⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
                —————————————————————————————
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Callbacks",
    data() {
        return {
            user_id: null,
            callbacks: [],
        }
    },
    created() {
        if (window.Laravel.authenticated) {
            this.user_id = window.Laravel.auth_id ?? null
        }
    },
    mounted() {
        let app = this;
        axios.get('api/callbacks/' + this.user_id)
            .then(function (response) {
                app.callbacks = response.data.callbacks;
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.authenticated) {
            window.location.href = "/";
        }
        document.title = to.name;
        next();
    }
}
</script>

<style>
.callback-block {
    padding: 0 0 20px 20px;
    margin-top: -2px;
    border-left: 2px solid rgba(255, 255, 255, 0.2);
    position: relative;
}

.callback-block ul {
    padding-left: 20px;
}

.callback-block ul li {
    padding-bottom: 10px;
}

.callback-block::before {
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

.callback-block-title {
    line-height: 18px;
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
    color: #ffc60b;
    margin-bottom: 10px;
}

.callback-block-date {
    font-size: 16px;
    background: rgba(255, 255, 255, 0.15);
    padding: 5px 15px;
    display: inline-block;
    font-weight: 600;
    margin-bottom: 10px;
    font-family: "Raleway", sans-serif;
}

.no-callbacks {
    font-size: 25px;
    font-weight: 500;
    font-family: "Montserrat", sans-serif;
    color: #fff;
}

.no-callbacks a {
    color: #ffc60b;
    text-decoration: none;
}
</style>
