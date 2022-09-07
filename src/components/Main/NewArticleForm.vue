<template>
  <div id="modale-new-article">
    <div id="overlaye"></div>
    <form>
      <fieldset>
        <legend>Ajouter un article</legend>

        <input
          type="text"
          placeholder="Titre"
          name="title"
          id="title-article"
          v-model="formData.title"
        />
        <input type="file" name="picture-article" id="picture-article" />
        <textarea
          v-model="formData.content"
          name="content"
          cols="30"
          rows="10"
          placeholder="Votre contenu ici..."
          id="content-article"
        ></textarea>

        <select
          name="category"
          id="category-article"
          v-model="formData.category"
        >
          <option value="musique">Musique</option>
          <option value="cuisine">Cuisine</option>
          <option value="sport">Sport</option>
        </select>

        <input type="text" name="author" v-model="formData.author" />

        <div id="button-container">
          <button id="close-modale-new-article" @click="closeModaleNewArticle">
            Annuler
          </button>
          <button @click="createArticle" type="submit">Publier</button>
        </div>
      </fieldset>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {},
      article: {},
    };
  },
  methods: {
    closeModaleNewArticle(e) {
      e.preventDefault();
      let modale = document.querySelector("#modale-new-article");
      modale.style.display = "none";
    },
    loadPicture() {
      var input = document.querySelector('input[type="file"]');

      var data = new FormData();
      var url = new URL("http://localhost:8889/api/index.php", import.meta.url);
      url.search = "?route=/image";
      data.append("picture-article", input.files[0]);
      console.log(input.files[0]);

      var header = new Headers();
      header.append("Content-Type", "image/jpeg");

      fetch(url, {
        method: "POST",
        body: data,
      });

      let modale = document.querySelector("#modale-new-article");
      modale.style.display = "none";
    },

    async createArticle(e) {
      e.preventDefault();
      this.loadPicture();
      //création d'une instance Article
      //On récupère le nom du fichier dans input file

      var input = document.querySelector('input[type="file"]');
      this.formData.picture = input.files[0]["name"];

      let article = new Article(
        "",
        this.formData.title,
        this.formData.picture,
        this.formData.content,
        this.formData.category,
        this.formData.author
      );

      //On ferme la modale

      let modale = document.querySelector("#modale-new-article");
      modale.style.display = "none";

      //Envoie au serveur PHP la requête avec article en JSON

      let url = new URL("http://localhost:8889/api/index.php");
      url.search = "?route=/article";

      return fetch(url, {
        method: "POST",
        credentials: "include",
        methode: "cors",
        header: {
          "Content-Type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(article),
      })
        .then((response) => response.json())
        .then((result) => {
          if (result["errors"]) {
            this.formErrors = result["errors"];
          } else {
            this.article = result["data"];
          }
        });
    },
  },
};
</script>

<style scoped>
#overlaye {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: black;
  opacity: 80%;
  z-index: -1;
}

#modale-new-article {
  display: none;
  position: fixed;
  top: 4em;
  width: 90%;
  margin-left: 5%;
  text-align: center;
  border-radius: 1em;
  z-index: 20;
}

fieldset {
  border-radius: 1em;
  background-color: var(--second-bg-color);
}

legend {
  font-size: 2em;
  font-weight: 700;
  padding: 1em;
  border-radius: 1em;
  color: white;
  background-color: var(--main-bg-color);
  border-block: 4px solid black;
}

input,
select {
  display: block;
  margin: auto;
  margin-top: 2em;
  width: 60%;
}

textarea {
  margin-top: 2em;
  width: 90%;
  height: auto;
}

#button-container {
  display: flex;
  justify-content: space-around;
}
</style>
