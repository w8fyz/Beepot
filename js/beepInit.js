const containerFull = document.getElementById("beep-full-container");

const observer = new MutationObserver(() => {
    const loadedDivs = containerFull.querySelectorAll('.loaded-beep');
    for (let i = 0; i < loadedDivs.length; i++) {
        if (checkImagesLoaded(loadedDivs[i])) {
            onAllContentLoaded();
        }
    }
});

window.addEventListener("load", (event) => {
    observer.observe(containerFull, { childList: true, subtree: true });
    onAllContentLoaded();
});