<script setup>
import { useUserStore } from "@/store/UserStore.js";
import { useArticleStore } from "../../store/ArticleStore";
import { useCategoryStore } from "../../store/CategoryStore";
const articleStore = useArticleStore();
const userStore = useUserStore();
const storeCategories = useCategoryStore();
const editArticle = articleStore.editArticle;
</script>

<template>
  <div class="container-for-scroll">
    <div id="modale-new-article">
      <div id="overlaye"></div>
      <form>
        <fieldset>
          <legend v-if="!editMode">Ajouter un article</legend>
          <legend v-else>Modifier un article</legend>

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
            v-model="formData.category_Id"
          >
            <option value="-1" disabled>Sélectionnez une catégorie</option>
            <option
              v-for="category in storeCategories.getCategories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>

          <div id="button-container">
            <button
              id="close-modale-new-article"
              @click="closeModaleNewArticle"
            >
              Annuler
            </button>
            <button v-if="!editMode" @click="createArticle" type="submit">
              Publier
            </button>
            <button v-else @click="createArticle" type="submit">
              Modifier
            </button>
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
      update: 0,
    };
  },
  onMounted() {
    this.input = document.querySelector("#picture-article");
  },
  updated() {
    if (this.update < 1) {
      if (this.editMode) {
        this.formData = {
          title: this.articleStore.editArticle.title,
          picture: this.articleStore.editArticle.picture,
          content: this.articleStore.editArticle.content,
          category: this.articleStore.editArticle.category_Id,
        };
        this.update++;
      }
    }
  },

  computed: {
    fileName() {
      if (this.input.files > 0) {
        return this.input.files[0].name;
      }
    },
    editMode() {
      return this.articleStore.editArticle == "" ? false : true;
    },
  },

  methods: {
    //FONCTION: Fermer la modale

    closeModaleNewArticle(e) {
      e.preventDefault();
      this.articleStore.resetEditArticle();
      this.formData = { category: -1 };
      this.formErrors = {};
      let container = document.querySelector(".container-for-scroll");
      container.style.display = "none";
      this.update--;
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
        (this.formData.author = this.userStore.user._firstName),
        (this.formData.author_Id = this.userStore.user._id),
        this.formData.category_Id
      );

      if (this.editMode) {
        article.setArticleId(this.articleStore.editArticle.id);
        let result = this.articleStore.updateArticle(article);
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
      } else {
        let result = await this.articleStore.createArticle(article);
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
      }
    },
    //FONCTION: charger la photo

    loadPicture() {
      var input = document.querySelector('input[type="file"]');
      this.formData.picture = input.files[0].name;
      let dataPic = new FormData();
      dataPic.append("photo", input.files[0]);

      fetch("http://localhost:8889/api/index.php", {
        method: "post",
        body: dataPic,
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
  top: 15em;
  width: 90%;
  max-height: 90%;
  margin-left: 5%;
}
#modale-new-article::-webkit-scrollbar {
  display: none;
}

#modale-new-article {
  display: block;
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
  border-radius: 2em;
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

span {
  color: red;
}
</style>
