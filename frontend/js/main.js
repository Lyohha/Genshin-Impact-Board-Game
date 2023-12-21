$(document).ready(function() {
    console.log('asd');
    var characters = {
        "furina": {
            "name": "Фурина",
            "element": "Hydro"
        },
        "charlotte": {
            "name": "Шарлотта",
            "element": "Cryo"
        },
        "wriothesley": {
            "name": "Ризли",
            "element": "Cryo"
        },
        "neuvillet": {
            "name": "Нёвиллет",
            "element": "Hydro"
        },
        "kamisato-ayato": {
            "name": "Аято",
            "element": "Hydro"
        },
        "sin-cyu": {
            "name": "Син Цю",
            "element": "Hydro"
        },
        "bennet": {
            "name": "Беннет",
            "element": "Pyro"
        },
        "linney": {
            "name": "Лини",
            "element": "Pyro"
        },
        "lynette": {
            "name": "Линетт",
            "element": "Anemo"
        },
        "fremine": {
            "name": "Фремине",
            "element": "Cryo"
        },
        "syan-lin": {
            "name": "Сян Лин",
            "element": "Pyro"
        },
        "nahida": {
            "name": "Нахида",
            "element": "Dendro"
        },
        "kamisato-ayaka": {
            "name": "Аяка",
            "element": "Cryo"
        },
        "keja": {
            "name": "Кэйа",
            "element": "Cryo"
        },
        "hu-tao": {
            "name": "Ху Тао",
            "element": "Pyro"
        },
        "keh-cin": {
            "name": "Кэ Цин",
            "element": "Electro"
        },
        "dilyuk": {
            "name": "Дилюк",
            "element": "Pyro"
        },
        "rozariya": {
            "name": "Розария",
            "element": "Cryo"
        },
        "kazuha": {
            "name": "Кадзуха",
            "element": "Anemo"
        },
        "toma": {
            "name": "Тома",
            "element": "Pyro"
        },
        "saharoza": {
            "name": "Сахароза",
            "element": "Anemo"
        },
        "baizhu": {
            "name": "Бай Чжу",
            "element": "Dendro"
        },
        "kirara": {
            "name": "Кирара",
            "element": "Dendro"
        },
        "yaoyao": {
            "name": "Яо Яо",
            "element": "Dendro"
        },
        "kaveh": {
            "name": "Кавех",
            "element": "Dendro"
        },
        "barbara": {
            "name": "Барбара",
            "element": "Hydro"
        },
        "noehll": {
            "name": "Ноэлль",
            "element": "Geo"
        },
        "diona": {
            "name": "Диона",
            "element": "Cryo"
        },
        "yanfehj": {
            "name": "Янь Фэй",
            "element": "Pyro"
        },
        "liza": {
            "name": "Лиза",
            "element": "Electro"
        },
        "yelan": {
            "name": "Е Лань",
            "element": "Hydro"
        },
        "kli": {
            "name": "Кли",
            "element": "Pyro"
        },
        "dehya": {
            "name": "Дэхья",
            "element": "Pyro"
        },
        "faruzan": {
            "name": "Фарузан",
            "element": "Anemo"
        },
        "nilu": {
            "name": "Нилу",
            "element": "Hydro"
        },
        "dori": {
            "name": "Дори",
            "element": "Electro"
        },
        "sayu": {
            "name": "Саю",
            "element": "Anemo"
        },
        "kuki-sinobu": {
            "name": "Куки Синобу",
            "element": "Electro"
        },
        "kandakia": {
            "name": "Кандакия",
            "element": "Hydro"
        },
        "kokomi": {
            "name": "Кокоми",
            "element": "Hydro"
        },
        "amber": {
            "name": "Эмбер",
            "element": "Pyro"
        },
        "chun-yun": {
            "name": "Чун Юнь",
            "element": "Cryo"
        },
        "shenh-he": {
            "name": "Шэнь Хэ",
            "element": "Cryo"
        },
        "sin-yan": {
            "name": "Синь Янь",
            "element": "Pyro"
        },
        "venti": {
            "name": "Венти",
            "element": "Anemo"
        },
        "nin-guan": {
            "name": "Нин Гуан",
            "element": "Geo"
        },
        "gan-yuj": {
            "name": "Гань Юй",
            "element": "Cryo"
        },
        "albedo": {
            "name": "Альбедо",
            "element": "Geo"
        },
        "mona": {
            "name": "Мона",
            "element": "Hydro"
        },
        "chzhun-li": {
            "name": "Чжун Ли",
            "element": "Geo"
        },
        "kollei": {
            "name": "Коллеи",
            "element": "Dendro"
        },
        "tartalya": {
            "name": "Тарталья",
            "element": "Hydro"
        },
        "tignari": {
            "name": "Тигнари",
            "element": "Dendro"
        },
        "cyno": {
            "name": "Сайно",
            "element": "Electro"
        },
        "yae-miko": {
            "name": "Яэ Мико",
            "element": "Electro"
        },
        "ci-ci": {
            "name": "Ци Ци",
            "element": "Cryo"
        },
        "mika": {
            "name": "Мика",
            "element": "Cryo"
        },
        "syao": {
            "name": "Сяо",
            "element": "Anemo"
        },
        "dzhinn": {
            "name": "Джинн",
            "element": "Anemo"
        },
        "strannik": {
            "name": "Странник",
            "element": "Anemo"
        },
        "behj-dou": {
            "name": "Бэй Доу",
            "element": "Electro"
        },
        "rehjzor": {
            "name": "Рэйзор",
            "element": "Electro"
        },
        "fishl": {
            "name": "Фишль",
            "element": "Electro"
        },
        "syogun-rajdehn": {
            "name": "Сёгун Райдэн",
            "element": "Electro"
        },
        "yoimiya": {
            "name": "Ёимия",
            "element": "Pyro"
        },
        "ehola": {
            "name": "Эола",
            "element": "Cryo"
        },
        "sara-kudzyo": {
            "name": "Кудзё Сара",
            "element": "Electro"
        },
        "sikanoin-hehjdzo": {
            "name": "Хэйдзо",
            "element": "Anemo"
        },
        "al-haitam": {
            "name": "Аль-Хайтам",
            "element": "Dendro"
        },
        "layla": {
            "name": "Лайла",
            "element": "Cryo"
        },
        "arataki-itto": {
            "name": "Аратаки Итто",
            "element": "Geo"
        },
        "goro": {
            "name": "Горо",
            "element": "Geo"
        },
        "yun-czin": {
            "name": "Юнь Цзинь",
            "element": "Geo"
        }
    };

    var settings = {
        name: 'Player',
        id: false,
        character: 'furina',
        load: function() {
            let name = localStorage.getItem('name');
            let id = localStorage.getItem('id');
            let character = localStorage.getItem('character');

            if(name != null)
                settings.name = name;
            if(character != null)
                settings.character = character;
            if(id != null)
                settings.id = id;
        },
        save: function() {
            localStorage.setItem('name', settings.name);
            localStorage.setItem('character', settings.character);
            if(settings.id != false)
                localStorage.setItem('id', settings.id);
        },
    }

    settings.load();

    function applySettings() {
        let $authForm = $('.auth-login-container');
        $authForm.find('input').val(settings.name);

        $('.auth-character[js-auth-char="' + settings.character + '"]').addClass('active');
    }

    function onAuthCharacterClick(event) {
        event.preventDefault();

        let $this = $(this);
        settings.character = $this.attr('js-auth-char');

        $('.auth-character').removeClass('active');
        $this.addClass('active');
        settings.save();
    }

    let $authCharactersContainer = $(".auth-characters");

    for(let key in characters) {

        if(characters[key].element == null)
            continue;

        let $authChar = $(`
            <div class="auth-character" js-auth-char="${key}">
                <div class="auth-character-element">
                    <img class="" src="images/elements/${characters[key].element}.svg" draggable="false"/>
                </div>
                <div class="auth-character-image">
                    <img class="" src="images/characters/${key}.webp" draggable="false" alt="${characters[key].name}"/>
                </div>
                <div class="auth-character-name">${characters[key].name}</div>
            </div>
        `);

        $authChar.on('click', onAuthCharacterClick);

        $authCharactersContainer.append($authChar);
    }

    applySettings();

    var Game = {
        roomID: false,
        players: [],
        markers: [],
        pieces: {},
        positions: {},
    }


    function onRoomEnter() {
        $('[js-popup="rooms"]').addClass('none');
    }

    $(".rooms-add button").on('click', function(event) {
        event.preventDefault();

        window.GameWebSocket.send({
            request: 'rooms/create',
        }, function(data) {
            if(data.result != 'ok')
                return;
            Game.roomID = data.id;
            onRoomEnter();
        });
    });

    $('.auth-login-container').on('submit', function(event) {
        event.preventDefault();

        let $form = $(this);
        let $name = $form.find('[name="name"]');
        let name = $name.val().trim();

        $name.removeClass('error');

        if(name.length == 0) {
            $name.addClass('error');
            return;
        }

        settings.name = name;
        settings.save();

        let onAuthReady = function() {
            window.GameWebSocket.send({
                request: 'set_character',
                character: settings.character,
            }, function(data) {
                $('[js-popup="auth"]').addClass('none');
                $('[js-popup="rooms"]').removeClass('none');
    
                // получить список комнат
                window.GameWebSocket.send({
                    request: 'rooms',
                }, function(data) {
                    if(data.list == null)
                        return;
    
                    let $roomsList = $('.rooms-list');
    
                    for(let key in data.list) {
                        let room = data.list[key];
                        let $room = $(`
                            <div class="rooms-item" js-id="${room.id}">
                                ${room.name}
                            </div>
                        `);
    
                        $roomsList.append($room);
    
                        // при клике на комнату
                        $room.on('click', function(event) {
                            event.preventDefault();
    
                            let id = $(this).attr('js-id');
    
                            window.GameWebSocket.send({
                                request: 'rooms/enter',
                                id: id,
                            }, function(data) {
                                //TODO on room enter
                                if(data.result != 'ok')
                                    return;
    
                                Game.roomID = id;
                                onRoomEnter();
                            });
                        })
                    }
                });
            });
        }

        // подключиться, на успешное подключение выполнить функцию
        window.GameWebSocket.connect(function() {
            window.GameWebSocket.send({
                request: 'set_name',
                name: settings.name,
            }, function(data) {
                console.log('on set name');
                if(settings.id == false) {
                    window.GameWebSocket.send({
                        request: 'get_id',
                    }, function(data) {
                        settings.id = data.id;
                        settings.save();
                        onAuthReady();
                    });
                    return;
                }
                window.GameWebSocket.send({
                    request: 'set_id',
                    id: settings.id,
                }, function(data) {
                    onAuthReady();
                });
            });
        });
    });


    window.GameWebSocket.subscribe('room/players', function(data) {
        let $characters = $('.characters');
        $characters.html('');

        if(data.players == null)
            return;

        Game.players = data.players;

        for(let player in data.players) {
            player = data.players[player];

            let $player = $(`
                <div class="characters_item" js-player-id="${player.id}">
                    <div class="characters_name">${player.name}</div>
                    <img class="characters_image" src="images/characters/${player.character}.webp" draggable="false"/>
                </div>
            `);

            $characters.append($player);
        }
    });

    window.GameWebSocket.subscribe('room/markers', function(data) {

        Game.markers = data.markers;

        var $map = $('#map');

        $('.map_point').remove();

        for(let key in Game.markers) {

            let marker = Game.markers[key];
    
            let $marker = $(`
                <div class="map_point n${key} ${marker.type}">
                    <div class="map_point-content">
                        <div class="map_point-number">${key}</div>
                    </div>
                </div>
            `);
    
            $marker.css('left', marker.x + 'px');
            $marker.css('top', marker.y + 'px');
    
            $map.append($marker);
    
            index = parseInt(key);
        }
    });

    window.GameWebSocket.subscribe('room/positions', function(data) {

        if(data.positions == null)
            return;

        var $map = $('#map');

        for(let key in data.positions) {
            let pos = data.positions[key];

            if(Game.pieces[pos.id] == null) {
                let char = null;
                let name = null;

                for(let player in Game.players) {
                    player = Game.players[player];
                    if(player.id == pos.id) {
                        char = player.character;
                        name = player.name;
                        break;
                    }
                }

                if(char == null)
                    continue;

                let $char = $(`
                    <div class="map_char ${characters[char].element.toLowerCase()}" js-id="${pos.id}">
                        <img src="images/characters/${char}.webp" alt="${name}"/>
                    </div>
                `);

                Game.pieces[pos.id] = $char;

                $map.append($char);
            }

            Game.positions[pos.id] = pos.position;

            let x = Game.markers[pos.position].x - 10 + Math.floor(Math.random() * 50);
            let y = Game.markers[pos.position].y - 10 + Math.floor(Math.random() * 50);

            Game.pieces[pos.id].css('left', x + 'px');
            Game.pieces[pos.id].css('top', y + 'px');
        }
    });

    window.GameWebSocket.subscribe('room/active', function(data) {

        if(data.id == null)
            return;

        $('.skills_cube').addClass('none');

        window.GameInterfaceQueue.add(function(d) {
            $('[js-player-id]').removeClass('active');
            $('[js-player-id="' + d.id + '"]').addClass('active');
    
            if(d.id == settings.id)
                $('.skills_cube').removeClass('none');
            window.GameInterfaceQueue.next();
        }, data);
    });

    // подписка информацию от сервере о ходе игрока
    window.GameWebSocket.subscribe('room/move', function(data) {

        if(data.id == null || data.position == null)
            return;

        let fn = function(d) {
            let x = Game.markers[d.position].x - 10 + Math.floor(Math.random() * 50);
            let y = Game.markers[d.position].y - 10 + Math.floor(Math.random() * 50);
            
            Game.pieces[d.id].animate({
                left: x + 'px',
                top: y + 'px',
            }, 1000, function() {
                window.GameInterfaceQueue.next();
            });
        }

        if(Game.positions[data.id] < data.position) {
            Game.positions[data.id]++;
            do
            {
                window.GameInterfaceQueue.add(fn, {
                    id: data.id,
                    position: Game.positions[data.id],
                });

                if(Game.positions[data.id] == data.position) 
                    break;

                Game.positions[data.id]++;
            } while(true);
        } 
        if(Game.positions[data.id] > data.position) {
            Game.positions[data.id]--;
            do
            {
                window.GameInterfaceQueue.add(fn, {
                    id: data.id,
                    position: Game.positions[data.id],
                });

                if(Game.positions[data.id] == data.position) 
                    break;

                Game.positions[data.id]--;
            } while(true);
        }
        
    });

    function showNotify(d) {
        if(d.text == null || d.type == null)
            return;

        let $notifys = $('.notifys');

        let $notify = $(`
            <div class="notify ${d.type}">${d.text}</div>
        `);

        $notifys.append($notify);

        $notify.animate({
            width: '80%',
        }, 100, function() {
            if(d.next)
                window.GameInterfaceQueue.next();

            setTimeout(function() {
                $notify.animate({
                    width: '0%',
                }, 100, function() {
                    setTimeout(function() {
                        $notify.remove();
                    }, 100);
                });
            }, 2000);
        });

        
    }

    // подписка на сообщение
    window.GameWebSocket.subscribe('msg', function(data) {

        showNotify(data);
    });

    // подписка на сообщение
    window.GameWebSocket.subscribe('msg/delayed', function(data) {

        data.next = true;

        window.GameInterfaceQueue.add(showNotify, data);

    });

    // сделать ход по кнопке
    $('[js-move]').on('click', function(event) {
        event.preventDefault();

        window.GameWebSocket.send({
            request: 'room/move',
        }, function(data) {
            
        });
    });
});