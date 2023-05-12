function popupClick() {
    //     location.reload();
    window.scrollTo(0, 0);
}

let pathname = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
if(pathname == "index.php" || pathname == "") {
if(localStorage.getItem("beeps") != null) {
    document.querySelector("#beep-full-container").insertAdjacentHTML("beforeend",
        localStorage.getItem("beeps"));
} else {
    getTimeline();
}
}
window.addEventListener("load", (event) => {
    observer.observe(containerFull, {childList: true, subtree: true});
    onAllContentLoaded();
});

function onBodyLoaded() {
    if(!localStorage.getItem("alreadyVisited")) {
        setTimeout(function () {
            localStorage.setItem("alreadyVisited", "1");
            onAllContentLoaded();
        }, 500);

    }
}

window.addEventListener("scroll", (event) => {
    let d = document.documentElement;
    let offset = d.scrollTop + window.innerHeight;
    let height = d.offsetHeight;
    if (offset >= height) {
        getTimeline();
        try {
            saveCache();
        } catch (e) {}
    } else {
        let B = document.body;
        let D = document.documentElement;
        D = (D.clientHeight) ? D : B;

        if (D.scrollTop == 0) {
            if (newAuthors.length >= 1) {
                resetTimeline();
                newAuthors.length = 0
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

var beeps = document.getElementsByClassName("loaded-beep");
var last = beeps[beeps.length-1];

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

function resetTimeline() {
    window.scrollTo(0, 0);
    containerFull.innerHTML = "";
    getTimeline();
}




function getTimeline(){
        let xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector("#beep-full-container").insertAdjacentHTML("beforeend",this.responseText);
            }
        };

        let beeps = document.getElementsByClassName("loaded-beep");
        let usableID = 9223372036854775807;
        if(beeps.length > 0) {
            usableID = beeps[beeps.length - 1].id.split("-")[1];
        }
        if(pathname.includes("profil.php")) {
            let params = new URLSearchParams(window.location.href.search);
            let id = params.get('id');
            xmlhttp.open("GET", "endpoint/getBeepFrom.php?lastID=" + usableID+"&id="+id, true);
        } else {
            xmlhttp.open("GET", "endpoint/getTimeline.php?lastID=" + usableID, true);
        }

        xmlhttp.send();

}