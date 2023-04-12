function graphicLoadBeep(id) {
    console.log(id)
    const element = document.getElementById(id).parentElement;
    const loader = element.querySelector(".loading-beep");
    const loaded = element.querySelector(".loaded-beep");
    loader.style.setProperty("display", "none");
    loaded.style.setProperty("display", "block");
}