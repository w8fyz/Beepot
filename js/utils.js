let parameters = location.href.split("?");
if(parameters.length >= 2 && parameters[1].includes("status=")) {
    history.pushState(null, "", location.href.split("?")[0]);
}