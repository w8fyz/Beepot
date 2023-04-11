<link rel="stylesheet" href="css/post.css">

<?php

include_once("./utils/bdd.php");
$bdd = initBDD();

require "manager/user.php";
function initloadBeep($addImg)
{
    echo "<div class='loading-beep card mb-3'>
    <div class='card-body'>
        <div class='d-flex align-items-center'>
            <div class='placeholder-glow rounded-circle me-3' alt='avatar'><span style='width: 50px; height: 50px; border-radius: 50px;' class='placeholder col-4'></span></div>
            <div style='width: 200px'>
                <h5 class='card-title mb-0 placeholder-glow'><span class='placeholder col-10'></h5>
                <p class='card-subtitle text-muted placeholder-glow'><span class='placeholder col-6'></p>";
}

    function getMedias($medias)
    {
        foreach ($medias as $media) {
            //echo "<img src='assets/upload/$media->name'. class='img-fluid rounded m-1' alt='image 1'>";
            return "<img src='https://via.placeholder.com/150x150' class='img-fluid rounded m-1' alt='image 1'>";
        }
    }

    function loadBeep()
    {
        echo "<div class='card mb-3' style='width: 50vw;'>
    <div class='card-body'>
        <div class='d-flex align-items-center'>
            <img src='https://via.placeholder.com/50x50' class='rounded-circle me-3' alt='avatar'>
            <div>
                <h5 class='card-title placeholder-glow'><span class='placeholder col-6'></span></h5>
                <p class='card-title placeholder-glow'><span class='placeholder col-6'></span></p>
            </div>
        </div>
        <p class='card-text placeholder-glow'>
              <span class='placeholder col-7'></span>
      <span class='placeholder col-4'></span>
</p>
        <div class='d-flex mt-3'>
            <div class='d-flex flex-wrap align-items-center placeholder-glow' style='display: block'>";

        if ($addImg) {
            echo "<span style='width: 150px; height: 150px;' class='placeholder col-7'>";
        }


        echo "
            </div>
        </div>
        <div class='d-flex justify-content-between align-items-center mt-3'>
            <small style='width: 200px;' class='text-muted placeholder-glow'><span class='placeholder col-7'></span></small>
            <div class='d-flex align-items-center'>
                <button disabled type='button' class='btn btn-sm me-3'>
                    <div class='spinner-border text-warning' role='status'>
</div></button> 
      <span class='placeholder col-4'></span>
</p>
        <div class='d-flex justify-content-center mt-3'>
            <div class='d-flex flex-wrap justify-content-center align-items-center'>" . "
            </div>
        </div>
        <div class='d-flex justify-content-between align-items-center mt-3'>
            <small class='text-muted '><span class='placeholder col-7'></span></small>
            <div class='d-flex align-items-center'>
                <button type='button' class='btn btn-outline-primary btn-sm me-3'>
                    <i class='bi bi-hand-thumbs-up'></i>       <span class='placeholder col-3'></span>
                </button>
                <small class='text-muted placeholder-glow'><span class='placeholder col-2'></span></small>
            </div>
        </div>
    </div>
</div>";
    }

    function initformatBeep($id, $displayName, $username, $content, $medias = null, $date, $likes)
    {
        echo "<div id='beep-$id' class='loaded-beep card mb-3' onmousedown='clickPost(event)'>
    <div class='card-body'>
        <div class='d-flex align-items-center'>
            <img src='https://via.placeholder.com/50x50' class='rounded-circle me-3 skipClickPost' alt='avatar'>
            <div>
                <h5 class='card-title mb-0 skipClickPost'>$displayName</h5>
                <p class='card-subtitle text-muted skipClickPost'>@$username</p>
            </div>
        </div>
        <p class='card-text mt-3'>$content</p>
        <div class='d-flex mt-3'>
            <div class='reduced-image-container d-flex flex-wrap align-items-center''>";
        if ($medias != null) {
            foreach ($medias as $media) {
                $resolution = rand(150, 2000) . "x" . rand(150, 2000);
                //echo "<img src='assets/upload/$media->name'. class='img-fluid rounded m-1' alt='image 1'>";
                echo "<img src='https://via.placeholder.com/150x150' class='img-fluid rounded m-1' alt='image 1'>";
            }
        }
        echo "</div>
        </div>
        <div class='d-flex justify-content-between align-items-center mt-3'>
            <div class='interactions d-flex align-items-center'>
            <div class='boost'>
                <button style='border-color: transparent !important;' type='button' class='btn btn-sm me-3 skipClickPost'>
                    <i class='bi bi-rocket-takeoff  skipClickPost'></i>
                </button>
                <small class='text-muted  skipClickPost'>$likes</small>
             </div>
            <div class='like'>
                <button style='border-color: transparent !important;' type='button' class='btn btn-sm me-3 skipClickPost'>
                    <i class='bi bi-heart  skipClickPost'></i>
                </button>
                <small class='text-muted  skipClickPost'>$likes</small>
                </div>
            <div class='comment'>
                <button style='border-color: transparent !important;' type='button' class='btn btn-sm me-3 skipClickPost'>
                    <i class='bi bi-chat-left  skipClickPost'></i>
                </button>
                <small class='text-muted  skipClickPost'>$likes</small>
                </div>
            </div>
    <small class='text-muted removable  skipClickPost'>$date</small>";
    }

    function formatBeep($displayName, $username, $content, $medias, $date, $likes)
    {
        echo "<div class='card mb-3' style='width: 50vw;'>
    <div class='card-body'>
        <div class='d-flex align-items-center'>
            <img src='https://via.placeholder.com/50x50' class='rounded-circle me-3' alt='avatar'>
            <div>
                <h5 class='card-title mb-0'>$displayName</h5>
                <p class='card-subtitle text-muted'>@$username</p>
            </div>
        </div>
        <p class='card-text mt-3'>$content</p>
        <div class='d-flex justify-content-center mt-3'>
            <div class='d-flex flex-wrap justify-content-center align-items-center'>" .
            getMedias($medias) . "
            </div>
        </div>
        <div class='d-flex justify-content-between align-items-center mt-3'>
            <small class='text-muted'>$date</small>
            <div class='d-flex align-items-center'>
                <button type='button' class='btn btn-outline-primary btn-sm me-3'>
                    <i class='bi bi-hand-thumbs-up'></i> Nectar
                </button>
                <small class='text-muted'>$likes</small>
            </div>
        </div>
    </div>
</div>";
    }

    function generateBeep($beep)
    {

        require "manager/user.php";

        $creationDate = $beep->creationTimestamp;

        $author = $getUserById($beep->authorID);
        $content = $beep->content;

        echo "<div class='beep-box'>";
        echo initloadBeep(false);
        echo initformatBeep($beep->id, $author->displayName, $author->username, $content, [0, 0, 0, 0], date('d-m-Y H:i:s', $creationDate), 0);
        echo "</div>";
    }



    $createNewPost = function ($content) use ($bdd) {
        require "manager/user.php";
        $user = $getUser();
        $request = $bdd->prepare("INSERT INTO post (authorID, content) VALUES (:authorID, :content)");
        $request->execute(['authorID' => $user->id, 'content' => $content]);
    };

    $getTimeline = function ($lastID = 0) use ($bdd){
        $request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) AS creationTimestamp FROM post WHERE id > :id ORDER BY creationTimestamp DESC LIMIT 50");
        $request->execute(['id' => $lastID]);
        if($request->rowCount()>0) {
            foreach ($request->fetchAll(PDO::FETCH_OBJ) as $beep) {
                generateBeep($beep);
            }
        } else {
            echo "<h1>Seulement toi, et moi :)</h1>";
        }
    };

?>

<script>
    function clickPost(event) {
        if (window.getSelection().toString().length > 0) {
            return;
        }
        if(event.target.classList.contains("skipClickPost")) {
            return;
        }
        console.log("Hello World!");
    }
</script>