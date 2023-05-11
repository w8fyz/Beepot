
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
    if(getDataAuthorValue(event.target) != null) {
        window.location.href ="profil.php?id="+findParent("beep-", event.target).dataset.author;
        return;
    }
    let id = findParent("beep-", event.target).id;
    window.location.href = "beep.php?id="+id.split("-")[1];
}

function getDataAuthorValue(element) {
    let parent = element.parentElement;
    while (parent) {
        if (parent.hasAttribute('data-author')) {
            return parent.getAttribute('data-author');
        }
        parent = parent.parentElement;
    }
    return null;
}


