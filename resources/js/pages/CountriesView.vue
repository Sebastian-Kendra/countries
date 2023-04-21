<template>
    <div>
        <div class="flex right mb-4">
            <h1>Countries</h1>

            <router-link to="/create-countries">
                <button type="button " class="btn btn-success">
                    Add new country
                </button>
            </router-link>
        </div>
        <CountriesList />
    </div>
</template>

<script>
/* Imports */
import CountriesList from "../commponents/CountriesList.vue";

export default {
    components: {
        CountriesList,
    },
};
</script>
