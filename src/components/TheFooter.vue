<template>
  <div id="footer-container">
    <div id="social-link">
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
      <router-link title="jouer au morpion" to="/morpion">
        <img
          id="morpion-img"
          src="https://www.tontonriton.com/assets/Font SVG/pest_control_FILL0_wght400_GRAD0_opsz48.svg"
          title="Jouer au morpion"
        />
      </router-link>
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

/*Links */

#social-link {
  display: flex;
  align-items: start;
  justify-content: center;
}

i {
  margin-left: 1em;
  color: white;
}

#morpion-img {
  border-radius: 10px;
  margin-left: 2em;
  color: white;
  background-color: white;
  width: 2em;
}
</style>
