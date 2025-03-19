<template>
    <h2 :id="'article-header-' + (Number(index) + 1)" v-if="block.data.content[0].blue_header">
        {{ block.data.content[0].blue_header }}
    </h2>

    <div v-if="block.data.content[0].content">
        <div v-html="block.data.content[0].content">
        </div>
    </div>
</template>

<script>
export default {
    name: 'HeaderComponent',
    props: {
        block: {
            type: Object,
            required: true
        },
        index: {
            type: Number,
            required: true
        }
    }
};
</script>

<style scoped>

</style>
