<?php

require "utils/handleErrors.php";
require "manager/user.php";

require "utils/imports.php";




function isActive() {

}


?>
<link rel="shortcut icon" href="./assets/system/icon.svg" type="image/x-icon">
<link rel="stylesheet" href="./css/header.css">
<nav>
    <ul class="nav_up">
        <li>
            <a href="#" class="logo">
                <img style="width: 60px" src="./assets/system/icon.svg"/>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="#">
                <i class="bi <?php isActive() ?> bi-house"></i>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="#">
                <i class="bi bi-search"></i>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="#">
                <i class="bi bi-bell">
                      <span class="notification_pin badge rounded-pill bg-danger">
    3
    <span class="visually-hidden">unread messages</span>
                </i>

            </a>
        </li>
    </ul>
    </ul>
    <ul class="nav_down">
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="#">
                <i class="bi bi-person"></i>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="#">
                <i class="bi bi-gear"></i>
            </a>
        </li>
        <li class="waitLoad">
            <div class="spinner-grow text-secondary" role="status">
            </div>
            <a href="#">
                <i class="bi bi-box-arrow-left"></i>
            </a>
        </li>
    </ul>
</nav>

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
