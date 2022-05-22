<template>
    <div>
        Homepage
    </div>
</template>

<style>
</style>

<script>
export default {
    name: "Home",
    data() {
        return {

        }
    },
    created() {
        this.main = true
    },
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>
