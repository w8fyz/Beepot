<?php
require "utils/handleErrors.php";

?>

<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Expires" content="Tue, 01 Jan 1995 12:12:12 GMT">
    <meta http-equiv="Pragma" content="no-cache">
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

    function appendHtml(el, str) {
        var div = document.createElement('div');
        div.innerHTML = str;
        while (div.children.length > 0) {
            el.appendChild(div.children[0]);
        }
    }

    window.addEventListener("scroll", (event) => {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            <?php
            $lastID = "<script>document.write(last)</script>"
            ?>
            var html = HtmlSanitizer.SanitizeHtml("<?php echo $getTimeline($lastID);?>");
            document.write(html);

        }
    });
</script>
<body>
</body>
</html>