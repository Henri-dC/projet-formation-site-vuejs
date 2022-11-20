/**** FONCTION PRINCIPALE **** */

function welcomeModale() {
  const texte = "Bienvenue sur Deskiñ !";
  let div = document.createElement("div");
  div.id = "welcomeModale";
  div.style.textAlign = "center";
  let body = document.querySelector("body");
  body.appendChild(div);

  //We create a span tag for each letter of the texte
  //Then we animate
  createSpan(div, texte);
  const letters = document.querySelectorAll("span");
  animation(letters);
}

/**** FONCTIONS ANNEXES **** */

//This function insert texte in element with each word in "p" tag and letters in "span" tag

function createSpan(element, texte) {
  //First we push each word in an array : textTab
  let textTab = texte.split(" ");

  //For each word, we create a "p" tag
  textTab.forEach((mot) => {
    let p = document.createElement("p");
    p.style.display = "inline";

    //Then we push each letter in "span" tag
    let motTab = mot.split("");
    motTab.forEach((lettre, indice) => {
      let spanLettre = document.createElement("span");
      spanLettre.style.display = "inline-block";
      spanLettre.innerHTML = lettre;
      p.appendChild(spanLettre);
      spanLettre.id = "span" + indice;
    });

    element.appendChild(p);
    p.style.margin = "10px";
  });
}

//This function animate the texte

function animation(letters) {
  let i = 0;

  let interval = setInterval(color, 100);
  function color() {
    letters[i].style.color = "white";
    i++;

    if (i === letters.length) {
      clearInterval(interval);
      setTimeout(colorChange, 2000, letters, "var(--main-bg-color)");
      setTimeout(colorChange, 2075, letters, "white");
      setTimeout(colorChange, 2150, letters, "var(--main-bg-color)");
      setTimeout(colorChange, 2225, letters, "white");
      setTimeout(colorChange, 2250, letters, "var(--main-bg-color)");
      setTimeout(colorChange, 2275, letters, "white");
      setTimeout(colorChange, 2300, letters, "var(--main-bg-color)");
      setTimeout(transformation, 1000, letters);
    }
  }
}

//Here we change letter's colors
function colorChange(letters, colorChoice) {
  letters.forEach((lettre) => {
    lettre.style.color = `${colorChoice}`;
  });
}

//Here we do transformations like rotation
function transformation(letters) {
  let i = 0;
  letters.forEach((lettre) => {
    lettre.style.rotate = i + "deg";
    lettre.style.top = "10px";
    i++;
  });
}

export { welcomeModale };
