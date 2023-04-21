<template>
    <div class="container-flex">
        <div class="create-form">
            <h1>Add Country Form</h1>
            <form class="mb-4">
                <div class="mb-3">
                    <label class="form-label">Country name :</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Cape Verde"
                        v-model="countryName"
                    />
                    <div v-if="errors.name">
                        <p
                            class="form-text-error"
                            v-for="(error, index) in errors.name"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country code :</label>
                    <input
                        type="text"
                        class="form-control"
                        id="country_code"
                        placeholder="CV"
                        v-model="countryCode"
                    />
                    <div v-if="errors.code">
                        <p
                            class="form-text-error"
                            v-for="(error, index) in errors.code"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country full name :</label>
                    <input
                        type="text"
                        class="form-control"
                        id="full_name"
                        placeholder="Republic of Cape Verde"
                        v-model="countryFullName"
                    />
                    <div v-if="errors.full_name">
                        <p
                            class="form-text-error"
                            v-for="(error, index) in errors.full_name"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country iso3 :</label>
                    <input
                        type="text"
                        class="form-control"
                        id="iso3"
                        placeholder="CPV"
                        v-model="countryIso3"
                    />
                    <div v-if="errors.iso3">
                        <p
                            class="form-text-error"
                            v-for="(error, index) in errors.iso3"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country continent :</label>
                    <input
                        type="text"
                        class="form-control"
                        id="continent_code"
                        placeholder="AF"
                        v-model="continentCode"
                    />
                    <div v-if="errors.continent_code">
                        <p
                            class="form-text-error"
                            v-for="(error, index) in errors.continent_code"
                            :key="index"
                        >
                            {{ error }}
                        </p>
                    </div>
                </div>
                <button
                    @click="submitForm"
                    type="button"
                    class="btn btn-success"
                >
                    Submit
                </button>

                <router-link to="/">
                    <button type="button" class="btn btn-outline-danger">
                        Cancel
                    </button>
                </router-link>
            </form>
        </div>
    </div>
</template>

<script>
import router from "../router/index";

export default {
    data() {
        return {
            countryName: "",
            countryCode: "",
            countryFullName: "",
            countryIso3: "",
            continentCode: "",
            errors: [],
        };
    },
    methods: {
        /* Sends a post request to the specified API endpoint 
            with the country data */
        submitForm() {
            let data = {
                code: this.countryCode,
                name: this.countryName,
                full_name: this.countryFullName,
                iso3: this.countryIso3,
                number: 40,
                continent_code: this.continentCode,
                display_order: 900,
            };
            axios
                .post("/api/countries", data)
                .then(() => {
                    // Resets the errors array
                    this.errors = [];
                })
                .catch((errors) => {
                    // Sets the errors array to any errors returned by the API
                    this.errors = errors.response.data.errors;
                })
                .then(() => {
                    // If there are no errors, navigate to the home page
                    if (this.errors.length === 0) {
                        router.push("/");
                    }
                });
        },
    },
};
</script>

<style lang="scss" scoped></style>
