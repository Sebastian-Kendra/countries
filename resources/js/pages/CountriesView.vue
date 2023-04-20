<template>
    <div>
        <div class="flex right mb-4">
            <h1>Countries</h1>
            <button type="button " class="btn btn-success">
                <router-link to="/create-countries">
                    Add new country
                </router-link>
            </button>
        </div>
        <CountriesList />
    </div>
</template>

<script>
import CountriesList from "../commponents/CountriesList.vue";

export default {
    components: {
        CountriesList,
    },
};
</script>
