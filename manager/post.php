<link rel="stylesheet" href="css/post.css">

<?php

function getMedias($medias) {
    foreach ($medias as $media) {
        //echo "<img src='assets/upload/$media->name'. class='img-fluid rounded m-1' alt='image 1'>";
        return "<img src='https://via.placeholder.com/150x150' class='img-fluid rounded m-1' alt='image 1'>";
    }
}

function loadBeep() {
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
      <span class='placeholder col-4'></span>
</p>
        <div class='d-flex justify-content-center mt-3'>
            <div class='d-flex flex-wrap justify-content-center align-items-center'>" ."
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
function formatBeep($displayName, $username, $content, $medias, $date, $likes) {
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
        getMedias($medias) ."
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

?>