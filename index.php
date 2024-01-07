<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" type="text/css" href="templates/main.css">
<style>
        .chatbox {
                position: absolute;
                text-align: center;
                margin-left: 100vh;
                margin-top: -18vh;
                padding: 10px;
                max-height: 100px;
        }
        .messages {
                border: solid 1px;
                border-radius: 2px;
                max-height: 450px;
                max-width: 300px;
                overflow-y: auto;
        }
        @media (max-width: 768px) {
            .chatbox {
                display: none;
            }
        }
</style>
</head>
<body>
<?php include('templates/header.php');?> 
<?php include('templates/loginbtn.php');?>
<div class="content">
	<h1>Welcome to Geicomo.com`s main page</h1>
        <p>This page is basically an about me page, this is Geicomo.com a personal website for... Geicomo.<br> You can find info about the websites host and the game servers that are hosted along side it. <br> Enjoy whats here.</p>

 Geicomos server will be preforming upgrades soon and all servers <br> have been shutdown in preperation!, some services may become <strong>unavailable</strong> <br> at that time, sorry for any inconvinience!

<div class="chatbox">
        <strong>Logged In Live Chat</strong>
        <div class="messages" id="chat-box">
	<!-- Chat messages will be displayed here -->
</div>
	<a><strong>Login to chat</strong></a>
</div>
<!-- Add JavaScript and AJAX code to update the chat and send messages -->
<script>
    // Function to update the chat using AJAX
    function updateChat() {
        var chatBox = document.getElementById('chat-box');
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Split the response into individual messages
                var messages = xhr.responseText.split('\n');

                // Create an HTML string to store the formatted messages
                var html = '';

                // Loop through the messages and format them
                for (var i = 0; i < messages.length; i++) {
                    if (messages[i]) {  // Skip empty lines
                        html += '<div>' + messages[i] + '</div>';
                    }
                }

                // Update the chat box with formatted messages
                chatBox.innerHTML = html;

                // Scroll to the bottom of the chat box to show the latest messages
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };

        xhr.open('GET', '../livechat/get_chat_messages.php', true);
        xhr.send();
    }

    // Function to send a message using AJAX
    function sendMessage(message) {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Message sent successfully, update the chat
                updateChat();
            }
        };

        xhr.open('POST', '../livechat/send_message.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('message=' + encodeURIComponent(message));
    }

    // Update the chat initially and every 5 seconds
    updateChat();
    setInterval(updateChat, 5000);

    chatForm.addEventListener('submit', function (e) {
    });
</script>
</div>
<?php include('templates/footer.php');?>
</body>
</html>
