<template>
  <div class="container-for-scroll">
    <div id="overlaye"></div>
    <div id="modale-new-article">
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
            v-model="ArticleStore.formData.title"
          />

          <FormInputFile
            :currentFile="
              ArticleStore.formData.picture
                ? ArticleStore.formData.picture
                : false
            "
          />

          <label for="content-article">
            <span>{{ formErrors.content }}</span>
          </label>
          <textarea
            v-model="ArticleStore.formData.content"
            name="content"
            rows="7"
            placeholder="Votre contenu ici..."
            id="content-article"
          ></textarea>

          <select
            name="category"
            id="category-article"
            v-model="ArticleStore.formData.category_id"
          >
            <option value="-1" disabled>Sélectionnez une catégorie</option>
            <option
              v-for="category in CategoriesStore.categories"
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

<script setup>
import { onMounted, ref, computed } from "vue";
import { useUserStore } from "@/store/UserStore.js";
import { useArticleStore } from "@/store/ArticleStore";
import { useCategoryStore } from "@/store/CategoryStore";
import { useServiceStore } from "@/store/ServiceStore";
import { fetchData } from "../composables/useFetch.js";
import { Article } from "../composables/classArticle.js";
import FormInputFile from "./FormInputFile.vue";
const ArticleStore = useArticleStore();
const UserStore = useUserStore();
const CategoriesStore = useCategoryStore();
const ServiceStore = useServiceStore();
let formData = ref({ category_id: "-1" });
let formErrors = ref({});
const fileName = ref("");
const editMode = computed(() => {
  return ArticleStore.edit ? true : false;
});
onMounted(() => {
  CategoriesStore.queryCategories();
});

/* Fonction upload Picture 
  -on modifie le nom si il contient des espaces et on met à jour dans l'article
*/

async function loadPicture(article) {
  var input = document.querySelector('input[type="file"]');
  let name = input.files[0].name.replaceAll(" ", "-");
  article.setPicture(name);
  let dataPic = new FormData();
  dataPic.append("photo", input.files[0]);
  return fetch("http://localhost:8889/api/index.php", {
    method: "post",
    credentials: "include",
    mode: "cors",
    body: dataPic,
  });
}

/* fonction create article*/

async function createArticle(e) {
  e.preventDefault();
  var input = document.querySelector('input[type="file"]');
  //création d'une instance Article
  let article = new Article(
    "",
    ArticleStore.formData.title,
    ArticleStore.formData.picture,
    ArticleStore.formData.content,
    UserStore.user._firstName,
    UserStore.user._id,
    ArticleStore.formData.category_id
  );
  /* Si on est en mode edit : - check si photo a changée
                              - on attribue l'id
                              - on fetch
                              - on ferme la modale si pas d'erreurs
  */
  if (editMode.value === true) {
    if (input.files.length > 0) {
      loadPicture(article);
    } else {
      article.setPicture(ArticleStore.formData.picture);
    }
    article.setArticleId(ArticleStore.formData.id);
    let result = [];
    await ArticleStore.updateArticle(article).then(
      (resultat) => (result = resultat)
    );
    if (result["errors"]) {
      /* Si il y a une erreur... */
      formErrors.value = result["errors"];
    } else {
      ArticleStore.queryArticles();
      closeModaleNewArticle(e);
      ServiceStore.modaleText = "L'article a été modifié";
      ServiceStore.displayModaleText = true;
    }
    /* Si on est en mode !edit : - on fetch photo et article
                                  - si pas d'erreur on ferme la modale
  */
  } else {
    await loadPicture(article); /*On charge la photo*/
    let result = [];
    await ArticleStore.createArticle(article).then(
      (resultat) => (result = resultat)
    );
    if (result["errors"]) {
      /* Si il y a une erreur... */
      formErrors.value = result["errors"];
    } else {
      /* Sinon... */
      article = result["data"];

      //On ferme la modale
      ArticleStore.queryArticles();
      closeModaleNewArticle(e);
      ServiceStore.modaleText = "Votre article a été publié !";
      ServiceStore.displayModaleText = true;
    }
  }
}

/* Fonction pour fermer la modale et mettre à jour :
  -formError,
  -formData(store)
  -input-file, si on annule sans valider le formulaire
*/

function closeModaleNewArticle(e) {
  e.preventDefault();
  formErrors = {};
  ArticleStore.formData = { category_id: "-1" };
  ArticleStore.edit = false;
  document.getElementById("input-file").value = "";
  ServiceStore.toggleDisplayNewArticleForm();
}
</script>

<style lang="sass" scoped>
@import '../assets/style/NewArticleForm.scss'
</style>
