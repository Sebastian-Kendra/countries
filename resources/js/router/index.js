import { createRouter, createWebHistory } from "vue-router";

/* Import Views */
import CountriesView from "../pages/CountriesView.vue";
import CountryView from "../pages/CountryView.vue";
import CreateCountryView from "../pages/CreateCountryView.vue";
import NotFound from "../pages/NotFound.vue";

const routes = [
    {
        path: "/",
        name: "countries",
        component: CountriesView,
    },
    {
        path: "/country/:id",
        name: "country",
        component: CountryView,
    },
    {
        path: "/create-countries",
        name: "create-country",
        component: CreateCountryView,
    },
    {
        path: "/:catchAll(.*)",
        name: "not-found",
        component: NotFound,
    },

    /* ? Routes for future
    {
        path: "/continents",
        name: "continents",
        Lazy loading if we needed
        component: () => import(/* webpackChunkName: "countries"  '../pages/CountriesView.vue')
    },
    {
        path: "/countries",
        name: "countries",
        component: CountriesView,
    },  ? */
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
