<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Un nouveau Beep ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="index.php">
                    <div class="mb-3">
                        <textarea name="beep_content" class="form-control" id="message-text"></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-warning">Beep!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

include_once("manager/user.php");
include_once("manager/post.php");

if(!$isLogged()) {
    return;
}

if(isset($_POST['beep_content'])) {
    $content = htmlspecialchars($_POST['beep_content']);
    $createNewPost($content);
    $page = $_SERVER['PHP_SELF'];
    echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
}

?>