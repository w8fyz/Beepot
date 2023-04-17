const beepContainer = document.querySelector("#beep-full-container");
function getTimeline(){
    console.log("START");
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let beeps = JSON.parse(this.responseText);
            for (let i = 0; i < beeps.length; i++) {
                let beep = beeps[i];
                console.log("BEEP : "+i);

                let isBoosting = "";
                let isLiking = "";
                if(isInteracting("BOOST", beep.id)) {
                    isBoosting = "-full";
                }
                if(isInteracting("LIKE", beep.id)) {
                    isLiking = "-full";
                }

                let user = getBasicUserInfo(beep.authorID);
                console.log(beep.authorID);
                generateBeep(beep, user, getFiles(beep.id), isBoosting, isLiking, getNumberOfInteraction("LIKE", beep.id), getNumberOfInteraction("BOOST", beep.id), getNumberOfInteraction("COMMENT", beep.id));
            }
        }
    };

    const beeps = document.getElementsByClassName("loaded-beep");
    let usableID = 9223372036854775807;
    if(beeps.length > 0) {
        usableID = beeps[beeps.length - 1].id.split("-")[1];
    }
    xmlhttp.open("GET", "endpoint/getTimeline.php?lastID=" + usableID, true);
    xmlhttp.send();

}

function getFiles(id) {
    fetch("endpoint/getBeepFiles.php?idPost="+id, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            if(data.length > 3) {
                return JSON.parse(data);
            }
            return false;
        })
        .catch((error) => {
            console.error(error);
        });
}
function getBasicUserInfo(id) {
    fetch("endpoint/getBasicUser.php?id="+id, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {

            if(JSON.stringify(data).length > 5) {
                console.log("D CALLED : "+JSON.stringify(data));
                return JSON.parse(data);
            }
            return false;
        })
        .catch((error) => {
            console.error(error);
        });
}

function getNumberOfInteraction(type, id) {
    fetch("endpoint/getInteraction.php?type="+type+"&target="+id, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            return JSON.parse(data).length;
        })
        .catch((error) => {
            console.error(error);
        });
}

function isInteracting(id, type) {
    fetch("endpoint/isInteracting.php?type="+type+"&target="+id, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            if(data === "true") {
                return true;
            }
            return false;
        })
        .catch((error) => {
            console.error(error);
        });
}

function mediasHTML(medias) {
    let html = '';
    if (medias != null) {
        medias.forEach(media => {
            html += `<img src='assets/uploads/${media.fileName}' class='img-fluid rounded m-1' alt='image 1'>`;
        });
    }
    return `<div class='reduced-image-container d-flex flex-wrap align-items-center'>${html}</div>`;
}


function generateBeep(beep, user, files, isBoosting, isLiking, likes, boosts, comments) {
    console.log(user);
    const options = { year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
    const dateFormatted = new Intl.DateTimeFormat('fr-FR', options).format(new Date(beep.creationDate));
    const beepHtml = `
    <div id="beep-${beep.id}" data-author="${user.id}" class="loaded-beep card mb-3" onmousedown="clickPost(event)">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/50x50" class="rounded-circle me-3 skipClickPost" alt="avatar">
                <div>
                    <h5 class="card-title mb-0 skipClickPost">${user.displayName}</h5>
                    <p class="card-subtitle text-muted skipClickPost">@${user.username}</p>
                </div>
            </div>
            <p class="card-text mt-3">${beep.content}</p>
            <div class="d-flex mt-3">
                    ${mediasHTML(files)}
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="interactions d-flex align-items-center">
                    <div class="boost" onclick="interactBoost(${beep.id})">
                        <button style="border-color: transparent !important;" type="button" class="btn btn-sm me-3 skipClickPost">
                            <i class="skipClickPost bi bi-rocket-takeoff${isBoosting}"></i>
                        </button>
                        <small class="text-muted skipClickPost">${boosts}</small>
                    </div>
                    <div class="like" onclick="interactLike(${beep.id})">
                        <button style="border-color: transparent !important;" type="button" class="btn btn-sm me-3 skipClickPost">
                            <i class="skipClickPost bi bi-heart${isLiking}"></i>
                        </button>
                        <small class="text-muted skipClickPost">${likes}</small>
                    </div>
                    <div class="comment" onclick="interactComment(${beep.id})">
                        <button style="border-color: transparent !important;" type="button" class="btn btn-sm me-3 skipClickPost">
                            <i class="bi bi-chat-left skipClickPost"></i>
                        </button>
                        <small class="text-muted skipClickPost">${comments}</small>
                    </div>
                </div>
                <small class="text-muted removable skipClickPost">${dateFormatted}</small>
            </div>
        </div>
    </div>
`;
    console.log("CALLED : "+beepHtml);
    beepContainer.insertAdjacentHTML("afterbegin", beepHtml);
}