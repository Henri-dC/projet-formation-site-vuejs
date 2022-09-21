<script setup>
    import ArticleComp from "../../components/Articles/ArticleComp.vue"
    import NewArticleForm from "../../components/Articles/NewArticleForm.vue";
</script>

<template>
    <div id="container">
        <ArticleComp admin='true'/>
        <NewArticleForm/>
    </div>
</template>

<style scoped>
    #container{
        padding-top:8em;
        background-color:aqua;
    }
</style>