<template>
    <div>
        <!-- Navigation -->
        <TheNavigation />

        <!-- Page View -->
        <main>
            <router-view />
        </main>
    </div>
</template>

<script>
/* Imports */
import TheNavigation from "./commponents/TheNavigation.vue";
export default {
    components: {
        TheNavigation,
    },
};
</script>

<!-- Styles -->
<style>
body {
    font-family: "Nunito", sans-serif;
}
</style>
