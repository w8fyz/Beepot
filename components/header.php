<?php

require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/handleErrors.php";
require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/imports.php";



?>
<link rel="shortcut icon" href="./assets/system/icon.svg" type="image/x-icon">
<link rel="stylesheet" href="./css/header.css">
<nav>
    <ul class="nav_up">
        <li>
            <a href="" onclick="headerToTimeline()" class="timeline_reset logo">
                <img style="width: 60px" src="./assets/system/icon.svg"/>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="" onclick="headerToTimeline()" class="timeline_reset">
                <i class="bi bi-house"></i>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="search.php">
                <i class="bi bi-search"></i>
            </a>
        </li>
        <?php if($isLogged()) { ?>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="notifications.php">
                <i class="bi bi-bell">
                    <?php
                    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/interaction.php";
                    $interactions = $getAllInteractions($getUser()->id, false);
                    if(sizeof($interactions) > 0) {?>
                      <span class="notification_pin badge rounded-pill bg-danger">
    <?php echo sizeof($interactions); ?>
    <span class="visually-hidden">notifications</span>
                          <?php }?>
                </i>

            </a>
        </li>
            <li class="waitLoad">
                <div class="spinner-grow text-secondary" role="status">
                </div>

                <a href="" style="border-color: transparent !important;" onclick="openBeepPopup()"><i style="color: #FF9B00;" class="bi bi-pencil-square"></i></a>
            </li>
        <?php }?>
    </ul>
    </ul>
    <ul class="nav_down">
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="<?php if($isLogged()) { echo 'profil.php'; } else { echo 'login.php'; }?> ">
                <i class="bi bi-person"></i>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="settings.php">
                <i class="bi bi-gear"></i>
            </a>
        </li>
        <?php if($isLogged()) { ?>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="logout.php">
                <i class="bi bi-box-arrow-left"></i>
            </a>
        </li>
        <?php }?>
    </ul>
</nav>
<script src="./js/headerManager.js"></script>
<script>

    window.addEventListener("load", () => {

        for(const element of document.querySelectorAll(".waitLoad")) {
            const spinner = element.children.item(0);
            spinner.style.setProperty("display", "none");
            const btn = element.children.item(1);
            btn.style.setProperty("display", "list-item");
        }
    });

    window.addEventListener("DOMContentLoaded", () => {
        for(const element of document.getElementsByClassName("bi")) {
            element.style.setProperty("transition", "0.3s");
        }

    });
</script>