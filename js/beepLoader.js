function popupClick() {
    //     location.reload();
    window.scrollTo(0, 0);
}

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

window.addEventListener("load", (event) => {
    observer.observe(containerFull, {childList: true, subtree: true});
    onAllContentLoaded();
});

window.addEventListener("scroll", (event) => {
    let d = document.documentElement;
    let offset = d.scrollTop + window.innerHeight;
    let height = d.offsetHeight;

    if (offset === height) {
        getTimeline();
        localStorage.setItem("beeps", document.querySelector("#beep-full-container").innerHTML);
    } else {
        let B = document.body;
        let D = document.documentElement;
        D = (D.clientHeight) ? D : B;

        if (D.scrollTop == 0) {
            if (newAuthors.length >= 1) {
                resetTimeline();
            }
        }
    }
});

function onAllContentLoaded() {
    const loadedDivs = containerFull.querySelectorAll('.loaded-beep');
    for (let i = 0; i < loadedDivs.length; i++) {
        const parent = loadedDivs[i].parentElement;
        const loader = parent.querySelector(".loading-beep");
        loader.style.setProperty("display", "none");
        loadedDivs[i].style.setProperty("display", "block");
    }
}

function checkImagesLoaded(loadedDiv) {
    let imagesLoaded = true;
    const images = loadedDiv.querySelectorAll('img');
    for (let i = 0; i < images.length; i++) {
        if (!images[i].complete) {
            imagesLoaded = false;
            break;
        }
    }
    return imagesLoaded;
}

const containerFull = document.getElementById("beep-full-container");

const observer = new MutationObserver(() => {
    const loadedDivs = containerFull.querySelectorAll('.loaded-beep');
    for (let i = 0; i < loadedDivs.length; i++) {
        if (checkImagesLoaded(loadedDivs[i])) {
            onAllContentLoaded();
        }
    }
});

const timelineResetter = document.querySelectorAll(".timeline_reset");
timelineResetter.forEach((btn) => {
    btn.addEventListener("click", (event) => {
        event.preventDefault();
    });
});

function resetTimeline() {
    window.scrollTo(0, 0);
    containerFull.innerHTML = "";
    getTimeline();
}