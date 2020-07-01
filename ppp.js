//global variable
var addr;

//Header links
var lnkLogIn = document.querySelector("#lnkLogIn");
var lnkSignUp = document.querySelector("#lnkSignUp");

//Sections
var sectionSignUp = document.querySelector("#signup");
var sectionLogIn  = document.querySelector("#login");
var sectionAfterLogIn = document.querySelector("#after_login");
var sectionHeader1 = document.querySelector("#header1");
var sectionTopUp = document.querySelector("#topupCredit");
var sectionPay = document.querySelector("#pay");
var sectionPayNow = document.querySelector("#paymentOption");
var sectionafterLoginAndPaid = document.querySelector("#afterLoginAndPaid");
var sectionclickedCheck = document.querySelector("#clickedCheck");
var sectionclickedHistory = document.querySelector("#clickedHistory");
var sectionclickedExtend = document.querySelector("#clickedExtend");
var sectionclickedTopUpHistory = document.querySelector("#clickedTopUpHistory");

//buttons
var btnLogIn = document.querySelector("#btnLogIn");
var btnSignUp = document.querySelector("#btnSignUp");
var btnLogOut = document.querySelector("#btnLogOut");
var btnTopUp = document.querySelector("#btnTopUp");
var btnTopUpNow = document.querySelector("#TopUpNow");
var btnReturn1 = document.querySelector("#Return1");
var btnReturn2 = document.querySelector("#Return2");
var btnReturn3 = document.querySelector("#Return3");
var btnReturn4 = document.querySelector("#Return4");
var btnReturn5 = document.querySelector("#Return5");
var btnReturn6 = document.querySelector("#Return6");
var btnPay = document.querySelector("#btnPay");
var btnPayNow = document.querySelector("#btnPayNow");
var btnHistory = document.querySelector("#btnHistory");
var btnOnGoingSvc = document.querySelector("#btnOnGoingSvc");
var btnpayForExtend = document.querySelector("#payForExtend");
var btnTopUpHistory = document.querySelector("#btnTopUpHistory");

//on Load
window.addEventListener("DOMContentLoaded",function(){

    if(localStorage.getItem("loggedIn") && localStorage.getItem("credit")) {
        check_exp();
        $('#h2_after_login').html("Welcome " + localStorage.getItem("loggedIn") + ", you now have RM " + localStorage.getItem("credit") + " !");
        sectionAfterLogIn.style.display = "block";
        sectionHeader1.style.display = "none";
        sectionLogIn.style.display = "none";
        //updateDetail();
        /*
                if(localStorage.getItem("period") && localStorage.getItem("addr") && localStorage.getItem("carPlate")){
                    var duration = get_duration();
                    get_time();
                    var time = localStorage.getItem("start");
                    var end_time = localStorage.getItem("end");
                    //console.log(time);console.log(end_time);
                        $('#afterLoginAndPaid').html("Your car: "+localStorage.getItem("carPlate")+"<br> Parked: "+localStorage.getItem("addr")+"<br>Start: "+time+"<br>"
                    +"Period: "+duration+"<br>End: "+ end_time);
                    sectionafterLoginAndPaid.style.display = "block";
                    btnOnGoingSvc.style.display = "block";
                    btnPay.style.display = "none";
                }

            }else{
                clearSections();
                sectionHeader1.style.display = "block";
            }
        */
    }
});


lnkLogIn.addEventListener("click", function() {
    clearSections();
    sectionLogIn.style.display = "block";
});
lnkSignUp.addEventListener("click", function() {
    clearSections();
    sectionSignUp.style.display = "block";
});

btnLogIn.addEventListener("click", function() {
    var email = document.querySelector("#emailLogin").value;
    var pass = document.querySelector("#passLogin").value;
    //alert(email);alert(pass);
    if (email.length < 6 || pass.length < 6) {
        alert("Invalid login data");
        $("#loginform")[0].reset();
    } else {
        check_login(email, pass);
    }
});


