var STORE = window.STORE || [];
var PARAM_GET = window._GET || [];
var PARAM_POST = window._POST || [];
var SETTINGS = window.SETTINGS || {};


let $db = new DB();
let $api = new API();
let $user = new User();
let $orders = new Orders();

$api.get();
$user.init();
$orders.init();


function ok(msg) {
    return {
        'status': true,
        'data': msg,
    }
}

function err(msg) {
    return {
        'status': false,
        'data': msg,
    }
}

function showMessage(type, msg) {
    $('.alerts').append('<div class="alert-' + type + '">' + msg + '<div>');
    setTimeout(function () {
        $('.alerts').empty();
    }, 3000)
}

function API() {
    this.get = async () => {
        let response = await fetch('/api.php?api=all');
        if (response.ok) {
            let json = await response.json();
            window.STORE = json;
            STORE = json;
            updateElements();
        }
    };

    this.update = async (done) => {
        var formData = new FormData();
        formData.append('api', 'update');
        formData.append('data', JSON.stringify(STORE));

        let response = await fetch('/api.php', {
            method: 'POST',
            body: formData
        });
        if (response.ok) {
            let json = await response.json();
            done(json);
        }
    };
}

function DB() {
    this.getByField = (tableName, key, value) => {
        let result = false;

        $.map(STORE[tableName], function (row, i) {
            if (row[key] === value) {
                result = row;
            }
        });
        return result;
    }
}

function User() {

    let tableName = 'users';

    this.add = (arParams = {}, done) => {
        if (this.getByField('login', arParams['login'])) {
            done(err('Пользователь существует'));
            return;
        }
        arParams['created_at'] = 1;
        STORE[tableName].push(arParams);
        STORE['user'] = arParams['login'];

        $api.update(function (resp) {
            $api.get();
            done(ok('Пользователь добавлен'));
        });

    };

    this.login = (login, done) => {
        STORE['user'] = login;

        $api.update(function (resp) {
            $api.get();
            done(ok('Успешный вход в личный кабинет'));
        });
    };

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    };

    this.init = () => {
        this.submitLogin()
        this.submitRegister()
        this.submitExit()
    }

    this.submitLogin = () => {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            let data = getInputs(this);

            let user = $user.getByField('login', data['login']);
            if (user['password'] === data['password']) {
                $user.login(data['login'], function () {
                    location.href = '/';
                });
                return false;
            }

            showMessage('danger', 'Неправильный логин или пароль');

            return false;
        });
    }

    this.submitRegister = () => {
        $('#registerForm').on('submit', function (e) {
            e.preventDefault();

            let data = getInputs(this);

            $user.add(data, function (result) {
                let type = (result['status']) ? 'success' : 'danger';
                showMessage(type, result['data']);
                if (result['status']) {
                    location.href = '/';
                }
            });

            return false;
        });

    }

    this.submitExit = () => {
        $('.action-exit').on('click', function (e) {
            $user.login('', function () {
                location.href = '/login.php';
            });
            return false;
        });

    }
}

function Orders() {

    let tableName = 'orders';

    this.add = (arParams = {}, done) => {
        arParams['created_at'] = 1;
        STORE[tableName].push(arParams);

        $api.update(function (resp) {
            $api.get();
            done(ok('Заказ добавлен'));
        });

    };

    this.getByField = (key, value) => {
        return $db.getByField(tableName, key, value);
    };

    this.getAll = (arParams = {}) => {
        return STORE[tableName];
    };

    this.init = () => {
        this.submitForm();
    };

    this.submitForm = () => {
        $('#orderForm').on('submit', function(e) {
            e.preventDefault();

            let data = getInputs(this);

            $orders.add(data, function (result) {
                debugger
                let type = (result['status']) ? 'success' : 'danger';
                showMessage(type, result['data']);
            });

            return false;
        })
    };

    this.renderAll = () => {

    }

}


/*
* Forms
* */
function getInputs(context) {
    let data = {};
    $(context).find('input[name], select[name]').each(function () {
        data[$(this).attr('name')] = $(this).val();
    });
    return data;
}

function updateElements() {


    checkRights();
}

function checkRights() {
    if (!STORE.hasOwnProperty('user')) {
        return false;
    }
    let login = STORE['user'];
    let user = $user.getByField('login', login);
    let group_id = user['group_id'];

    if (group_id === SETTINGS.GROUPS.ADMIN) {


    } else if (group_id === SETTINGS.GROUPS.DRIVER) {


    } else {

    }

    return true;
}