<template>
    <!-- Drop down -->
    <div class="btn-group ml-1">
        <button
            type="button"
            class="btn btn-secondary dropdown-toggle"
            :class="{ active: isOpen }"
            @click="isOpen = !isOpen"
        >
            Sortate by alphabet
        </button>
        <ul class="dropdown-menu" :class="{ show: isOpen }">
            <li>
                <button
                    class="dropdown-item"
                    href="#"
                    @click.prevent="sort('asc')"
                >
                    from A to Z
                </button>
            </li>
            <li>
                <button
                    class="dropdown-item"
                    href="#"
                    @click.prevent="sort('desc')"
                >
                    from Z to A
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: false,
        };
    },
    methods: {
        // Function to close the dropdown menu
        closeDropdown() {
            this.isOpen = false;
        },
        // Function to handle sorting event and emit the sort direction to parent component
        sort(direction) {
            this.$emit("sort", direction);
        },
    },
};
</script>

<style lang="scss" scoped></style>
