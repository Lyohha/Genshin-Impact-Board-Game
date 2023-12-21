let GameInterfaceQueue = {
    list: [],
    active: false,
    add: function(func, data) {
        GameInterfaceQueue.list.push({func: func, data: data});
        if(!GameInterfaceQueue.active) {
            GameInterfaceQueue.active = true;
            GameInterfaceQueue.next();
        }
    },
    next: function() {
        if(GameInterfaceQueue.list.length == 0) {
            GameInterfaceQueue.active = false;
            return;
        }

        let item = GameInterfaceQueue.list.splice(0, 1)[0];

        item.func(item.data);
    },
};

window.GameInterfaceQueue = GameInterfaceQueue;