<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chatbot</title>
    <link rel="stylesheet" href="./css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <img src="chatGPT-logo.png" alt="logo" id="logo">

        <div class="description">
            <h1>How can i help you today ?</h1>
            <p>This code will display a prompt asking th euser for their name , and then it will dispay a greeting message with the name entered by the user</p>
        </div>

        <div class="capabilities">
            <div class="card">
                <i class="fa-regular fa-bookmark"></i>
                <h2>Saved Prompt Templates</h2>
                <p>users save and reuse prompt templates for faster responses</p>
            </div>
            <div class="card">
                <i class="fa-solid fa-photo-film"></i>
                <h2>Media Type Selection</h2>
                <p>Users select media type for tailored interactions</p>
            </div>
            <div class="card">
                <i class="fa-solid fa-language"></i>
                <h2>Multilingual Support</h2>
                <p>Choose language for better interaction</p>
            </div>
        </div>

        <div class="chat-box" id="chat-box"></div>
        <div class="chat-input">
            <input type="text" id="user-input" placeholder="Type a message...">
            <button id="send-btn">Send</button>
        </div>
    </div>
</body>
</html>