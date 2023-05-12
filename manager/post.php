<?php
include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/bdd.php");
$bdd = initBDD();

require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
function initloadBeep($addImg) {
    echo "<div class='loading-beep card mb-3'>
    <div class='card-body'>
        <div class='d-flex align-items-center'>
            <div class='placeholder-glow rounded-circle me-3' alt='avatar'><span style='width: 50px; height: 50px; border-radius: 50px;' class='placeholder col-4'></span></div>
            <div style='width: 200px'>
                <h5 class='card-title mb-0 placeholder-glow'><span class='placeholder col-10'></h5>
                <p class='card-subtitle text-muted placeholder-glow'><span class='placeholder col-6'></p>
            </div>
        </div>
        <p class='card-text placeholder-glow'>
              <span class='placeholder col-7'></span>
      <span class='placeholder col-4'></span>
</p>
        <div class='d-flex mt-3'>
            <div class='d-flex flex-wrap align-items-center placeholder-glow' style='display: block'>";

                if($addImg) {
                    echo "<span style='width: 150px; height: 150px;' class='placeholder col-7'>";
                }



     echo   "
            </div>
        </div>
        <div class='d-flex justify-content-between align-items-center mt-3'>
            <small style='width: 200px;' class='text-muted placeholder-glow'><span class='placeholder col-7'></span></small>
            <div class='d-flex align-items-center'>
                <button disabled type='button' class='btn btn-sm me-3'>
                    <div class='spinner-border text-warning' role='status'>
</div></button> 
            </div>
        </div>
    </div>
</div>";
}
function initformatBeep($id, $idAuthor, $profile_picture, $displayName, $username, $content, $medias = null, $date, $likes, $boost, $comments, $isLiked, $isBoosted) {

    $dateFormated = date( 'd/m/Y H:i:s',$date);

    echo "<div id='beep-$id' data-author='$idAuthor' class='loaded-beep card mb-3' onmousedown='clickPost(event)'>
    <div class='card-body'>
        <div class='d-flex align-items-center' onmousedown='goToUser(event, $idAuthor)'>
            <img src='assets/uploads/$profile_picture' class='rounded-circle me-3 skipClickPost' alt='avatar' style='max-width: 50px;'>
            <div>
                <h5 class='card-title mb-0 skipClickPost'>$displayName</h5>
                <p class='card-subtitle text-muted skipClickPost'>@$username</p>
            </div>
        </div>
        <p class='card-text mt-3'>$content</p>
        <div class='d-flex mt-3'>
            <div class='reduced-image-container d-flex flex-wrap align-items-center'>";
    if($medias != null) {
        foreach ($medias as $media) {
            echo "<img style='max-width: 150px;' src='assets/uploads/$media->fileName' alt='image 1'>";
        }
    }
    echo "</div>
        </div>
        <div class='d-flex justify-content-between align-items-center mt-3'>
            <div class='interactions d-flex align-items-center'>
            <div class='boost' onclick='interactBoost($id)'>
                <button style='border-color: transparent !important;' type='button' class='btn btn-sm me-3 skipClickPost'>
                    <i class='skipClickPost bi bi-rocket-takeoff$isBoosted'></i>
                </button>
                <small class='text-muted  skipClickPost'>$boost</small>
             </div>
            <div class='like' onclick='interactLike($id)'>
                <button style='border-color: transparent !important;' type='button' class='btn btn-sm me-3 skipClickPost'>
                    <i class='skipClickPost bi bi-heart$isLiked'></i>
                </button>
                <small class='text-muted skipClickPost'>$likes</small>
                </div>
            <div class='comment' onclick='interactComment($id)'>
                <button style='border-color: transparent !important;' type='button' class='btn btn-sm me-3 skipClickPost'>
                    <i class='bi bi-chat-left skipClickPost'></i>
                </button>
                <small class='text-muted skipClickPost'>$comments</small>
                </div>
            </div>
    <small class='text-muted removable skipClickPost'>$dateFormated</small>
        </div>
    </div>
</div>
";
?>
<div class='modal fade' id='imageModal' tabindex='-1' aria-labelledby='imageModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-body'>
        <div id='imageCarousel' class='carousel slide' data-bs-ride='carousel'>
          <div class='carousel-inner'>
    <?php
            if($medias != null) {
                $active = true;
                foreach ($medias as $media) {
                    echo "<div class='carousel-item ".($active ? "active" : "")."'>
                        <img src='assets/uploads/$media->fileName' class='d-block w-100' alt='image 1'>
                      </div>";
                    $active = false;
                }
            }
            ?>
          </div>
          <button class='carousel-control-prev' type='button' data-bs-target='#imageCarousel' data-bs-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Previous</span>
          </button>
          <button class='carousel-control-next' type='button' data-bs-target='#imageCarousel' data-bs-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    let exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let recipient = button.getAttribute('data-bs-whatever')
        let modalTitle = exampleModal.querySelector('.modal-title')
        let modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = 'New message to ' + recipient
        modalBodyInput.value = recipient
    })
