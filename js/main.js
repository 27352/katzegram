(function (w) {
    w.spinner = document.createElement('img');
    w.spinner.src = "icon/spinner.gif";
}(window));

function setCookie(data) {
    document.cookie = 'katze=' + JSON.stringify(data);
}

function readCookie() {
    var info = document.cookie.split('katze=');
    var data = {};

    if (info.length > 0) {
        data = JSON.parse(info[1]);
    }

    return data;
}

function go (destination) {
    var usr = readCookie();
    var url = '';

    switch (destination) {
        case 'profile':
            url = 'profile.php?username=' + usr.username;
            break;

        case 'feed':
            url = 'feed.php';
            break;
    }

    location.replace(url);
}

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

function buildOnClick (name, params) {
    return 'onclick=' + name + '(' + params.join(',') + ')';
};

function buildLikesNodeId (post_id) {
    return 'likes-' + post_id;
};

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

    sendRequest({
        script: dest,
        data: data,
        location: 'profile.php?start=1&username=' + usrn
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

function getCardView (item, unlink) {
    var like = buildOnClick('doLike', [item.post_id]);
    //var cmnt = buildOnClick('doComment', [item.post_id]);
    var view = !unlink ? buildOnClick('doView', [item.post_id]) : '';
    var ptid = 'id=' + buildLikesNodeId(item.post_id);
    var date = new Date(item.datetime);
    var info = 'posted by <a href="profile.php?username=' + item.username + '">' 
             + item.fullname + '</a> on ' + date.toDateString();

    return '<div class="card-item">'
            + '<div class="card-image">'
            + '<img ' + view + ' src="' + item.image_url + '"></img>'
            + '</div>'
            + '<div class="card-text">' + item.description + '</div>'
            + '<div class="card-footer">'
                + '<span ' + ptid + '>' + item.likes + '</span>'
                + '<span ' + like + '  class="likes">&nbsp;<a href="javascript:">likes</a>&nbsp;-&nbsp;</span>'
                + '<span class="info">' + info + '</span>'
            + '</div>'
        + '</div>'
        + '<div class="spacer-vertical"></div>';
}

function getCommentView(item) {
    return '<div class="card-comment">'
            + '<a href="profile.php?username=' + item.author_username + '">' + item.author_fullname + '</a>&nbsp;'
            + item.comment_text
         + '</div>'
         + '<div class="spacer-vertical"></div>';
}

function displayPosts (posts) {
    var node = document.getElementById('posts');
    var size = posts.length;
    var html = '';

    while (size--) {
        var item = posts[size];

        if (item.image_url.indexOf('http') > -1) {
            html += getCardView(item);
        }
    }

    node.innerHTML = html;

    // Logic to display addNewPost link only for the logged in user
    var link = document.getElementById('addNewPost');

    if (!link) {
        return;
    }

    var usrn = location.search.split('username=')[1].replace(/#/, '');
    var info = readCookie();

    if (info.username == usrn) {
        document.getElementById('addNewPost').style.visibility = 'visible';
    }
}

function displayPost (item) {
    var node = document.getElementById('posts');
    var html = '';

    html += getCardView(item, true);
    node.innerHTML = html;

    if (comments && comments.length > 0) {
        var node = document.getElementById('comments');
        var size = comments.length;
        var html = '';

        while (size--) {
            html += getCommentView(comments[size])
        }

        node.innerHTML = html;
    }
}

function doLike (post_id) {
    var ptid = buildLikesNodeId(post_id);
    var data = {post_id: post_id};
    var node = document.getElementById(ptid);

    node.innerHTML = '<img src="icon/spinner.gif" height=35 />';

    makeGetRequest('includes/db_update_like.php', data, function (response) {
        if (response.text === 'error') {
            return;
        }

        var json = JSON.parse(response.text);

        if (node) {
            node.innerHTML = json.likes;
        }
    });
}

function doView (post_id) {
    location.replace('view.php?post_id=' + post_id);
}
