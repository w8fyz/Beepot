

let url = new URL(location.href);

if(url.searchParams.get("action") !== null) {
    console.log("CALLEEEEEEEEEEEEED")
    if(url.searchParams.get("action") === "reply") {
        let replyModal = document.querySelector("#replyModal");
        new bootstrap.Modal(replyModal).show();
    } else if(url.searchParams.get("action") === "resetTimeline") {
        resetTimeline();
    }
}

window.addEventListener("shown.bs.modal", function (event) {
    let replyModal = document.querySelector("#beepContent");
    replyModal.focus();
})

setTimeout(function () {
    let parameters = location.href.split("?");
    if(parameters.length >= 2 && (parameters[1].includes("status=") || parameters[1].includes("action="))) {
        let url = orderParams(["status", "action"], location.href).split("/");
        history.replaceState({}, document.title, url[url.length-1]);
    }
}, 10);

document.querySelector("#beepContent").addEventListener('keydown', (event) => {
    if(event.ctrlKey && event.key == "Enter") {
        sendBeepButton.click();
    }
});

function orderParams(keys, url) {
    let rtn = url.split("?")[0], param,  params_arr = [],
        queryString = (url.indexOf("?") !== -1) ? url.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (let i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            keys.forEach(function(key) {
               if(param === key) {
                   params_arr.splice(i, 1);
               }
            });
        }
        if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
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