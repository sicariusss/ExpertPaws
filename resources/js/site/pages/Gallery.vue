<template>

</template>

<script>
export default {
    name: "Gallery",
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>

<style>

</style>
