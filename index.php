<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";

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
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/components/header.php";

include parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/post.php";

?>

<div id="beep-full-container">

<?php
$getTimeline();

echo "</div>";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/messages.php";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/createPost.php";
?>

    <div class="popup" id="popup">
        + 30 Beeps
    </div>

<script>
 /*   window.addEventListener("load", () => {

        for(const element of document.querySelectorAll(".beep-box")) {
            graphicLoadBeep(element);
        }
    });*/

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

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

    window.addEventListener("scroll", (event) => {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
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