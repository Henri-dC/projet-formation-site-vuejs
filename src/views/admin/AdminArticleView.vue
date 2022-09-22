<script setup>
    import ArticleComp from "../../components/Articles/ArticleComp.vue"
    import NewArticleForm from "../../components/Articles/NewArticleForm.vue";
</script>

<template>
    <div id="container">
        <ArticleComp admin='true'/>
        <NewArticleForm/>
        <button @click="show">Show Catégories</button>
    </div>
</template>

<script>
export default {
    methods:{
        show(){
            let request = new fetchData('GET', '?route=/category')
            request.query()
        }
    }
}
</script>

<style scoped>
    #container{
        padding-top:8em;
        background-color:aqua;
    }
</style>