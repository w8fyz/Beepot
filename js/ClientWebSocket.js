const newAuthors = [];

try {
    var conn = new WebSocket("ws://fyz.dynamic-dns.net/ws/beeps");
    conn.onopen = function(e) {
    console.log("Connexion établie");
};

conn.onmessage = function(e) {
    console.log(e.data );
};

conn.onerror = function (error) {
    console.log('WebSocket Error: ' + error.type);
};
}catch (ex) {
    console.log('Error :'+ex);
}
function postMessage(id) {
   conn.send("NEW AUTHOR : "+id);
   newAuthors.push(id);
   if(newAuthors.length > 5) {
       popupNewTweet(newAuthors.length);
   }
}

function popupNewTweet(length) {
    const element = document.getElementById("popup");
    element.style.display = "block";
    element.style.top = "0px";
}
