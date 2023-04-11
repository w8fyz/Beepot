<?php

include_once ("manager/post.php");

?>

<script>
    var beeps = document.getElementsByClassName("loaded-beep");
    var last = beeps[beeps.length-1];
    alert(last.id)

</script>