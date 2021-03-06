<!DOCTYPE html>
<title>Pay your parking!</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="manifest" href="manifest.json">
<meta name="theme-color" content="white">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="PPapp">

<link rel="stylesheet" href="s.css">

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous" ></script>
<script src="ppp.js" type="text/javascript" defer></script>
<header id="header1">
    <section id="loggedOut">
        <a href="#" id="lnkLogIn">Log in</a>
        <a href="#" id="lnkSignUp">Sign Up</a>
    </section>
</header>
<main>
    <section id="login">
        <h2 id="abc">Log In into Your Account</h2>
        <form id="loginform">
            <label for="emailLogin">Email</label>
            <input id="emailLogin" type="email" placeholder="Enter your email"required><br>
            <label for="passLogin">Password</label>
            <input id="passLogin" type="password" placeholder="Enter your password" required><br>
            <button id="btnLogIn">Log In</button>
        </form>
    </section>

    <section id="signup">
        <h2 id="def">Sign Up for a New Account</h2>
        <form onsubmit="return false" id="signupform">
            <label for="label">Name</label>
            <input id="name" placeholder="Enter your full name" required><br>
            <label for="email">Email</label>
            <input id="email" type="email" placeholder="Enter your email"required><br>
            <label for="tel">Tel.</label>
            <input id="tel" placeholder="Enter your telephone number" required><br>
            <label for="pass">Password</label>
            <input id="pass" type="password" placeholder="Enter your password" required><br>
            <label for="pass2">Confirm Pass</label>
            <input id="pass2" type="password" placeholder="Re-enter your password" required><br>
            <button id="btnSignUp">Sign Up</button>
        </form>
    </section>

    <section id="after_login">

        <h2 id="h2_after_login"></h2>
        <div id="afterLoginAndPaid"></div>
        <button id="btnOnGoingSvc">Check the on going Services!</button>
        <button id="btnPay">Pay your parking!</button>
        <button id="btnTopUp">Top Up Credits!</button>
        <button id="btnHistory">History</button>
        <button id="btnLogOut">Log Out</button>
    </section>

    <section id="topupCredit">
        <h3 id="h2_topup"></h3>
        <select id="selectCredit">
            <option value="10">RM 10</option>
            <option value="20">RM 20</option>
            <option value="30">RM 30</option>
        </select>
        <br>
        <button id="TopUpNow">Top Up!</button>
        <button id="btnTopUpHistory">Top Up History</button>
        <button id="Return1">Return</button>
    </section>



    <section id="pay">
        <div id="map">Please for few seconds...</div>

        <div id="paymentOption">
            <label for="price">Pay for:</label>
            <select id="option2">
                <option value="33">30 minutes </option>
                <option value="1">1 hour </option>
                <option value="2">2 hour </option>
                <option value="3">3 hour </option>
                <option value="99">Overnight </option>
            </select><br>
            <label for="carPlate">Car plate no.:</label>
            <input id="carPlate" placeholder="Enter your car plate number" required><br>
            <button id="btnPayNow">Pay Now!</button>
            <h4>30minutes : RM1</h4>
            <h4>1 hours   : RM2</h4>
            <h4>2 hours   : RM3</h4>
            <h4>3 hours   : RM4</h4>
            <h4>Overnight : RM10</h4>
        </div>
        <button id="Return2">Return</button>
    </section>

    <section id="clickedCheck">
        <div id="onGoingRecord"></div>
        <button id="Return3">Return</button>
    </section>

    <section id="clickedHistory">
        <div id="onGoingHistory"></div>
        <button id="Return4">Return</button>
    </section>

    <section id="clickedExtend">
        <div id="ExtendDuration"></div>
        <label for="extend_price">Extend for:</label>
        <select id="option3">
            <option value="33">30 minutes </option>
            <option value="1">1 hour </option>
            <option value="2">2 hour </option>
            <option value="3">3 hour </option>
            <option value="99">Overnight </option>
        </select><br>
        <button id="payForExtend">Extend!</button>
        <button id="Return5">Return</button>
    </section>

    <section id="clickedTopUpHistory">
        <div id="TopUpHistory"></div>
        <button id="Return6">Return</button>
    </section>
</main>
