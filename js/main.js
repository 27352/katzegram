(function () {
    (document.createElement('img')).src = "icon/spinner.gif";
}());

function makeGetRequest (script, data, callback) {
    var url = (location.origin + '/' + script).replace(/#/, '') + '?' + buildQueryString(data);
    var xhr = new XMLHttpRequest();

    xhr.open('GET', url, true);
    xhr.onload = function () {
        callback({
            xhr: xhr,
            status: xhr.status,
            text: xhr.responseText
        });
    };

    xhr.send();
}

function buildQueryString (data) {
    var qs = [];

    for (var i in data) {
        qs.push(
            i + '=' + data[i].toString().replace(/\n/gm, ' ').replace(/^\s+|\s+$/, '')
        );
    }

    return qs.join('&');
}

function sendRequest(options) {
    makeGetRequest(options.script, options.data, function (response) {
        if (response.text === 'error') {
            alert('Oops! Something went awry! Be back in a jiffy... or not');
            return;
        }

        var json = JSON.parse(response.text);

        if (json.msg !== 'success') {
            alert(json.msg);

            return;
        }

        location.replace(options.location);
    });
}

function displayForm (id) {
    switch (id) {
        case 'loginForm':
            document.getElementById('signUpForm').style.visibility = 'collapse';
            break;

        case  'signUpForm':
            document.getElementById('loginForm').style.visibility = 'collapse';
            break;
    }

    document.getElementById(id).style.visibility = 'visible';
}

function doStartUp (action) {
    var form, node, data, dest, usrn;
    var flds = ['username', 'password'];

    switch (action) {
        case 'signup':
            form = document.getElementById('signUpForm');
            node = form.getElementsByTagName('input');
            dest = 'includes/db_insert_user.php';
            data = {
                fullname: node.fullname.value,
                username: node.username.value,
                password: node.password.value,
                photo_url: node.photo_url.value,
                description: form.getElementsByTagName('textarea').bio.value
            };

            flds.push('fullname');
            break;

        case 'login':
            form = document.getElementById('loginForm');
            node = form.getElementsByTagName('input');
            dest = 'includes/db_login_user.php';
            data = {
                username: node.username.value,
                password: node.password.value
            };
            break;
    }

    if (!hasRequiredInfo(data, flds)) {
        return;
    }

    usrn = data.username;

    // makeGetRequest(dest, data, function (response) {
    //     if (response.text === 'error') {
    //         alert('Oops! Something went awry! Be back in a jiffy... or not');
    //         return;
    //     }

    //     var json = JSON.parse(response.text);

    //     if (json.msg !== 'success') {
    //         alert(json.msg);

    //         return;
    //     }

    //     location.replace('profile.php?username=' + usrn);
    // });

    sendRequest({
        script: dest,
        data: data,
        location: 'profile.php?username=' + profile.username
    });
}

function hasRequiredInfo(data, keys) {
    var result = true;

    keys.forEach(function (key) {
        if (!data[key]) {
            alert(key + ' is required!');
            result = false;
        }
    });

    return result;
}

function doNewPost(user_id) {
    var form = document.forms["newPostForm"].elements;
    var data = {
        image_url: form.image_url.value,
        description: form.description.value,
        user_id: user_id
    };

    if (!hasRequiredInfo(data, ['image_url', 'description'])) {
        return;
    }

    sendRequest({
        script: 'includes/db_insert_post.php',
        data: data,
        location: 'profile.php?username=' + profile.username
    });
}

