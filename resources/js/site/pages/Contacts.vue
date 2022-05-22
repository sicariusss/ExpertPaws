<template>

</template>

<script>
export default {
    name: "Contacts",
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>

<style>

</style>
