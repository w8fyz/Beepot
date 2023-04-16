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
    <link rel="stylesheet" href="css/postPage.css">
    <title>Beepot</title>
</head>

<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/components/header.php";

include parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/post.php";

$last = $_GET['id'];

echo "<button class='return_btn' href='' onclick='back()'><i class='bi bi-arrow-left-circle'></i></button>";
?>

</a>
<div id="beep-full-container">

<?php
if(isset($_GET['id'])) {
    $beep = $getBeep($_GET['id']);

    echo "<h1 class='response_title'>―――――――</h1>";

    $getResponses($_GET['id']);


}

echo "</div>";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/messages.php";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/createPost.php";
?>

<script>

    function back(){
        history.back();
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
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const beepBox = document.createElement('div');
                    beepBox.innerHTML = this.responseText;
                    containerFull.appendChild(beepBox);
                }
            };
            usableID = last.id.split("-")[1];
            xmlhttp.open("GET", "endpoint/getTimeline.php?lastID="+usableID, true);
            xmlhttp.send();
        } else {
            let B = document.body;
            let D = document.documentElement;
            D = (D.clientHeight)? D: B;

            if (D.scrollTop == 0){
                if(newAuthors.length >= 1) {
                    location.reload();
                }
            }
        }
    });
</script>
    <script src="./js/beepInteractions.js"></script>
<body>
</body>
</html>