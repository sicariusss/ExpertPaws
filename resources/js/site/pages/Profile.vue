<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Аккаунт
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-auto component-title-max">
                Мой профиль
            </div>
            <div class="col-auto user-profile-edit my-4 my-lg-0">
                <router-link to="/profile-edit">
                    <div class="user-profile-edit-link">
                        Редактировать
                    </div>
                </router-link>
            </div>
        </div>
        <div class="row mt-3 pb-5">
            <div class="col-lg-4">
                <img class="user-profile-image" :src="photo" alt="Аватар">
            </div>
            <div class="col-lg-8">
                <div class="user-profile-name pt-3 px-lg-5">
                    {{ surname + ' ' + name + ' ' + patronymic }}
                </div>
                <div class="user-profile-role mt-1 mb-3 px-lg-5">
                    {{ role }}
                </div>
                <div class="row user-profile-info px-lg-5">
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Email:</b> {{ email }}
                    </div>
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Телефон:</b> {{ phone }}
                    </div>
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Адрес:</b> {{ address }}
                    </div>
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Регистрация:</b> {{ createdAt }}
                    </div>
                </div>
                <div class="user-profile-links mt-3 mt-lg-5">
                    <div class="row justify-content-evenly pt-lg-5">
                        <div class="col-lg-5 mt-3 mt-lg-0">
                            <router-link to="/my-courses">
                                <div class="user-profile-link-box">
                                    <i class="fa-solid fa-book-open fa-xl"></i>
                                    Мои курсы
                                </div>
                            </router-link>
                        </div>
                        <div class="col-lg-5 mt-3 mt-lg-0">
                            <router-link to="/callbacks">
                                <div class="user-profile-link-box">
                                    <i class="fa-solid fa-comment-dots fa-xl"></i>
                                    Мои обращения
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
    data() {
        return {
            user: {},
            surname: '',
            name: '',
            patronymic: '',
            photo: '',
            createdAt: '',
            role: '',
            email: '',
            phone: '',
            address: ''
        }
    },
    created() {
        if (window.Laravel.authenticated) {

            this.user_id = window.Laravel.auth_id ?? null

            let app = this;
            axios.get('api/users/' + this.user_id)
                .then(function (response) {
                    app.user = response.data.user[0];
                    app.surname = app.user.surname ?? ''
                    app.name = app.user.name ?? ''
                    app.patronymic = app.user.patronymic ?? ''
                    app.photo = app.user.photo ?? ''
                    app.role = app.user.role_id === 1 ? 'Администратор' : app.user.role_id === 2 ? 'Разработчик'
                        : app.user.role_id === 3 ? 'Менеджер' : app.user.role_id === 4 ? 'Пользователь' : ''
                    app.createdAt = new Date(app.user.created_at).toLocaleDateString()
                    app.email = app.user.email ?? '-'
                    app.phone = app.user.phone ?? '-'
                    app.address = app.user.address ?? '-'
                })
                .catch(function (response) {
                    console.error(response);
                });
        }
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
.user-profile-image {
    border-radius: 15px;
    border: 2px solid #ffc60b;
    width: 100%;
}

.user-profile-name {
    font-weight: 700;
    font-size: 26px;
    color: #ffc60b;
    font-family: "Raleway", sans-serif;
}

.user-profile-info {
    font-size: 18px;
    font-weight: 500;
    color: #fff;
    font-family: "Montserrat", sans-serif;
}

.user-profile-info svg {
    color: #ffc60b;
}

.user-profile-role {
    font-size: 18px;
    font-weight: 600;
    color: #fff;
    font-family: "Montserrat", sans-serif;
}

.user-profile-links {
    font-family: "Raleway", sans-serif;
    font-weight: 700;
    line-height: 1;
    font-size: 16px;
    color: #fff;
}

.user-profile-links a {
    text-decoration: none;
    color: #fff;
}

.user-profile-link-box {
    position: relative;
    display: flex;
    align-items: center;
    padding: 17px 20px 25px 20px;
    background: rgb(255 255 255 / 11%);
    transition: ease-in-out 0.3s;
    cursor: pointer;
    border-radius: 5px;
}

.user-profile-link-box svg {
    padding-right: 20px;
    color: rgb(255 198 11 / 86%);
}

.user-profile-link-box::before {
    position: absolute;
    content: "";
    left: -8px;
    top: -8px;
    height: 100%;
    width: 100%;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 5px;
    transition: all 0.3s ease-out 0s;
    transform: translateZ(-1px);
}

.user-profile-edit {
    font-family: "Raleway", sans-serif;
    font-weight: 700;
    line-height: 1;
    font-size: 16px;
    color: #fff;
    margin-right: 20px;
}

.user-profile-edit-link {
    position: relative;
    display: flex;
    align-items: center;
    padding: 17px 27px 25px 20px;
    background: rgb(255 255 255 / 11%);
    transition: ease-in-out 0.3s;
    cursor: pointer;
    border-radius: 5px;
}

.user-profile-edit a {
    text-decoration: none;
    color: #fff;
}

.user-profile-edit-link::before {
    position: absolute;
    content: "";
    left: -8px;
    top: -8px;
    height: 100%;
    width: 100%;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 5px;
    transition: all 0.3s ease-out 0s;
    transform: translateZ(-1px);
}
</style>
