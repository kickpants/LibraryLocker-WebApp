//hard coded locker data
//Full locker info (locker number, locker color, Student Name) should be inputed from database to test_lockers array

//declaring array to store query from the database
var my_data = [];

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

//2D locker array is initialized here with all unavailable lockers
console.log(my_data);
var test_lockers = new Array();
for(var i=0; i < 9; i++) {
	test_lockers[i] = new Array();
	test_lockers[i][0] = (i+1);
	test_lockers[i][1] = 'Silver';
	test_lockers[i][2] = '';
}

//positioning the lockers from the database in the 2D locker array
var my_length = my_data.length
var my_count = 0;
for(var i=0; i < 9; i++) {
	//if the locker number of the test locker is the same as the locker number in the database response,
	//further information is provided to that part of the locker array
	if (test_lockers[i][0] == my_data[my_count]['lockerNum']) {
		test_lockers[i][0] = my_data[my_count]['lockerNum'];
		test_lockers[i][1] = my_data[my_count]['lockerStat'];
		test_lockers[i][2] = my_data[my_count]['studentName'];

		//given a match, the count for the database responses is incremented
		my_count++;
		//if the the count of the database responses hits the number of responses available, there are no more lockers to add
		//and the loop is broken
		if (my_count == my_length) {
			break;
		}
	}
}

var click_stat = [0, 0, 0, 0, 0, 0, 0, 0, 0];
var locker_info = []; //each locker database info
var locker_num = []; //button number
var locker_stat = []; //button color
var locker_name = []; //button name
var pass_number = []; //array to hold green lockers that will be passed
var delete_number = []; //array to hold red lockers that will be passed
var gen_number = []; //array to hold gray lockers that will be passed

//assigning locker data to each specific array
function locker_data(test_lockers) {
	for (var i = 0; i < test_lockers.length; i++) {
		for (var j = 0; j < 3; j++) {
			//Locker infos are assigned to locker info array
			locker_info.push(test_lockers[i][j]);
		}
	}
	
	//locker number is filtered from locker_info array and assigned to locker_num array
	for (var l_num = 0; l_num < locker_info.length; l_num += 3) {
		locker_num.push("Locker ".concat(locker_info[l_num]).toString());
	}
	
	//locker color is filtered from locker_info array and assigned to locker_stat array	
	for (var l_stat = 1; l_stat < locker_info.length; l_stat += 3) {
		locker_stat.push(locker_info[l_stat]);
	}
	
	//locker name is filtered from locker_info array and assigned to locker_name array
	for (var l_name = 2; l_name < locker_info.length; l_name += 3) {
		locker_name.push(locker_info[l_name]);
	}
}

//assign locker door colors based on locker_stat info
function locker_color() {
	var count = 1;
	
	for (var i = 0; i < locker_stat.length; i++) {
		var locker = "Locker_btn";
		locker = locker.concat(count);
		if (locker_stat[i] == "Green") {
			document.getElementById(locker).style.background = '#5cb85c';
			document.getElementById(locker).disabled = false;
		} 
		else if (locker_stat[i] == "Red") {
			document.getElementById(locker).style.background = '#d9534f';
			document.getElementById(locker).disabled = false;
		} 
		else if (locker_stat[i] == "Gray") {
			//if grey then button is disabled
			document.getElementById(locker).style.background = 'Grey';
			document.getElementById(locker).disabled = false;
		}
		else{
			document.getElementById(locker).style.background = 'Silver';
			document.getElementById(locker).disabled = true;
		}
		count += 1;
	}
}

//locker alerts and border highlight function
function button_event(index){
	var find_num //value to use for removing elements from pass_number
	
	//Green locker = Inserting books
	if (locker_stat[index] == "Green") {
		document.getElementById("msg").innerHTML = "[" + locker_num[index] + "] " + " Insert Books: " + locker_name[index];
			
	} 
	//Red locker = Removing book
	else if (locker_stat[index] == "Red") {
		document.getElementById("msg").innerHTML = "[" + locker_num[index] + "] " + " Remove Books: " + locker_name[index];
	}
	
	//Button clicked is highlighted by black border
	if (click_stat[index] == 0)
	{
		click_stat[index] = 1;
		document.getElementById("Locker_btn".concat((index+1).toString())).style.border = "2px solid black";
		if (locker_stat[index] == "Green") {
			pass_number.push(index+1);
			console.log(pass_number);
		}
		if (locker_stat[index] == "Red") {
			delete_number.push(index+1);
			console.log(delete_number);
		}
		if (locker_stat[index] == "Gray") {
			gen_number.push(index+1);
			console.log(gen_number);
		}
	}
	//if button is clicked again then unhighlight black border
	else
	{
		click_stat[index] = 0;
		document.getElementById("Locker_btn".concat((index+1).toString())).style.border = "none";
		if (locker_stat[index] == "Green") {
			find_num = pass_number.indexOf(index+1);
			if (find_num > -1) {
				pass_number.splice(find_num, 1);
				console.log(pass_number);
			}
		}
		if (locker_stat[index] == "Red") {
			find_num = delete_number.indexOf(index+1);
			if (find_num > -1) {
				delete_number.splice(find_num, 1);
				console.log(delete_number);
			}
		}
		if (locker_stat[index] == "Gray") {
			find_num = gen_number.indexOf(index+1);
			if (find_num > -1) {
				gen_number.splice(find_num, 1);
				console.log(gen_number);
			}
		}
	}
	
}

