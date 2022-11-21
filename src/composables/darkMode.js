function darkMode(bool) {
  let root = document.querySelector(":root");
  if (!bool) {
    root.style.setProperty("--main-text-color", "#87e7e1");
    root.style.setProperty("--third-bg-color", "#121212");
    root.style.setProperty("--dm-bg-color", "#888");
    let body = document.querySelector("body");
  } else {
    root.style.setProperty("--main-text-color", "black");
    root.style.setProperty("--third-bg-color", "white");
    root.style.setProperty("--dm-bg-color", "white");
  }
}

export { darkMode };
