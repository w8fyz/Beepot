<!doctype html>
<html lang="fr">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beepot</title>
</head>


<style>
    .card {
        margin-left: 100px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .card-title {
        font-size: 1rem;
    }

    .card-text {
        font-size: 1.4rem;
    }

    .card-text img {
        max-width: 150%;
        width: 150%;
        height: auto;
        margin-right: 10px;
    }

    .btn {
        font-size: 2rem;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
        display: block;
    }

</style>

<div class="card mb-3" style="max-width: 1200px;">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="https://via.placeholder.com/50x50" class="rounded-circle me-3" alt="avatar">
            <div>
                <h5 class="card-title mb-0">John Doe</h5>
                <p class="card-subtitle text-muted">@johndoe</p>
            </div>
        </div>
        <p class="card-text mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula, mi vel pharetra fringilla, lectus sapien dictum augue, vel ultricies massa lectus non velit. Fusce mollis augue quis tellus elementum, vel tristique neque suscipit. </p>
        <div class="d-flex justify-content-center mt-3">
            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 1">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 2">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 3">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 4">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Publié le 10 avril 2023</small>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-outline-primary btn-sm me-3">
                    <i class="bi bi-hand-thumbs-up"></i> J'aime
                </button>
                <small class="text-muted">4</small>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3" style="max-width: 1200px;">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <img src="https://via.placeholder.com/50x50" class="rounded-circle me-3" alt="avatar">
            <div>
                <h5 class="card-title mb-0">John Doe</h5>
                <p class="card-subtitle text-muted">@johndoe</p>
            </div>
        </div>
        <p class="card-text mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula, mi vel pharetra fringilla, lectus sapien dictum augue, vel ultricies massa lectus non velit. Fusce mollis augue quis tellus elementum, vel tristique neque suscipit. </p>
        <div class="d-flex justify-content-center mt-3">
            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 1">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 2">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 3">
                <img src="https://via.placeholder.com/150x150" class="img-fluid rounded m-1" alt="image 4">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Publié le 10 avril 2023</small>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-outline-primary btn-sm me-3">
                    <i class="bi bi-hand-thumbs-up"></i> J'aime
                </button>
                <small class="text-muted">4</small>
            </div>
        </div>
    </div>
</div>
<?php
require "components/header.php";
include "utils/messages.php";
?>
<body>
</body>
</html>