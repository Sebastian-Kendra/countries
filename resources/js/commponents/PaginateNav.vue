<template>
    <nav>
        <ul class="pagination">
            <li class="page-item">
                <button
                    class="page-link"
                    href="#"
                    @click.prevent="previousPage"
                >
                    Previous
                </button>
            </li>
            <li class="page-item">
                <p class="page-link" href="#">{{ currentPage }}</p>
            </li>
            <li class="page-item">
                <button class="page-link" href="#" @click.prevent="nextPage">
                    Next
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        countriesLen: {
            type: Number,
        },
        currentPage: {
            type: Number,
        },
    },
    methods: {
        nextPage() {
            if (this.countriesLen >= 10) {
                this.$emit("page-selected", +1);
            }
        },
        previousPage() {
            if (this.currentPage > 1) {
                this.$emit("page-selected", -1);
            }
        },
    },
};
</script>

<style lang="scss" scoped></style>
