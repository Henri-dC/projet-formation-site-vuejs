<template>
  <div id="footer-container">
    <div id="social">
      <a
        href="https://github.com/TontonRitonBZH/Deskin"
        target="blank"
        title="Mon GitHub"
        ><i class="fa-brands fa-github fa-2x"></i
      ></a>
      <a
        href="https://www.linkedin.com/in/henridc/"
        target="blank"
        title="LinkedIn"
        ><i class="fa-brands fa-linkedin fa-2x"></i
      ></a>
      <router-link title="jouer au morpion" to="/morpion">Morpion</router-link>
    </div>
  </div>
</template>

<style scoped>
#footer-container {
  position: absolute;

  width: 100%;
  background-color: var(--main-bg-color);
  text-align: center;
  padding: 2em 0;
  border: 1px solid black;
}

i {
  margin-left: 1em;
  color: white;
}
</style>
