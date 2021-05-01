//declaring array to store query from the database
var my_data = [];
var locker_nums = [];
var index = 1;

//define AJAX request for the result of getlockerinfo.php
var ajax_request = function (decrypt) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
			//echoed json information from php file is a response taken as input to callback function
            decrypt(req.responseText);
        }
    };
	//this is a synchronous GET request so this runs first
    req.open("GET", "getlockerinfo.php", false);
    req.send();
}

//response is parsed to become a JSON object and then stored into the my_data array
ajax_request(function(json_expr) {
	my_data = JSON.parse(json_expr);
});

for(var i=0; i<my_data.length; i++) {
    locker_nums[i] = my_data[i]['lockerNum'];
}

console.log(locker_nums);
console.log(index.toString());

while(locker_nums.includes(index.toString())) {
    index++;
    console.log(index);
}
if(index > 9) {
    //this will show in case create.inc.php is interuptted AND there are no lockers available anyways
    document.getElementById("msg").innerHTML = "There are no lockers currently available";
} else {
    //this will show in case request to create.inc.php is interuptted
    document.getElementById("msg").innerHTML = "Error when assigning to locker " + index;
}

/*$("button").click(function() {
    $("#msg").fadeTo("slow", 1);
})*/


$(document).ready(function() {
	$("form").submit(function(event) {
        event.preventDefault();
        var admin = document.getElementById("admin").innerHTML;
        console.log(admin);
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var num_books = document.getElementById("num_books").value;
        var reference_num = document.getElementById("reference_num").value;
        console.log(name);
		console.log("debug");

		$.post("create.inc.php", {
                admin: admin,
				name: name,
                email: email,
                num_books: num_books,
                reference_num: reference_num

			},
            function(data, status) {
                // only needed for debugging
				console.log('data', data);
				console.log('status', status);
                document.getElementById('msg').innerHTML = "Order successfully assigned to locker " + data;
			}
		);

        $("#msg").fadeTo("slow", 1);
	});
});