<template>
    <div>
        <div class="flex right flex-end">
            <DropDown @sort="sortByAplphabet" />
            <ContinentSelect
                @update-continent-selected="updateSelectedContinent"
            />
        </div>

        <!-- Table countries -->
        <table class="table mt-2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Code</th>
                    <th scope="col">
                        <a @click.prevent="sortByCountry"> Name</a>
                    </th>
                    <th scope="col">Continent</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="country in displayedCountries" :key="country.id">
                    <th scope="row">{{ country.country_id }}</th>
                    <td>{{ country.code }}</td>
                    <td>
                        <router-link :to="'/country/' + country.country_id">{{
                            country.name
                        }}</router-link>
                    </td>
                    <td>{{ country.continent_code }}</td>
                </tr>
            </tbody>

            <PaginateNav
                :countries-len="displayedCountries.length"
                :current-page="currentPage"
                @page-selected="onPageSelected"
            />
        </table>
    </div>
</template>

<script>
/* Imports */
import DropDown from "./DropDown.vue";
import ContinentSelect from "./ContinentSelect.vue";
import PaginateNav from "./PaginateNav.vue";

export default {
    data() {
        return {
            countries: [],
            loadedCountries: [],
            currentPage: 1,
            perPage: 10,
            isAllDataLoaded: false,
            sortDirection: "",
            isOpen: false,
            selectedContinent: "",
            totalCountries: 0,
        };
    },
    mounted() {
        // populate countries array with data from API
        axios.get("/api/countries/").then((response) => {
            this.loadedCountries = response.data.data;
            this.countries = this.loadedCountries;
            this.totalCountries = response.data.total;
        });
    },
    computed: {
        displayedCountries() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            let filteredCountries = this.countries;

            // TODO: prerobit filter
            if (this.sortDirection === "asc") {
                // sort countries in ascending order based on name
                filteredCountries.sort((a, b) => a.name.localeCompare(b.name));
            } else if (this.sortDirection === "desc") {
                // sort countries in descending order based on name
                filteredCountries.sort((a, b) => b.name.localeCompare(a.name));
            }

            if (this.selectedContinent !== "") {
                // filter countries based on selected continent
                filteredCountries = this.countries.filter(
                    (country) =>
                        country.continent_code === this.selectedContinent
                );
            }
            // return the array of countries to be displayed on the current page
            return filteredCountries.slice(start, end);
        },
    },
    methods: {
        sortByAplphabet(direction) {
            // set sorting direction
            this.sortDirection = direction;
        },
        updateSelectedContinent(currentContinent) {
            // update selected continent filter
            this.selectedContinent = currentContinent;
            this.currentPage = 1;
        },
        onPageSelected(direction) {
            // update current page based on navigation direction
            // TODO: prerobit loadNext
            if (direction === 1) {
                this.loadNext();
                this.currentPage = this.currentPage + direction;
            } else {
                this.currentPage = this.currentPage + direction;
            }
        },
        // load next page
        // TODO: prerobit loadNext
        async loadNext() {
            const nextPage = this.currentPage + 1;
            // overiť, či už boli načítané všetky krajiny
            if (!this.isAllDataLoaded) {
                const response = await axios.get(
                    `/api/countries?page=${nextPage}`
                );
                const newCountries = response.data.data.filter(
                    (country) => !this.loadedCountries.includes(country)
                ); // len nové krajiny
                if (newCountries.length > 0) {
                    this.loadedCountries = [
                        ...this.loadedCountries,
                        ...newCountries,
                    ]; // pridá nové krajiny do pole na uchovávanie načítaných krajín
                    this.countries = [...this.countries, ...newCountries].slice(
                        0,
                        nextPage * this.perPage
                    ); // pridá nové krajiny do zobrazených krajín
                    this.currentPage = nextPage;
                } else {
                    this.isAllDataLoaded = true;
                }
            }
        },
    },
    components: { DropDown, ContinentSelect, PaginateNav },
};
</script>
