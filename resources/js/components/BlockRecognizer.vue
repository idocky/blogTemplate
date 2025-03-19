<template>
    <div v-for="(block, index) in blocks" :key="block.id">
        <div v-if="block.type === '1'">
            <HeaderComponent :block="block" :index="index"></HeaderComponent>
        </div>
        <div v-else-if="block.type === '4'">
            <ImageComponent :block="block"></ImageComponent>
        </div>
    </div>
</template>

<script>
import HeaderComponent from "./ArticleBlocks/HeaderComponent.vue";
import ImageComponent from "./ArticleBlocks/ImageComponent.vue";

export default {
    name: 'BlockRecognizer',
    components: {ImageComponent, HeaderComponent},
    props: {
        blocks: {
            type: Object,
            required: true
        }
    }
};
</script>

<style scoped>

</style>
