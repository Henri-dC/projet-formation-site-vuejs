function welcomeModale() {
  let div = document.createElement("div");
  div.id = "welcomeModale";
  let body = document.querySelector("body");

  const newspaperSpinning = [
    { transform: " scale(1) " },
    { transform: "scale(0) " },
  ];

  const newspaperTiming = {
    duration: 6000,
    iterations: 1,
  };

  body.appendChild(div);

  const texte = "Bienvenue sur tontonriton.com !";

  /** ********************************************************************************************** */

  function createSpan(p) {
    let textTab = texte.split(" ");
    textTab.forEach((mot) => {
      let span = document.createElement("p");
      span.style.display = "inline";
      let motTab = mot.split("");

      motTab.forEach((lettre, indice) => {
        let spanLettre = document.createElement("span");
        spanLettre.style.display = "inline-block";
        spanLettre.innerHTML = lettre;
        span.appendChild(spanLettre);
        spanLettre.id = "span" + indice;
      });

      p.appendChild(span);
      span.style.margin = "10px";
    });
  }
  createSpan(div);

  const letters = document.querySelectorAll("span");

  function animation() {
    let i = 0;
    let j = letters.length - 1;
    let interval = setInterval(color, 100);
    function color() {
      letters[i].style.color = "white";
      i++;
      j--;
      if (i === letters.length) {
        clearInterval(interval);
        setTimeout(red, 2000);
        setTimeout(white, 2075);
        setTimeout(red, 2150);
        setTimeout(white, 2225);
        setTimeout(red, 2250);
        setTimeout(white, 2275);
        setTimeout(red, 2300);
        setTimeout(transformation, 1000);
      }
    }
  }

  function red() {
    letters.forEach((lettre) => {
      lettre.style.color = "red";
    });
  }
  function white() {
    letters.forEach((lettre) => {
      lettre.style.color = "white";
    });
  }

  let i = 0;
  function transformation() {
    letters.forEach((lettre) => {
      lettre.style.rotate = i + "deg";
      lettre.style.top = "10px";
      i++;
    });
  }

  let j = 1;

  animation();
}

export { welcomeModale };
