
    function clickPost(event) {
    if (window.getSelection().toString().length > 0) {
    return;
}
    if(event.target.classList.contains("skipClickPost")) {
    return;
}
    console.log("Hello World!")
}