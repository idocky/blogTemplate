<template>
    <!-- Если нет подкатегорий, просто ссылка -->
    <li class="nav-item" v-if="!category.subcategories.length">
        <a class="nav-link primary-text text-20" :href="category.link">{{ category.title }}</a>
    </li>

    <li class="nav-item dropdown" v-else>
        <a
            href="#"
            class="nav-link primary-text dropdown-toggle text-20"
            @click.prevent="toggleDropdown"
        >
            {{ category.title }}
        </a>
        <ul class="dropdown-menu" :class="{ 'show': isOpen }">
            <li v-for="sub in category.subcategories" :key="sub.id">
                <a class="dropdown-item" :href="sub.link">{{ sub.title }}</a>
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    props: {
        category: Object,
        activeDropdown: Number
    },
    computed: {
        isOpen() {
            return this.activeDropdown === this.category.id;
        }
    },
    methods: {
        toggleDropdown() {
            this.$emit('toggleDropdown', this.category.id);
        }
    }
};
</script>

<style scoped>
.dropdown-menu {
    transition: all 0.3s ease-in-out;
}

.nav-link:hover {
    color: whitesmoke;
}
</style>
