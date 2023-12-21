let GameWebSocket = {
    socket: null,
    resultFunctions: {},
    serverSubscribeFunctions: {}, 
    generateNonce: function() {
        do {
            let rand = Math.floor(Math.random() * 100000000);
            rand = rand.toString();
            if(GameWebSocket.resultFunctions[rand] == null)
                return rand;
        }
        while(true);
    },
    recieveMessage: function(event) {
        var response = JSON.parse(event.data);
        if(response.nonce == null) {
            if(response.request != null) {
                if(GameWebSocket.serverSubscribeFunctions[response.request] != null)
                    GameWebSocket.serverSubscribeFunctions[response.request](response);
            }
            return;
        }
        if(GameWebSocket.resultFunctions[response.nonce] != null)
            GameWebSocket.resultFunctions[response.nonce](response);
        // GameWebSocket.resultFunctions[response.nonce] = null;
        delete  GameWebSocket.resultFunctions[response.nonce];
        
    },
    sendData: function(message) {
        GameWebSocket.socket.send(JSON.stringify(message));
    },
    send: function(data, resultFunction = null) {
        let nonce = GameWebSocket.generateNonce();
        if(resultFunction != null)
            GameWebSocket.resultFunctions[nonce] = resultFunction;


        data.nonce = nonce;
        GameWebSocket.sendData(data);
    },
    subscribe: function(event, eventFunction) {
        GameWebSocket.serverSubscribeFunctions[event] = eventFunction;
    },
    connect: function(onSuccessFunction) {
        while(true) {
            GameWebSocket.socket = new WebSocket('ws://genshin.ldev.pp.ua:8190');
            GameWebSocket.socket.onerror = function(error) {
                console.log(error);
                GameWebSocket.socket.close();
                // setTimeout(() => { GameWebSocket.connect(onSuccessFunction); }, 2000);
                return;
            }
            GameWebSocket.socket.onmessage = function(event) {
                GameWebSocket.recieveMessage(event);
            };
            GameWebSocket.socket.onopen = function() {
                // Game.auth(data);
                onSuccessFunction();
            }
            return;
        }
    },
};

window.GameWebSocket = GameWebSocket;