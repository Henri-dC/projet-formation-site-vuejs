<script setup>
    import {useArticleStore} from "../../store/ArticleStore.js"
    const articleStore = useArticleStore();
</script>

<template>
    <div>
        <p id="hello">id:{{$routes.params.id}}</p>
        <div class="test">
        wesh
        </div>
    </div>
</template>

<script>
export default {
data(){
    return{
        id:4
    }
}
}
</script>

<style scoped>
    #hello{
        margin-top:10em;
        height:100em;
        display:block;
    }
</style>