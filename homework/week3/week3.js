function loadSubmit() {
    // alert("ajax!");
    $.ajax({
        // cache: true,
        type: "POST",
        url: '../../../cgi-bin/collect.pl',
        data:$('#Form1').serialize(),
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            // alert(data);
            var datastr = String(data);
            var start = datastr.search(/<title>/i);
            var end = datastr.search(/<\/title>/i);
            datastr = datastr.substring(start+7, end);
            // alert(datastr);
            if (datastr == "Sorry")
                alert("Please finish the form!");
            else
                alert("Thanks for participating in our survey!");
            // $("#Form1").parent.html(data);
        }
    });
}

function loadResult() {
    // alert("ajax!");
    $.ajax({
        // cache: true,
        type: "POST",
        url: '../../../cgi-bin/list.pl',
        data:$('#Form1').serialize(),
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            // alert(data);
            var datastr = String(data);
            var start = datastr.search(/<h2>/i);
            var end = datastr.search(/<\/table>/i);
            datastr = datastr.substring(start, end+8);
            datastr += "</form><button class=\"btn btn-default\" id=\"ajaxdelete\" onclick=\"loadDelete()\">Delete</button><span>       </span><button class=\"btn btn-default\" id=\"ajaxreload\" onclick=\"loadQuestion()\">Back</button><br/><br/>";
            // alert(datastr);
            document.getElementById('container').innerHTML = datastr;
        }
    });
}

function loadDelete() {
    // alert("ajax!");
    $.ajax({
        // cache: true,
        type: "POST",
        url: '../../../cgi-bin/delete.pl',
        data:$('#Form1').serialize(),
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            // alert(data);
            var datastr = String(data);
            var start = datastr.search(/<title>/i);
            var end = datastr.search(/<\/title>/i);
            datastr = datastr.substring(start+7, end);
            // alert(datastr);
            if (datastr == "Sorry")
                alert("No changes!");
            else
                alert("Data deleted!");
            loadResult();
        }
    });
}

function loadQuestion() {
var questionare =
    "<form id=\"Form1\" action=\"../../../cgi-bin/collect.pl\" method=\"post\">"+
        "<h1>Questionare</h1>"+
        "<div class=\"form-group\">"+
            "<label for=\"inputName\">Name</label>"+
            "<input type=\"text\" class=\"form-control\" id=\"inputName\" name=\"inputName\" placeholder=\"Enter name\" required=\"required\">"+
        "</div>"+
        "<div class=\"form-group\">"+
            "<label for=\"inputAge\">Age</label>"+
            "<input type=\"text\" class=\"form-control\" id=\"inputAge\" name=\"inputAge\" placeholder=\"Enter age\" required=\"required\">"+
        "</div>"+
        "<div class=\"form-group\">"+
            "<label for=\"inputGender\">Gender</label>"+
            "<select class=\"form-control\" id=\"inputGender\" name=\"inputGender\">"+
                "<option value=\"male\">Male</option>"+
                "<option value=\"female\">Female</option>"+
            "</select>"+
        "</div>"+
        "<div class=\"form-group\">"+
            "<label for=\"inputEmail\">Email address</label>"+
            "<input type=\"text\" class=\"form-control\" id=\"inputEmail\" name=\"inputEmail\" placeholder=\"Enter email\" required=\"required\">"+
        "</div>"+
        "<br/>"+
        "<div class=\"form-group\">"+
            "<input type = \"submit\"  value = \"Submit\" />"+
            "<input type = \"reset\"  value = \"Clear Form\" />"+
        "</div>"+
    "</form>"+
    "<h4><a href=\"../../../cgi-bin/list.pl\">View results</a></h4>"+
    "<br/>"+
    "<div>"+
        "<label><strong>AJAX Version</strong></label>"+
        "<button class=\"btn btn-default\" id=\"ajaxsubmit\" onclick=\"loadSubmit()\">Submit</button>"+
        "<span>       </span>"+
        "<button class=\"btn btn-default\" id=\"ajaxresult\" onclick=\"loadResult()\">View results</button>"+
    "</div>"+
    "<br/>";

    document.getElementById('container').innerHTML = questionare;
}