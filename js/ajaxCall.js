function getTimeline(lastID) {
    var req =  createInstance();
    var url = document.ajax.url.value;
    var data = "url=" + url;
    req.onreadystatechange = function()
    {
        if(req.readyState == 4)
        {
            if(req.status == 200)
            {
                return req.responseText;
            }
            else
            {
                alert("Impossible de récupérer la timeline pour l'instant. Code : " + req.status + " " + req.statusText);
            }
        }
    };

    req.open("GET", "endpoint/getTimeline.php?lastID="+lastID, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(data);
}