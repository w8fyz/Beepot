<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";

?>

<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
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

echo "<body><button class='return_btn' href='' onclick='back()'><i class='bi bi-arrow-left-circle'></i></button>";
?>

</a>
<div id="beep-full-container">
<div id="noclick-beep">
<?php
if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $beep = $getBeep($id);

    echo "</div><h1 style='pointer-events: none;' class='response_title'>―――――――</h1>";

    $getResponses($id);


}

echo "</div>";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/messages.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/createPost.php";
?>
    <script src="./js/beepInit.js"</script>
    <script src="./js/beepSend.js"></script>
    <script src="./js/beepInteractions.js"</script>
    <script src="./js/utils.js"></script>
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

    document.querySelector("#beepContent").addEventListener('keydown', (event) => {
        if(event.ctrlKey && event.key == "Enter") {
            sendBeepButton.click();
        }
    });

    function resetTimeline() {
        window.scrollTo(0, 0);
        containerFull.innerHTML = "";
        getTimeline();
    }
</script>

    </body>
</html>