btnSignUp.addEventListener("click", function(){
    var name = document.querySelector("#name").value;
    var email = document.querySelector("#email").value;
    var pass = document.querySelector("#pass").value;
    var pass2 = document.querySelector("#pass2").value;
    var tel = document.querySelector("#tel").value;
    if(pass!=pass2){
        alert("Please double confirm your password!");
    }else if(email.length<6){
        alert("Email field must be more than 6 words!");
    }else if(pass.length<6){
        alert("Password must be more than 6 words!");
    }else if(name.length<6){
        alert("Name must be more than 6 words!");
    }else if(tel.length<5) {
        alert("Telephone number must be more than 5 numbers!");
    } else{
        //We are passing the information to php
        //alert("OK");
        $.post('register.php',{postName:name, postEmail:email,postPass:pass, postTel: tel},function(data){
            //alert(data);
            //$('#').html(data); this can put message from php into html selector

            if(data=="abc"){
                alert("Register success! Please click Log In button to log in!");

                //reset form after submission
                $("#signupform")[0].reset();
                location.reload();
            }else{
                alert("Email is used, please try another!");
                $('#signupform')[0].reset();
            }

        });
    }
});
btnLogOut.addEventListener("click", function(){
   //localStorage.removeItem("loggedIn");
   //localStorage.removeItem("credit");
    $.post("logout.php",{postName:localStorage.getItem("loggedIn")},function(data){});
    removeSaved();
    clearSections();
    location.reload();
    sectionHeader1.style.display = "block";

});

btnTopUp.addEventListener("click",function () {
    clearSections();
    $('#h2_topup').html("Dear "+ localStorage.getItem("loggedIn")+ ", you now have RM "+ localStorage.getItem("credit") +". How much would you like to top up?");
    sectionTopUp.style.display = "block";

});

btnTopUpNow.addEventListener("click",function(){
    var tp = $("#selectCredit").val();
    //alert (tp);
    if(confirmTopUp()) {
        $.post('topup.php', {
            postTp: tp,
            postName: localStorage.getItem("loggedIn"),
            postCurrentVal: localStorage.getItem("credit")
        }, function (data) {
            if (data == "1") {
                alert("Done!");
                updateCredit();
                recordTopUp(tp);
                clearSections();

                //reload page after top up
                updateCredit();
                location.reload();
                sectionAfterLogIn.style.display = "block";
            }
        else
            {
                alert("failed!");
                location.reload();
            }

        });
    }else {
        location.reload();
    }
});

btnTopUpHistory.addEventListener("click",function(){
   topupHistory();
});

btnReturn1.addEventListener("click",function(){
    location.reload();
});

btnReturn3.addEventListener("click",function(){
    location.reload();
});

btnReturn4.addEventListener("click",function(){
    location.reload();
});
btnReturn5.addEventListener("click",function(){
    location.reload();
});

btnPay.addEventListener("click",function () {
    clearSections();
    sectionPay.style.display = "block";
    var x = document.getElementById("map");
    //getLocation();
    navigator.geolocation.getCurrentPosition(function (position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        //x.innerHTML = "Latitude: " + lat + "<br>Longitude: " + lng;

        //pass the lat and lng to php now
        //expect a street name data for function handler
        $.post('location.php',{postLat:lat,postLng:lng},function(data){
            window.addr = data;
            //show streetname in html
            x.innerHTML = "Your current location is " + data;
            sectionPayNow.style.display = "block";
        });
    },function (error) {
        //show error in html
        x.innerHTML = "Geolocation is not supported by this browser, please click return to go back";
    });

});

btnPayNow.addEventListener("click",function () {
    var period = $("#option2").val();
    var carPlate = document.querySelector("#carPlate").value;
    if(carPlate.length < 2){
        alert("Car plate no. must be more than 2 words!");
    }else if(localStorage.getItem("credit") == 0){
        alert("Please top up first to use the service!");
    }else if(check_balance(localStorage.getItem("credit"),period)){
        alert("You do not have enough money, Please top up!");
    } else {
        if (confirmSubmit()) {
            $.post('payment.php', {
                postPeriod: period,
                postcarPlate: carPlate,
                postAddr: window.addr,
                postName: localStorage.getItem("loggedIn"),
                postCredit: localStorage.getItem("credit")
            }, function (data) {
                //localStorage.setItem("period",period);localStorage.setItem("carPlate",carPlate);localStorage.setItem("addr",window.addr);
                if (data == "a") {
                    updateCredit();
                    alert("ok!");
                    location.reload();
                } else if(data == "c"){
                    alert("This car is already paid or you have on going service!");
                }else if(data == "b")
                 {
                    alert("Something goes wrong!");
                }
            });
        }
    }
    //localStorage.setItem("period",period);localStorage.setItem("carPlate",carPlate);localStorage.setItem("addr",window.addr);
});

