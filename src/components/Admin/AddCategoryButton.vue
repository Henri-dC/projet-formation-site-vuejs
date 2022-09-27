<template>
    <div id="add-category-container">
        <h2>Ajouter une catégorie</h2>
        <input v-model="textInput" type="texte"/>
        <button @click="addCategory(textInput)">Ajouter</button>
       
          <div v-if="isCreated" class="pop-up">
            <span>La catégorie à bien été ajoutée</span>
          </div>
       
    </div>
</template>

<script>
   export default {
    data(){
        return{
            textInput : '',
            isCreated : false
        }
    },
    methods:{
        addCategory(name){
            let request = new fetchData('POST', '?route=/category',{'name':name})
            request.query()
            this.isCreated=true;
            this.textInput='';
            setTimeout(()=>this.isCreated=false,3000)
        }
    }
   }
</script>

<style>
    #add-category-container{
        padding-top:4em;
    }
</style>