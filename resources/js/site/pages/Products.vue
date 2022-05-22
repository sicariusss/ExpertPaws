<template>
    <div style="border: 3px black solid; background: url('http://puu.sh/IMyFm/a3dfa550ba.jpg'); height: 1000px">
        Welcome {{ name }}
    </div>
</template>

<script>
export default {
    name: "Products",
    data() {
        return {
            name: null,
            users: [],
        }
    },
    mounted() {
        let app = this;
        axios.get('api/users')
            .then(function (response) {
                app.users = response.data.users;
            })
            .catch(function (response) {
                console.log(response);
            });
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    },
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>
