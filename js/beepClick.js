
function clickPost(event) {
    if (window.getSelection().toString().length > 0) {
     return;
    }
    if(event.button !== 0) {
        return;
    }
    if(findParent("noclick-beep", event.target) != null) {
        return;
    }
    if(event.target.classList.contains("skipClickPost")) {
        return;
    }
    let id = findParent("beep-", event.target).id;
    window.location.href = "beep.php?id="+id.split("-")[1];
}


