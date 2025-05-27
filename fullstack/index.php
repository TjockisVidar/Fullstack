<php>
<?php include 'includes/db_connect.php'?>

</php>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <script src="logic.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amarante&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body>
    <div style="display: none;" id="change-page" class="changePage"></div>


    <div class="logCreateContainer">
        <div id="profile-button" class="profile profileOff">
            <svg id="profile-text" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g><g id="SVGRepo_iconCarrier"> <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#ffffff" stroke-width="0.72" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <p id="close-text">+</p>
        </div>
    
        <div id="create-button" class="createButton">
            <p id="create-add-close">+</p>
        </div>
    </div>
    

    <div style="display: none;" id="logsignin-container" class="logsigninContainer">
        <div id="slide-cover" class="cover">
            <div id="right-container" class="right">
                <h2 id="welcome-text">Welcome Back!</h2>
                <button id="signup-button">Sign Up</button>
            </div>
            <div id="left-container" class="left">
                <h2 id="welcome-text">Sign In</h2>
                <button id="login-button">Login</button>
            </div>
        </div>
        
        <div id="login-page" class="login">
            <div class="usernameContainer">
                <p>Username</p>
                <input type="text">
            </div>
            <div class="passwordContainer">
                <p>Password</p>
                <input type="password">
            </div>
            <button id="user-log-in">Log In</button>
        </div>
        <div id="signup-page" class="signup">
            <div class="usernameContainer">
                <p>Username</p>
                <input type="text">
        </div>
            <div class="mailContainer">
                <p>Mail</p>
                <input type="mail">
            </div>
            <div class="passwordContainer">
                <p>Password</p>
                <input type="password">
            </div>
            <button>Sign up</button>
        </div>
    </div>

    <div style="display: none;" id="upload-page" class="uploadPage">
        <form id="text-container" class="textContainer">
            <input name="Username" id="text-username" class="textUsername" type="text" placeholder="Username" maxlength="20">
            <input name="Heading" id="text-heading" class="textHeading" type="text" placeholder="Heading" maxlength="25">
            <p id="letter-count" class="letterCount">5000</p>
            <textarea name="Text" id="text-text" type="text" maxlength="5000"></textarea>
            <button type="submit" id="submit-text">Submit</button>
        </form>
    </div>
    
    <h4 class="textHeading">TEXTS</h4>

    <div id="texts-container" class="textsContainer">

    </div>
    <div class="logoContainer">
        <h1>The Everyday Edit</h1>
    </div>
</body>
</html>