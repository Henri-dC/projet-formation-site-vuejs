import { defineStore } from "pinia";
import { ref, watch } from "vue";

export const useServiceStore = defineStore("ServiceStore", () => {
  const displayNewArticleForm = ref(false);

  let modaleText = ref("bonjour");
  let displayModaleText = ref(false);
  function toggleDisplayNewArticleForm() {
    this.displayNewArticleForm = !this.displayNewArticleForm;
  }

  /*Following functions are used for opening modaleText and close it 1s later */

  watch(displayModaleText, doStuff);

  function doStuff() {
    if (displayModaleText.value === true) {
      setTimeout(close, 1000);
    }
  }

  function close() {
    console.log(displayModaleText.value);
    displayModaleText.value = false;
    console.log(displayModaleText.value);
  }

  /********************************************** */

  return {
    modaleText,
    displayNewArticleForm,
    displayModaleText,
    toggleDisplayNewArticleForm,
  };
});
