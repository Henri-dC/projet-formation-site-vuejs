<template>
  <div>
    <i
      @click="addLike(props.article)"
      class="fa-sharp fa-solid fa-thumbs-up fa-xl icon"
      :class="{ active: LikesStore.isLikedByUser(props.article) }"
    ></i
    ><data>{{ likeCounter(props.article) }}</data>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useLikesStore } from "../store/LikesStore";
import { useUserStore } from "../store/UserStore.js";
import { useServiceStore } from "../store/ServiceStore.js";
const LikesStore = useLikesStore();
const UserStore = useUserStore();
const ServiceStore = useServiceStore();
const props = defineProps(["article"]);

function likeCounter(articleId) {
  return LikesStore.getLikeByArt(articleId);
}

function addLike(articleId) {
  if (UserStore.user) {
    LikesStore.addLike(articleId, UserStore.user._id);
  } else {
    ServiceStore.toggleDisplaySignForm();
  }
}
</script>

<style lang="scss" scoped>
.fa-thumbs-up {
  color: var(--second-bg-color);
}

.fa-thumbs-up:hover,
.active {
  color: var(--main-bg-color);
}

data {
  margin-left: 6px;
  font-family: "Marhey";
  font-size: 1.4em;
  color: var(--main-text-color);
}
</style>
