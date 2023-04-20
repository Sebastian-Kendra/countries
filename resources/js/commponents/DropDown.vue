<template>
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
        closeDropdown() {
            this.isOpen = false;
        },
        sort(direction) {
            this.$emit("sort", direction);
        },
    },
};
</script>

<style lang="scss" scoped></style>
