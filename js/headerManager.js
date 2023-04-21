function headerToTimeline() {
    event.preventDefault();
    if(getPageName() === "" || getPageName() === "index.php") {
       resetTimeline();
    } else {
        window.location.href = "index.php?action=resetTimeline";

    }
}

function getPageName() {
    let url = window.location.pathname;
    return url.substring(url.lastIndexOf('/') + 1);
}