btnReturn2.addEventListener("click",function(){
    location.reload();
});

btnReturn6.addEventListener("click",function(){
    location.reload();
});

btnOnGoingSvc.addEventListener("click",function () {
    clearSections();
    $.post('check_svc.php',{postName:localStorage.getItem("loggedIn")},function(data){
        var result = JSON.parse(data);
        var total = result.length;
        sectionclickedCheck.style.display = "block";
        if(total != 0) {

            var html_string = '';
            for (var i = 0; i < total; i++) {
                var carplate = "\""+result[i]["carplate"]+"\"";
                var string = "<div id='record"+i+"'>CarPlate:"+ result[i]["carplate"]+"<br>Location: "+result[i]["street"]+"<br>" +
                    "Start: "+result[i]["start"]+"<br>" +
                    "End: "+result[i]["end"]+"<button id='btnExtend"+i+"' onclick='extendSvc("+carplate+")'>Extend</button><button id='btnStop"+i+"' onclick='stopSvc("+carplate+")'>Stop!</button><br><br></div>";
                //console.log(string);
                html_string = html_string + string;
            }
            $("#onGoingRecord").html(html_string);
        }else{
            $("#onGoingRecord").html("You have not use our service or it is already expired!");
        }
    });
});

btnHistory.addEventListener("click",function(){
   clearSections();
    $.post('check_history.php',{postName:localStorage.getItem("loggedIn")},function(data){
        var result = JSON.parse(data);
        var total = result.length;
        sectionclickedHistory.style.display = "block";
        if(total != 0) {
            var html_string = '';
            for (var i = 0; i < total; i++) {
                var string = "<div id='record"+i+"'>CarPlate:"+result[i]["carplate"]+"<br>Location: "+result[i]["street"]+"<br>" +
                    "Start: "+result[i]["start"]+"<br>" +
                    "End: "+result[i]["end"]+"<br>Expiration: "+result[i]["expired"]+"<br>Stop by User:"+result[i]["user_stop"]+"<br><br></div>";

                html_string = html_string + string;
            }
            $("#onGoingHistory").html(html_string);
        }else{
            $("#onGoingHistory").html("You have not use our service!");
        }
    });
});

//functions

function clearSections() {
    var sections = document.querySelectorAll("main>section");
    for (var section of sections) {
        section.style.display = "none";

    }
}
function updateCredit(){
    $.post('check_credit.php',{postName:localStorage.getItem("loggedIn")},function(data){
        if(data == "a"){
            alert("something wrong");
        }else{
            localStorage.setItem("credit",data);
        }
    });
}

/*
function updateDetail(){
    $.post('update_detail.php',{postName:localStorage.getItem("loggedIn")},function(data){
        var detail = JSON.parse(data);
        localStorage.setItem("period",detail["period"]);
        localStorage.setItem("addr",detail["street"]);
        localStorage.setItem("carPlate",detail["carplate"]);
        //location.reload();
        get_time();
        //location.reload();
    });

}
*/

function removeSaved(){
    localStorage.removeItem("loggedIn");
    localStorage.removeItem("credit");
    localStorage.removeItem("auto_saved_sql");
    localStorage.removeItem("wampStyle");


}

