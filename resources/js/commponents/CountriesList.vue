<template>
    <div>
        <div class="flex right flex-end">
            <DropDown @sort="sortByAplphabet" />
            <ContinentSelect
                @update-continent-selected="updateSelectedContinent"
            />
        </div>

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
import { throttle } from "lodash";
import DropDown from "./DropDown.vue";
import ContinentSelect from "./ContinentSelect.vue";
import PaginateNav from "./PaginateNav.vue";

export default {
    data() {
        return {
            countries: [],
            currentPage: 1,
            perPage: 10,
            isAllDataLoaded: false,
            sortDirection: "",
            isOpen: false,
            selectedContinent: "",
        };
    },
    mounted() {
        axios.get("/api/countries/").then((response) => {
            this.countries = response.data.data;
        });

        this.loadMore();
    },
    computed: {
        displayedCountries() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            let filteredCountries = this.countries;

            if (this.sortDirection === "asc") {
                this.countries.sort((a, b) => a.name.localeCompare(b.name));
            } else if (this.sortDirection === "desc") {
                this.countries.sort((a, b) => b.name.localeCompare(a.name));
            }

            if (this.selectedContinent !== "") {
                filteredCountries = this.countries.filter(
                    (country) =>
                        country.continent_code === this.selectedContinent
                );
            }
            return filteredCountries.slice(start, end);
        },
    },
    methods: {
        sortByAplphabet(direction) {
            this.sortDirection = direction;
        },
        updateSelectedContinent(currentContinent) {
            this.selectedContinent = currentContinent;
        },
        onPageSelected(direction) {
            this.currentPage = this.currentPage + direction;
        },
        async loadMore() {
            let page = this.currentPage + 1;
            // Repeat until all records are loaded
            while (!this.isAllDataLoaded) {
                await axios
                    .get(`/api/countries?page=${page}`)
                    .then((response) => {
                        if (response.data.data.length > 0) {
                            this.countries = [
                                ...this.countries,
                                ...response.data.data,
                            ];
                            page++;
                        } else {
                            this.isAllDataLoaded = true;
                        }
                    });
                // Wait 500ms before next request
                await new Promise((resolve) => throttle(resolve, 500)());
            }
        },
    },
    components: { DropDown, ContinentSelect, PaginateNav },
};
</script>
