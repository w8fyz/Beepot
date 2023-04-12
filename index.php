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

$getTimeline();

include "utils/messages.php";

include "manager/createPost.php";
?>

<script>

    window.addEventListener("load", () => {

        for(const element of document.querySelectorAll(".beep-box")) {
            const loader = element.querySelector(".loading-beep");
            const loaded = element.querySelector(".loaded-beep");
            loader.style.setProperty("display", "none");
            loaded.style.setProperty("display", "block");
        }
    });
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<script>
    var beeps = document.getElementsByClassName("loaded-beep");
    var last = beeps[beeps.length-1];


    window.addEventListener("scroll", (event) => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               document.write(this.responseText);
            }
        };
        usableID = last.id.split("-")[1];
        xmlhttp.open("GET", "endpoint/getTimeline.php?lastID="+usableID, true);
        xmlhttp.send();
    });
</script>
<body>
</body>
</html>