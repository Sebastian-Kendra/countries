<template>
    <div>
        <h1>{{ currCountry.name }}</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Country id :</th>
                    <td>{{ currCountry.country_id }}</td>
                </tr>
                <tr>
                    <th scope="row">Country code :</th>
                    <td>{{ currCountry.code }}</td>
                </tr>
                <tr>
                    <th scope="row">Country full name :</th>
                    <td>{{ currCountry.full_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Country iso3 :</th>
                    <td>{{ currCountry.iso3 }}</td>
                </tr>
                <tr>
                    <th scope="row">Country continent :</th>
                    <td>{{ currCountry.continent_code }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currCountry: {},
        };
    },
    created() {
        axios
            .get("/api/countries/" + this.$route.params.id)
            .then((response) => {
                this.currCountry = response.data;
            })
            .catch((error) => {
                this.$router.push("/:catchAll(.*)");
            });
    },
};
</script>
