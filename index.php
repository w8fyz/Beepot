<?php
require "utils/handleErrors.php";

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beepot</title>
</head>

<?php
require "components/header.php";

include "manager/post.php";

?>

<div id="beep-full-container">

<?php

$getTimeline();

echo "</div>";

include "utils/messages.php";

include "manager/createPost.php";
?>

<script>
 /*   window.addEventListener("load", () => {

        for(const element of document.querySelectorAll(".beep-box")) {
            graphicLoadBeep(element);
        }
    });*/

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<script>
    var beeps = document.getElementsByClassName("loaded-beep");
    var last = beeps[beeps.length-1];

    function onAllContentLoaded() {
        console.log("onAllContentLoaded");
        const loadedDivs = containerFull.querySelectorAll('.loaded-beep');
        for (let i = 0; i < loadedDivs.length; i++) {
            const parent = loadedDivs[i].parentElement;
            const loader = parent.querySelector(".loading-beep");
            console.log("Loader found: ", loader);
            console.log("Loaded div found: ", loadedDivs[i]);
            loader.style.setProperty("display", "none");
            loadedDivs[i].style.setProperty("display", "block");
        }
    }

    function checkImagesLoaded(loadedDiv) {
        console.log("Checking images loaded");
        let imagesLoaded = true;
        const images = loadedDiv.querySelectorAll('img');
        for (let i = 0; i < images.length; i++) {
            if (!images[i].complete) {
                imagesLoaded = false;
                break;
            }
        }
        console.log("Images loaded: ", imagesLoaded);
        return imagesLoaded;
    }

    const containerFull = document.getElementById("beep-full-container");

    const observer = new MutationObserver(() => {
        console.log("Mutation detected");
        const loadedDivs = containerFull.querySelectorAll('.loaded-beep');
        for (let i = 0; i < loadedDivs.length; i++) {
            if (checkImagesLoaded(loadedDivs[i])) {
                console.log("All images in div loaded-beep are loaded!");
                onAllContentLoaded();
            }
        }
    });

    window.addEventListener("load", (event) => {
        observer.observe(containerFull, { childList: true, subtree: true });
        onAllContentLoaded();
    });

    window.addEventListener("scroll", (event) => {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("New beep-box loaded");
                    const beepBox = document.createElement('div');
                    beepBox.innerHTML = this.responseText;
                    containerFull.appendChild(beepBox);
                }
            };
            usableID = last.id.split("-")[1];
            xmlhttp.open("GET", "getTimeline.php?lastID="+usableID, true);
            xmlhttp.send();
        }
    });

</script>
<body>
</body>
</html>