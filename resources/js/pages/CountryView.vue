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
            // Make a GET request to the API endpoint for the specific country
            .get("/api/countries/" + this.$route.params.id)
            .then((response) => {
                // Update the current country object with the response data
                this.currCountry = response.data;
            })
            .catch((error) => {
                // Handle errors by redirecting to the catch-all route
                this.$router.push("/:catchAll(.*)");
            });
    },
};
</script>