</script>

<?php
}
function generateBeep($beep){

    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/files.php";
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/interaction.php";
    $creationDate = $beep->creationTimestamp;

    $author = $getUserById($beep->authorID);
    $content = $beep->content;

    $files = $getFiles($beep->id);

    $isLiked = "";
    $isBoosted = "";

    if($isLogged()) {
        if($haveInteracted("LIKE", $beep->id)) {
            $isLiked = "-fill";
        }
        if($haveInteracted("BOOST", $beep->id)) {
            $isBoosted = "-fill";
        }
    }

    $nbComments = $getInteractionsFromPostByType("COMMENT", $beep->id);
    $nbLikes = $getInteractionsFromPostByType("LIKE", $beep->id);
    $nbBoosts = $getInteractionsFromPostByType("BOOST", $beep->id);

    ?>
        <div class='beep-box'>
            <?=initloadBeep(false)?>
            <?=initformatBeep($beep->id, $author->id, $author->profile_picture, $author->displayName, $author->username, $content, $files, $creationDate,$nbLikes, $nbBoosts, $nbComments, $isLiked, $isBoosted)?>
        </div>
    <?php
};

$getBeepAsObject = function ($id) use ($bdd) {
    $request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) AS creationTimestamp  FROM post WHERE id = :id");
    $request->execute(['id' => $id]);
    if($request->rowCount()>0) {
        return $request->fetch(PDO::FETCH_OBJ);
    }
};

$getBeep = function ($id) use ($bdd) {
    $request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) AS creationTimestamp  FROM post WHERE id = :id");
    $request->execute(['id' => $id]);
    if($request->rowCount()>0) {
        generateBeep($request->fetch(PDO::FETCH_OBJ));
        return $request->fetch(PDO::FETCH_OBJ);
    }
};

$getTimeline = function ($lastID = PHP_INT_MAX) use ($bdd){
    $request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) 
    AS creationTimestamp FROM post WHERE id < :id AND idParent IS NULL ORDER BY id DESC LIMIT 10");
    $request->execute(['id' => $lastID]);
    $match = [];
    if($request->rowCount()>0) {

        foreach ($request->fetchAll(PDO::FETCH_OBJ) as $beep) {
            generateBeep($beep);
            $match[] = $beep;
        }
    }
    return $match;

};

$getBeepsFrom = function ($id) use ($bdd){
    $request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) AS creationTimestamp FROM post WHERE authorID = :id AND idParent IS NULL LIMIT 10");
    $request->execute(['id' => $id]);
    $match = [];
    if($request->rowCount()>0) {
        foreach ($request->fetchAll(PDO::FETCH_OBJ) as $beep) {
            generateBeep($beep);
            $match[] = $beep;
        }
    }
    return $match;
};

$getResponses = function ($id) use ($bdd){
    //$request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) AS creationTimestamp FROM post WHERE id > :id ORDER BY creationTimestamp DESC LIMIT 10");
    $request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) AS creationTimestamp FROM post WHERE idParent = :id");
    $request->execute(['id' => $id]);
    $match = [];
    if($request->rowCount()>0) {
        foreach ($request->fetchAll(PDO::FETCH_OBJ) as $beep) {
            generateBeep($beep);
            $match[] = $beep;
        }
    }
    return $match;
};

$createNewPost = function($content) use ($bdd) {
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    $user = $getUser();
    $request = $bdd->prepare("INSERT INTO post (authorID, content) VALUES (:authorID, :content)");
    $request->execute(['authorID' => $user->id, 'content' => $content]);
    return $bdd->lastInsertId();
};

$createNewReply = function($content, $idParent) use ($bdd) {
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    $user = $getUser();
    $request = $bdd->prepare("INSERT INTO post (authorID, content, idParent) VALUES (:authorID, :content, :idParent)");
    $request->execute(['authorID' => $user->id, 'content' => $content, 'idParent' => $idParent]);
    return $bdd->lastInsertId();
};
?>

