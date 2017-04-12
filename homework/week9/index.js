var server = require("./server");
var router = require("./router");
var requestHandlers = require("./requestHandlers");

var handle = {}
handle["/"] = requestHandlers.start;
handle["/index"] = requestHandlers.start;
handle["/style.css"] = requestHandlers.cstyle;
handle["/bootstrap.css"] = requestHandlers.cbootstramp;
handle["/jquery.js"] = requestHandlers.jquery;
handle["/bootstrap.js"] = requestHandlers.jbootstramp;
handle["/js"] = requestHandlers.mainjs;
handle["/cloud"] = requestHandlers.cloud;
handle["/leftpic"] = requestHandlers.leftpic;
handle["/rightpic"] = requestHandlers.rightpic;
handle["/img/background.jpg"] = requestHandlers.backgroundpic;
handle["/upload"] = requestHandlers.upload;
handle["/show"] = requestHandlers.show;
handle["/delete"] = requestHandlers.Delete;

server.start(router.route, handle);