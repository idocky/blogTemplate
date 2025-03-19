<template>
    <div class="text-center">
        <img
            v-if="image"
            :src="fullImageUrl"
            :alt="image.alt || ''"
            class="d-block mx-auto mb-3"
        />
    </div>
</template>

<script>
export default {
    name: 'ImageComponent',
    props: {
        block: {
            type: Object,
            required: true
        }
    },
    computed: {
        image() {
            const values = Object.values(this.block.data || {});
            return values.length ? values[0] : null;
        },
        fullImageUrl() {
            if (!this.image) return '';
            const origin = window.location.origin || '';
            console.log('Origin:', origin); // For debugging
            return `${origin}/storage/${this.image.src}`;
        }
    }
};
</script>

<style scoped>

</style>
