<template>
    <div style="border: 3px black solid; background: url('http://puu.sh/IMyFm/a3dfa550ba.jpg'); height: 1000px">
        Welcome {{ name }}
    </div>
</template>

<script>
export default {
    name: "Books",
    data() {
        return {
            name: null,
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedIn) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
