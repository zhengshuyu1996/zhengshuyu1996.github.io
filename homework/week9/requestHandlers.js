var querystring = require("querystring"),
    fs = require("fs"),
    url = require("url"),
    util = require('util');

function start(response) {
    // console.log("Request handler 'index' was called.");
    response.writeHead(200,{"Content-Type":"text/html"});
    fs.readFile("questionare.html","utf-8",function(e,data){
        response.write(data);
        response.end();
    });
}

function cstyle(response) {
    response.writeHead(200,{"Content-Type":"text/css"});
    fs.readFile("style.css","utf-8",function(e,data){
        response.write(data);
        response.end();
    });
}

function cbootstramp(response) {
    response.writeHead(200,{"Content-Type":"text/css"});
    fs.readFile("../../css/bootstrap.css","utf-8",function(e,data){
        response.write(data);
        response.end();
    });
}

function jquery(response) {
    response.writeHead(200,{"Content-Type":"application/x-javascript"});
    fs.readFile("../../js/jquery.js","utf-8",function(e,data){
        response.write(data);
        response.end();
    });
}

function jbootstramp(response) {
    response.writeHead(200,{"Content-Type":"application/x-javascript"});
    fs.readFile("../../js/bootstrap.js","utf-8",function(e,data){
        response.write(data);
        response.end();
    });
}

function mainjs(response) {
    response.writeHead(200,{"Content-Type":"application/x-javascript"});
    fs.readFile("main.js","utf-8",function(e,data){
        response.write(data);
        response.end();
    });
}

function cloud(response) {
    response.writeHead(200,{"Content-Type":"application/x-png"});
    fs.readFile("../../img/yunwen1.png","binary",function(e,data){
        response.write(data,"binary");
        response.end();
    });
}

function leftpic(response) {
    response.writeHead(200,{"Content-Type":"image/jpeg"});
    fs.readFile("../../img/IMG30.jpeg","binary",function(e,data){
        response.write(data,"binary");
        response.end();
    });
}

function rightpic(response) {
    response.writeHead(200,{"Content-Type":"image/jpeg"});
    fs.readFile("../../img/IMG31.jpeg","binary",function(e,data){
        response.write(data,"binary");
        response.end();
    });
}

function backgroundpic(response) {
    response.writeHead(200,{"Content-Type":"image/jpeg"});
    fs.readFile("../../img/background.jpg","binary",function(e,data){
        response.write(data,"binary");
        response.end();
    });
}

function upload(response, request) {
    // console.log("Request handler 'upload' was called.");

    var post = '';

    request.on('data', function(chunk){
        post += chunk;
    });

    request.on('end', function(){
        post = querystring.parse(post);
        var info = JSON.parse(JSON.stringify(post));

        fs.readFile("data.json","utf-8",function(e,data){
            var dist = JSON.parse(data);
            dist["info"].push(info);
            fs.writeFile("data.json",JSON.stringify(dist, null, 2),function (err) {
                // if (err) throw err;
                console.log("File Saved!");
            });
        });
        // console.log(util.inspect(post));
        // console.log(JSON.stringify(post, null, 2));

    });

    response.writeHead(200,{"Content-Type":"text/plain; charset=utf-8"});
    response.write("ok");
    response.end();
}

function show(response) {
    // console.log("Request handler 'show' was called.");
    fs.readFile("data.json", "utf-8", function(error, file) {
        if(error) {
            response.writeHead(500, {"Content-Type": "text/plain"});
            response.write(error + "\n");
            response.end();
        } else {
            response.writeHead(200, {"Content-Type": "application/json"});
            response.write(file);
            response.end();
        }
    });
}

function Delete(response, request) {
    // console.log("Request handler 'delete' was called.");

    var post = '';

    request.on('data', function(chunk){
        post += chunk;
    });

    request.on('end', function(){
        post = querystring.parse(post);
        var ids = post["ids"];
        var count = ids.length;

        fs.readFile("data.json","utf-8",function(e,data){
            var dist = JSON.parse(data);
            for (var i = 0; i < count; i++) {
                if (i >= dist["info"].length)
                    break;
                dist["info"].splice(ids[i], 1);
            }
            fs.writeFile("data.json",JSON.stringify(dist, null, 2),function (err) {
                // if (err) throw err;
                console.log("File Saved!");
            });
        });

    });

    response.writeHead(200,{"Content-Type":"text/plain; charset=utf-8"});
    response.write("ok");
    response.end();
}

exports.start = start;
exports.cstyle = cstyle;
exports.cbootstramp = cbootstramp;
exports.jquery = jquery;
exports.jbootstramp = jbootstramp;
exports.mainjs = mainjs;
exports.cloud = cloud;
exports.leftpic = leftpic;
exports.rightpic = rightpic;
exports.backgroundpic = backgroundpic;
exports.upload = upload;
exports.show = show;
exports.Delete = Delete;