function locker_face_name(){
	for(var i = 0; i < locker_name.length; i++)
		{
			var index = i + 1;
			var name = locker_name[i].split(" ")
			if(locker_name[i] == "")
				{
					continue;
				}
			else{
				document.getElementById("Locker_btn".concat((index).toString())).textContent = locker_num[i] + ": " + "[" + name[0].substr(0,1) + ". " + name[1].substr(0,3) + "]";
			}
			
		}
	// 
}

function alerts() {

	document.getElementById("Locker_btn1").addEventListener("click", function() {
		button_event(0);
	});
	
	document.getElementById("Locker_btn2").addEventListener("click", function() {
		button_event(1);
	});
	
	document.getElementById("Locker_btn3").addEventListener("click", function() {
		button_event(2);
	});
	
	document.getElementById("Locker_btn4").addEventListener("click", function() {
		button_event(3);
	});
	
	document.getElementById("Locker_btn5").addEventListener("click", function() {
		button_event(4);
	});
	
	document.getElementById("Locker_btn6").addEventListener("click", function() {
		button_event(5);
	});
	
	document.getElementById("Locker_btn7").addEventListener("click", function() {
		button_event(6);
	});
	
	document.getElementById("Locker_btn8").addEventListener("click", function() {
		button_event(7);
	});
	
	document.getElementById("Locker_btn9").addEventListener("click", function() {
		button_event(8);
	});
	
}

function toggleIf(element, condition) {
	if (condition) {
		element.show();
	}
	else {
		element.hide();
	}
}

//lockers are updated
//locker updates should be sent to database
function done_submission(click_stat, test_lockers) {
	for (var i = 0; i < click_stat.length; i++) {
		if (click_stat[i] == 1) {
			if (test_lockers[i][1] == "Green") {
				test_lockers[i][1] = "Gray";
				click_stat[i] = 0;
			} else if (test_lockers[i][1] == "Red") {
				test_lockers[i][1] = "Gray";
				click_stat[i] = 0;
			} else {
				click_stat[i] = 0;
			}
		
		}
	}
}

$("#gen_btn").hide();
locker_data(test_lockers);
locker_color();
locker_face_name();
alerts();

$("button").click(function() {
	toggleIf($("#gen_btn"), gen_number.length > 0);
});

$(document).ready(function() {
	$("#gen_btn").click(function() {
		if (gen_number.length > 0) {
			var qrdata = JSON.stringify(gen_number);
			console.log("debug_qr")
	
			$.post("return_auth.php", {
					qrdata: qrdata
				},
				function(data, status) {
					console.log('data', data);
					console.log('status', status);
					if (status == 'success') {
						$("#qrpanel").hide();
						new QRCode(document.getElementById("qrcode"), data);
						$("#qrpanel").slideDown("slow", "swing");
					}
				}
			);
		} else {
			$("#qrpanel").hide();
			document.getElementById("qrcode").innerHTML = "No Lockers Selected";
			$("#qrpanel").slideDown("slow", "swing");
		}
	});
});

$(document).ready(function() {
	$("#done_btn").click(function() {
		if (pass_number.length > 0 || delete_number.length > 0) {
			var greendata = JSON.stringify(pass_number);
			var reddata = JSON.stringify(delete_number);
			console.log("debug");

			$.post("confirm.php", {
					greendata: greendata,
					reddata: reddata
				},
				function(data, status) {
					console.log('data', data);
					console.log('status', status);
				}
			);

			$.post("admin_auth.php", {
					greendata: greendata,
					reddata: reddata
				},
				function(data, status) {
					console.log('data', data);
					console.log('status', status);
					if (status == 'success') {
						$("#qrpanel").hide();
						new QRCode(document.getElementById("qrcode"), data);
						$("#qrpanel").slideDown("slow", "swing");
					}
				}
			);
		} else {
			$("#qrpanel").hide();
			document.getElementById("qrcode").innerHTML = "No Lockers Selected";
			$("#qrpanel").slideDown("slow", "swing");
		}
	});
});

setInterval(function() {
	document.getElementById("done_btn").addEventListener("click", function() {
		document.getElementById("msg").innerHTML = "Submitted";
		done_submission(click_stat, test_lockers);
		locker_info = [];
		locker_num = []; //button number
		locker_stat = []; //button color
		locker_name = []; //button name
		locker_data(test_lockers);
		locker_color();
	});
	
}, 100);