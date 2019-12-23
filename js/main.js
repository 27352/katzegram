var host = '0.0.0.0:3000/';
var spnr = document.createElement('img');
spnr.src = "icon/spinner.gif";
spnr.height = 35;

var HttpRequest = (function () {
    function HttpRequest() {}

    HttpRequest.GET = function (options) {
        var xhr = new XMLHttpRequest();
        var url = HttpRequest.makeUrl(options.ssl, host + options.url + '?' + options.data);
        var async = true;

        xhr.open('GET', url, async);
        xhr.onload = function () {
            options.callback({
                xhr: xhr,
                status: xhr.status,
                text: xhr.responseText
            });
        };

        xhr.send();
    };

    HttpRequest.makeUrl = function (ssl, location) {
        return (ssl ? 'https:' : 'http:') + '//' + location;
    };

    return HttpRequest;
}());

var makeGetRequest = function (url, data, callback) {
    HttpRequest.GET({
        url: url,
        data: data,
        ssl: false,
        callback: callback
    });
};

var buildOnClick = function (name, params) {
    return 'onclick=' + name + '(' + params.join(',') + ')';
};

var buildLikesNodeId = function(post_id) {
    return 'likes-' + post_id;
};

var buildQueryString = function(data) {
    var qs = [];

    for (var i in data) {
        qs.push(
            i + '=' + data[i].replace(/\n/gm, ' ').replace(/^\s+|\s+$/, '')
        );
    }

    return qs.join('&');
};

var displayPosts = function (items) {
    var html = '';

    for (var i = items.length; i--;) {
        var item = items[i];

        html += getCardView(item);
    }

    document.getElementById('posts').innerHTML = html;
};

var displaySinglePost = function(item) {
    document.getElementById('posts').innerHTML = getCardView(item, true);
};

var displayUsers = function (items) {
    var html = '<table id="usersInfo" align="center" cellspacing=0>'
             + '<tr><th>Name</th><th>Username</th><th>Posts</th><th>Bio</th></tr>'
    var cell = function (value) {
        return '<td>' + value + '</td>';
    };

    for (var i = items.length; i--;) {
        var item = items[i];
        var altr = i % 2 === 0 ? 'class="altRow"' : '';
        html += '<tr ' + altr + '>'
             +  cell(item.fullname.replace(/\s/, '&nbsp;'))
             +  cell(item.username)
             +  cell(item.post_count)
             +  cell(item.description)
             +  '</tr>';
    }
    html += '</table>';

    document.getElementById('users').innerHTML = html;
};

var getCardView = function (item, displayHeader) {
    var like = buildOnClick('doLike', [item.post_id]);
    var cmnt = buildOnClick('doComment', [item.post_id]);
    var view = buildOnClick('doView', [item.post_id]);
    var ptid = 'id=' + buildLikesNodeId(item.post_id);
    var date = new Date(item.datetime);
    var info = 'posted by <a href="#">' + item.fullname + '</a> on ' + date.toDateString();
    var hder = displayHeader ? 
                  '<div class="card-header">'
                +     '<span><img class="icon-left" src="./icon/person_pin-24px.svg"></span>'
                +     '<span class="card-title">' + item.fullname + '</span>'
                + '</div>' : '';

    return      '<div class="card-item">' + hder
             +      '<div class="card-image">'
             +          '<img ' + view + ' src="' + item.image_url + '"></img>'
             +      '</div>'
             +      '<div class="card-text">' + item.description + '</div>'
             +      '<div class="card-footer">'
             +          '<span ' + ptid + '>' + item.likes + '</span>' 
             +          '<span ' + like + '  class="likes">&nbsp;<a href="javascript:">likes</a>&nbsp;-&nbsp;</span>'
             +          '<span class="info">' + info + '</span>'
            //  +          '<span class="likeBtn">'
            //  +          '<span ' + like + '><img src="./icon/star_border-24px.svg"></img></span>'
            //  +          '<span ' + cmnt + '><img src="./icon/mode_comment-24px.svg"></img></span>'
            //  +          '</span>'
             +      '</div>'
             +  '</div>'
             +  '<div class="spacer-vertical"></div>';
};

var doLike = function (post_id) {
    var ptid = buildLikesNodeId(post_id);
    var data = 'post_id=' + post_id;
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
};

var doComment = function (post_id) {
    alert(post_id);
};

var doView = function (post_id) {
    location.replace('view.php?post_id=' + post_id);
};

var doSignUp = function () {
    var form = document.forms['signUp'];
    var data = buildQueryString({
        fullname: form.name.value,
        username: form.username.value,
        description: form.bio.value
    });

    makeGetRequest('includes/db_insert_user.php', data, function(response) {
        if (response.text === 'error') {
            return;
        }

        var json = JSON.parse(response.text);
        if (json.msg !== 'success') {
            alert(json.msg);
            return;            
        }

        location.replace('users.php?');
    });
};

var displayAddUserForm = function () {
    var node = document.getElementById('addUserForm');
    node.style.visibility = 'visible';
};
