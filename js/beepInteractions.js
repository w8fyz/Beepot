function interactLike(id) {
    fetch("manager/interactPost.php?type=LIKE&target="+id, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            if(data === "not_logged") {
                window.location = "register.php";
                return;
            }
          displayLike(id, data);
          if(getPageName() === "" || getPageName() === "index.php") {
              localStorage.setItem("beeps", document.querySelector("#beep-full-container").innerHTML);
          }
        })
        .catch((error) => {
            window.location = "register.php";
        });

}

function displayLike(id, activated) {
    const beep = document.getElementById("beep-"+id);
    const ico = beep.querySelector(".like i");
    const text = beep.querySelector(".like small")
    if(activated) {
        text.textContent = Number(text.textContent)-1;
        ico.classList.remove("bi-heart-fill");
        ico.classList.add("bi-heart");
    } else {
        text.textContent = Number(text.textContent)+1;
        ico.classList.add("bi-heart-fill");
        ico.classList.remove("bi-heart");
    }

}

function interactBoost(id) {
    fetch("manager/interactPost.php?type=BOOST&target="+id, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            if(data === "NOT LOGGED") {
                window.location = "register.php";
                return;
            }
            displayBoost(id, data);
            if(getPageName() === "" || getPageName() === "index.php") {
                localStorage.setItem("beeps", document.querySelector("#beep-full-container").innerHTML);
            }
        })
        .catch((error) => {
            window.location = "register.php";
        });
}

function displayBoost(id, activated) {
    const beep = document.getElementById("beep-"+id);
    const ico = beep.querySelector(".boost i");
    const text = beep.querySelector(".boost small")
    if(activated) {
        text.textContent = Number(text.textContent)-1;
        ico.classList.remove("bi-rocket-takeoff-fill");
        ico.classList.add("bi-rocket-takeoff");
    } else {
        text.textContent = Number(text.textContent)+1;
        ico.classList.add("bi-rocket-takeoff-fill");
        ico.classList.remove("bi-rocket-takeoff");
    }
}

function findParent(toFind, element) {
    let currentElement = element;
    while (currentElement.parentNode) {
        currentElement = currentElement.parentNode;
        if (currentElement.id && currentElement.id.startsWith(toFind)) {
            return currentElement;
        }
    }
    return null;
}

function openBeepPopup() {
    event.preventDefault();
    let replyModal = document.querySelector(".defaultModal");
    if(replyModal != null && replyModal.querySelector("form").length > 0) {
        if(replyModal.querySelector(".temp_input") != null) {
            replyModal.querySelector(".temp_input").remove();
        }
        replyModal.querySelector(".modal-title").textContent = "Nouveau Beep";
        new bootstrap.Modal(replyModal).show();
    }
}

function interactComment(id) {
    let beep = document.querySelector("#beep-"+id)
    if(findParent("noclick-beep", beep)) {
        let replyModal = document.querySelector(".defaultModal");
        if(replyModal != null && replyModal.querySelector("form").length > 0) {
            if(replyModal.querySelector(".temp_input") == null) {
                replyModal.querySelector("form").insertAdjacentHTML("beforeend", "<div class='temp_input'><input hidden='hidden' name='idParent' value='" + id + "'></div>");
            }
            replyModal.querySelector(".modal-title").textContent = "Nouvelle réponse";
            new bootstrap.Modal(replyModal).show();
        }
    } else {
        window.location = "beep.php?id="+id+"&action=reply";
    }
}