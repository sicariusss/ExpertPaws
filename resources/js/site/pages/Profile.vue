<template>
    <div class="component-block">
        <div class="row">
            <div class="component-title-mini">
                Аккаунт
            </div>
        </div>
        <div class="row">
            <div class="component-title-max">
                Мой профиль
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4">
                <img class="user-profile-image" :src="photo" alt="Аватар">
            </div>
            <div class="col-lg-8">
                <div class="user-profile-name">
                    {{ surname + ' ' + name + ' ' + patronymic }}
                </div>
                <div class="user-profile-role mt-1 mb-3">
                    {{ role }}
                </div>
                <div class="row user-profile-info">
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Email:</b> {{email}}
                    </div>
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Телефон:</b> {{phone}}
                    </div>
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Адрес:</b> {{address}}
                    </div>
                    <div class="col-12">
                        <i class="fas fa-angle-right"></i> <b>Регистрация:</b> {{createdAt}}
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
            address: '',
        }
    },
    created() {
        if (window.Laravel.user) {
            this.user = window.Laravel.user
            this.surname = window.Laravel.user.surname ?? ''
            this.name = window.Laravel.user.name
            this.patronymic = window.Laravel.user.patronymic ?? ''
            this.photo = window.Laravel.user.photo
            this.role = window.Laravel.user.role_id === 1 ? 'Администратор' : window.Laravel.user.role_id === 2 ? 'Разработчик'
                : window.Laravel.user.role_id === 3 ? 'Менеджер' : window.Laravel.user.role_id === 4 ? 'Пользователь' : ''
            this.createdAt = new Date(window.Laravel.user.created_at).toLocaleDateString()
            this.email = window.Laravel.user.email ?? '-'
            this.phone = window.Laravel.user.phone ?? '-'
            this.address = window.Laravel.user.address ?? '-'
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
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    font-family: "Montserrat", sans-serif;
}
</style>
