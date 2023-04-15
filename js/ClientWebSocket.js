try {
    var conn = new WebSocket("ws://fyz.dynamic-dns.net/ws/beeps");
    conn.onopen = function(e) {
};

conn.onmessage = function(eve) {
    checkNewBeepsPopup(eve.data)

};

conn.onerror = function (error) {
    console.log('WebSocket Error: ' + error.type);
};
}catch (ex) {
    console.log('Error :'+ex);
}