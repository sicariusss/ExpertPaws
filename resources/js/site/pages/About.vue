<template>
    <div class="component-block">
        About us
    </div>
</template>

<script>
export default {
    name: "About",
    beforeRouteEnter(to, from, next) {
        document.title = to.name;
        next();
    }
}
</script>
