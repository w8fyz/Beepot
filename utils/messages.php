<?php

if(isset($_GET['status'])) {
    switch (htmlspecialchars($_GET['status'])) {

        case "registerSuccess":
            message("Parfait ! Vous venez de recevoir un mail pour confirmer votre nouveau compte, merci de rejoindre la communauté de Beepot !");
            break;
        case "loginSuccess":
            message("Rebonjour ! Bon voyage sur Beepot, vous avez sûrement des choses à rattraper !");
            break;
        default:
            break;
    }
}

function message($description) {
    echo "
    <div class='toast-container  position-fixed bottom-0 end-0 p-3'>
<div class='toast show align-items-center text-bg-warning border-0' role='alert' aria-live='assertive' aria-atomic='true'>
  <div class='d-flex'>
    <div class='toast-body'>
      $description
    </div>
    <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
  </div>
</div>";
}

?>
