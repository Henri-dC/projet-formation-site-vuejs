<template>
  <div class="container-for-scroll">
    <div id="modale-new-article">
      <div id="overlaye"></div>
      <form>
        <fieldset>
          <legend>Ajouter un article</legend>

          <label for="title-article"
            ><span>{{ formErrors.title }}</span></label
          >
          <input
            type="text"
            placeholder="Titre"
            name="title"
            id="title-article"
            v-model="formData.title"
          />

          <label id="label-picture-article" for="picture-article">
            <i class="fa-regular fa-image"></i>
            Ajouter une photo
            <p>{{ fileName }}</p>
            <span>{{ formErrors.picture }}</span>
          </label>
          <input type="file" name="picture-article" id="picture-article" />

          <label for="content-article">
            <span>{{ formErrors.content }}</span>
          </label>
          <textarea
            v-model="formData.content"
            name="content"
            rows="7"
            placeholder="Votre contenu ici..."
            id="content-article"
          ></textarea>

          <select
            name="category"
            id="category-article"
            v-model="formData.category"
          >
            <option value="-1" disabled>Sélectionnez une catégorie</option>
            <option value="musique">Musique</option>
            <option value="cuisine">Cuisine</option>
            <option value="sport">Sport</option>
          </select>

          <input
            id="author-article"
            type="text"
            name="author"
            v-model="formData.author"
          />

          <div id="button-container">
            <button
              id="close-modale-new-article"
              @click="closeModaleNewArticle"
            >
              Annuler
            </button>
            <button @click="createArticle" type="submit">Publier</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: { category: -1 },
      formErrors: {},
      article: {},
      input: "",
    };
  },
  mounted() {
    this.input = document.querySelector("#picture-article");
    console.log(this.input);
  },
  computed: {
    fileName() {
      console.log(this.input.files);
      if (this.input.files > 0) {
        return this.input.files[0].name;
      }
    },
  },
  methods: {
    //FONCTION: Fermer la modale

    closeModaleNewArticle(e) {
      e.preventDefault();
      let container = document.querySelector(".container-for-scroll");
      container.style.display = "none";
    },

    //FONCTION: charger la photo

    loadPicture() {
      var input = document.querySelector('input[type="file"]');

      let dataPic = new FormData();
      dataPic.append("photo", input.files[0]);

      fetch("http://localhost:8889/api/index.php", {
        method: "post",
        body: dataPic,
      });
    },

    //FONCTION: Enregistrer l'article en base de données

    async createArticle(e) {
      e.preventDefault();
      this.loadPicture(); /*On charge la photo*/

      //création d'une instance Article

      let article = new Article(
        "",
        this.formData.title,
        this.formData.picture,
        this.formData.content,
        this.formData.category,
        this.formData.author
      );

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
            /* Si il y a une erreur... */
            this.formErrors = result["errors"];
          } else {
            /* Sinon... */
            this.article = result["data"];

            //On ferme la modale

            let container = document.querySelector(".container-for-scroll");
            container.style.display = "none";
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

.container-for-scroll {
  display: none;
  position: fixed;
  bottom: 0;
  top: 4em;
  width: 90%;
  max-height: 90%;
  margin-left: 5%;
}
#modale-new-article::-webkit-scrollbar {
  display: none;
}

#modale-new-article {
  display: block;
  top: 4em;
  width: 90%;
  margin-left: 5%;
  height: 100%;
  text-align: center;
  border-radius: 1em;
  z-index: 20;
  overflow-y: scroll;
}

fieldset {
  border-radius: 1em;
  background-color: var(--second-bg-color);
}

legend {
  font-size: 2em;
  font-weight: 700;
  padding: 0.6em;
  border-radius: 0em 1em;
  color: white;
  background-color: var(--main-bg-color);
  border-block: 4px solid black;
}

input::placeholder,
textarea::placeholder {
  text-align: center;
  font-weight: 500;
  font-size: 1.5em;
  color: black;
}

input,
select {
  display: block;
  margin: auto;
  margin-bottom: 2em;
  width: 85%;
  line-height: 2em;
  text-align: center;
  border-radius: 2em 0em;
}

#label-picture-article {
  cursor: pointer;
}

#picture-article {
  display: none;
}

textarea {
  margin-top: 2em;
  width: 85%;
  resize: none;
}

select {
  height: 2.6em;
}

#author-article {
  width: 60%;
}

#button-container {
  display: flex;
  justify-content: space-around;
  width: 60%;
  margin: auto;
  margin-top: 2em;
}

button {
  line-height: 1.7em;
  border-radius: 10em;
}
</style>
