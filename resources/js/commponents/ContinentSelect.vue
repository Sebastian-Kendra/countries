<template>
    <div class="form-group">
        <label for="continent-select">Select continent: </label>
        <select
            class="form-control"
            id="continent-select"
            v-model="currentContinent"
            @change="continentSelected"
        >
            <option selected value="">All</option>
            <option v-for="continent in continents" :value="continent.code">
                {{ continent.name }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    data() {
        return {
            continents: [],
            currentContinent: "",
        };
    },
    mounted() {
        axios.get("/api/continents/").then((response) => {
            this.continents = response.data;
        });
    },
    methods: {
        continentSelected() {
            this.$emit("update-continent-selected", this.currentContinent);
        },
    },
};
</script>