function confirmSubmit()
{
    var check1=confirm("Are you sure you want to pay it?");
    if (check1)
    {
        var check2=confirm("Are you 100% sure?");
        if (check2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}
function confirmStop()
{
    var check1=confirm("Are you sure you want to stop it?");
    if (check1)
    {
        var check2=confirm("Are you 100% sure?");
        if (check2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}
function confirmTopUp()
{
    var check1=confirm("Are you sure you want to top up?");
    if (check1)
    {
        var check2=confirm("Are you 100% sure?");
        if (check2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}function confirmExtend()
{
    var check1=confirm("Are you sure you want to extend?");
    if (check1)
    {
        var check2=confirm("Are you 100% sure?");
        if (check2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}
function get_duration(){
    var period = localStorage.getItem("period");
    if(period == 33 || period == "30 MINUTE"){
        return "30 MINUTES";
    }else if(period == 1 || period == "1 HOUR"){
        return "1 HOUR";
    }else if(period == 2 || period == "2 HOUR"){
        return "2 HOURS";
    }else if(period == 3 || period == "3 HOUR"){
        return "3 HOURS";
    }else if(period == 99 || period == "24 HOUR"){
        return "24 HOURS";
    }
}

function get_time(){
    var start_time;
    $.post('getTime.php',{postName:localStorage.getItem("loggedIn"),postcarPlate:localStorage.getItem("carPlate")},function(data){
        start_time = JSON.parse(data);
        localStorage.setItem("start",start_time["start"]);
        localStorage.setItem("end",start_time["end"]);
    });

}

function extendSvc(carplate){
    //alert(carplate);
    var name = localStorage.getItem("loggedIn");
    clearSections();
    sectionclickedExtend.style.display = "block";
    var string = "Your name: "+name+"<br>Your car plate: "+carplate+"<br>";
    $("#ExtendDuration").html(string);
    btnpayForExtend.addEventListener("click",function () {
        var extendDuration = $("#option3").val();
        if(check_balance(localStorage.getItem("credit"),extendDuration)){
            alert("You do not have enough money, Please top up!");
        }else {
            extdFunc(carplate, name, extendDuration);
        }
    });
}

function stopSvc(carplate){
    //alert(carplate);
    var name = localStorage.getItem("loggedIn");
    stopp(carplate,name);
}

function stopp(carplate,name){
    if(confirmStop()) {
        $.post('stop_svc.php', {postName: name, postcarPlate: carplate}, function (data) {
            if(data == "a"){
                alert("You have stopped the service!");
                location.reload();
            }else{
                alert("Something wrong, Please try again!");
            }
        });
    }
}

function extdFunc(carplate,name,extendDuration) {
    if (confirmExtend()) {
        $.post('extend_svc.php', {
            postName: name,
            postcarPlate: carplate,
            postDuration: extendDuration,
            postCredit: localStorage.getItem("credit")
        }, function (data) {
            //console.log(extendDuration);console.log(carplate);console.log(name);

            if (data == "a") {
                updateCredit()
                alert("Duration is extended!");
                location.reload();
            } else {
                alert("Something wrong");
                location.reload();
            }

        });
    }
}

function check_balance(credit,period){
    var price = get_price(period);
    credit = localStorage.getItem("credit");
    var balance = credit - price;
    if(balance < 0){
        return true;
    }else{
        return false;
    }
}
function get_price(period){
    if(period == 33){
        return 1;
    }else if (period == 1){
        return 2;
    }else if (period == 2){
        return 3;
    }else if (period == 3){
        return 4;
    }else if (period == 99){
        return 10;
    }else{
        return false;
    }
}
function check_exp(){
    $.post('check_expire.php',{},function(data){
        if(data == "a"){
            //alert("Refreshed!");
        }else{
            //alert("Not refreshed!");
        }
    });
}
function check_login(email,pass){
    $.post('login.php',{postEmail:email, postPass:pass},function(data){
        console.log(data);
        var obj=JSON.parse(data);
        if(data == "0") {
            alert("Wrong login information!");
            $("#loginform")[0].reset();
            location.reload();

        }else{
            //alert(obj[0]);alert(obj[1]);
            localStorage.setItem("loggedIn", obj[0]);
            localStorage.setItem("credit", obj[1]);
            location.reload();
        }

    });
}

function topupHistory(){
    clearSections();
    $.post('topUpHistory.php',{postName: localStorage.getItem("loggedIn")}, function(data){
        var result = JSON.parse(data);
        var total = result.length;
        sectionclickedTopUpHistory.style.display = "block";
        if(total != 0) {
            var html_string = '';
            for (var i = 0; i < total; i++) {
                var string = "<div>Date: "+result[i]["datetime"]+"<br>Amount: "+result[i]["topup_amount"]
                +"<br>After Top Up: RM"+result[i]["credit_after_topup"]+"<br><br></div>";
                html_string = html_string + string;
            }
            $("#TopUpHistory").html(html_string);
        }else{
            $("#TopUpHistory").html("You have not use our service!");
        }
    });
}

function recordTopUp(tp){
    $.post('recordTopUp.php',{postTp:tp, postName:localStorage.getItem("loggedIn"), postCredit:localStorage.getItem("credit")},function(data){
        if(data == "a"){
            //alert("Updated!");
        }else{
            //alert("Not update!");
        }
    });
}

/*
var x = document.getElementById("map");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {

    x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;

    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
}
*/