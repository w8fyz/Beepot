
function clickPost(event) {
    if (window.getSelection().toString().length > 0) {
     return;
    }
    if(event.button !== 0) {
        return;
    }
    if(event.target.classList.contains("skipClickPost")) {
        return;
    }
    let id = findParentBeep(event.target).id;
    window.location.href = "beep.php?id="+id.split("-")[1];
}


function findParentBeep(element) {
    let currentElement = element;
    while (currentElement.parentNode) {
        currentElement = currentElement.parentNode;
        if (currentElement.id && currentElement.id.startsWith("beep-")) {
            return currentElement;
        }
    }
    return null;
}