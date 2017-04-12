function loadSubmit() {
    // alert("ajax!");
    $.ajax({
        // cache: true,
        type: "POST",
        url: "/upload",
        data:$('#Form1').serialize(),
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            // alert(datastr);
            if (data == "Sorry")
                alert("Please finish the form!");
            else {
                alert("Thanks for participating in our survey!");
                document.getElementById("Form1").reset(); 
            }
            // $("#Form1").parent.html(data);
        }
    });
}

function loadResult() {
    // alert("ajax!");
    $.ajax({
        // cache: true,
        type: "POST",
        url: "/show",
        data:$('#Form1').serialize(),
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            // alert(data);
            var str = '<h3>Results</h3><br/><form id="Form1" method="post"><table border="border" style="margin-left:auto; margin-right:auto; width: 80%;" class="table table-bordered table-hover"><tr><th>Name</th><th>Age</th><th>Gender</th><th>Email</th><th>Delete</th></tr>';
            var info = data.info;
            var count = info.length;
            for (var i = 0; i < count; i++) {
                // alert(info[i].inputName);
                str += '<tr><td>' + info[i].inputName + '</td><td>' + info[i].inputAge + '</td><td>' + info[i].inputGender + '</td><td>' + info[i].inputEmail + '</td><td><input type="checkbox" name="ids" value="' + i + '"/></td></tr>';
            }
            str += '</table></form><button class="btn btn-default" onclick="loadDelete()">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" onclick="loadQuestion()">Back</button><br/><br/>';
            document.getElementById('container').innerHTML = str;
        }
    });
}

function loadDelete() {
    // alert("ajax!");
    $.ajax({
        // cache: true,
        type: "POST",
        url: '/delete',
        data:$('#Form1').serialize(),
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            if (data == "Sorry")
                alert("No changes!");
            else
                alert("Data deleted!");
            loadResult();
        }
    });
    // loadResult();
}

function loadQuestion() {
var questionare =
    "<form id=\"Form1\" method=\"post\">"+
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
    "</form>"+
    "<div>"+
        "<button class=\"btn btn-default\" id=\"ajaxsubmit\" onclick=\"loadSubmit()\">Submit</button>"+
        "<span>       </span>"+
        "<button class=\"btn btn-default\" id=\"ajaxresult\" onclick=\"loadResult()\">View results</button>"+
    "</div>"+
    "<br/>";

    document.getElementById('container').innerHTML = questionare;
}