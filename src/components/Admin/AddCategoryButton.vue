<template>
    <div id="add-category-container">
        <h2>Ajouter une catégorie</h2>
        <input v-model="textInput" type="texte"/>
        <button @click="addCategory(textInput)">Ajouter</button>
        <transition name="modal">
          <div v-if="isCreated" class="pop-up">
            <span>La catégorie à bien été ajoutée</span>
          </div>
        </transition>
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

<style scoped>
#add-category-container{
    border:2px dashed black;
    float:right;
}

.tray-enter,
.tray-leave-to { opacity: 0 }

.tray-leave,
.tray-enter-to { opacity: 1 }

.tray-enter-active,
.tray-leave-active { transition: opacity 3000ms }
</style>