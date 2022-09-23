<template>
    <div id="container-input-picture">
        <label id="label-picture-article" for="picture-article">
            <i class="fa-regular fa-image"></i>
            Ajouter une photo
            <p>{{ fileName }}</p>
            <input :onchange="fillName" type="file" name="picture-article" id="picture-article" ref="input"/>
        </label>
    </div>
</template>

<script>

export default {
    props:{
        currentFile:String
    },
    data(){
        return{
            fileName:'',
        }
    },
    methods:{
        fillName(){
            console.log('fillname')
            this.fileName=this.$refs.input.files[0].name
        }
    },
    updated(){
            console.log('update')
            if(this.currentFile!==''){this.fileName=this.currentFile}
    }
    
}
</script>

<style scoped>
    #label-picture-article {
  cursor: pointer;
}

#picture-article {
  display: none;
}

#container-input-picture{
  border:1px solid black;
  width: 85%;
  margin: auto;
}

p{
    color:red;
}
</style>