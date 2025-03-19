<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #0F1819;">
        <div class="container">
            <div @click="navigateToBlog" style="cursor: pointer;">
                <iframe
                    src="/assets/images/home-new/logo.svg"
                    width="200"
                    style="pointer-events: none;">
                </iframe>
            </div>

            <!-- Категории -->
            <ul class="navbar-nav ms-auto">
                <NavItem
                    v-for="category in categories.data"
                    :key="category.id"
                    :category="category"
                    :activeDropdown="activeDropdown"
                    @toggleDropdown="setActiveDropdown"
                />
            </ul>
        </div>
    </nav>
</template>

<script>
import NavItem from './NavItem.vue';

export default {
    components: { NavItem },
    props: {
        categories: Array,
    },

    data() {
        return {
            activeDropdown: null,
        };
    },
    methods: {
        setActiveDropdown(categoryId) {
            this.activeDropdown = this.activeDropdown === categoryId ? null : categoryId;
        },
        navigateToBlog() {
            window.location.href = '/blog';
        }
    }
};
</script>
