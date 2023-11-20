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
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
.btn {
  position: absolute;
  top: 0;
  right: 0;
  margin-right: 5px;
  border-radius: 4px;
  width: 100px;
  height: 40px;
  color: black;
  background-color: #f0f0f0;
  border: none;
  cursor: pointer;
  transition: top 0.3s ease, right 0.3s ease;
}
/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  border-radius: 4px;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)}
  to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
  from {transform: scale(0)}
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<?php include('templates/header.php');?> 
<div class="content">
	<h1>Welcome to Geicomo.com`s main page</h1>
        <p>This page is basically an about me page, this is Geicomo.com a personal website for... Geicomo.<br> You can find info about the websites host and the game servers that are hosted along side it. <br> Enjoy whats here.</p>
        <a href="http://cynicalmillia.net/">Check out CynicalMillia.net the worst site on the internet</a>

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

    // Handle chat form submission
    var chatForm = document.getElementById('chat-form');
    chatForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var messageInput = document.getElementById('message');
        var message = messageInput.value;

        // Send the message using AJAX
        sendMessage(message);

        // Clear the message input field
        messageInput.value = '';
    });
</script>

<button class="btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">

 <form class="modal-content animate" method="post" action="data/login.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
   <p style="font-family:courier;font-size:37px"><strong> Login Panel </strong></p>
   </div>
    <div class="container">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
	<button type="submit" >Login</button>
      <button type="button" style="background-color:#E72A2A;" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <a href="data/signup.php"><button type="button" style="float:right;background-color:#00B2FF;" >Sign Up</button></a>
</form>
</div>
</div>
<script>
// Get the modal
var modal = document.getElementById('id01';
        const button = document.querySelector('.btn');
        button.addEventListener('mouseover', () => {
            const randomX = Math.random() * (window.innerWidth - button.offsetWidth);
            const randomY = Math.random() * (window.innerHeight - button.offsetHeight);

            button.style.setProperty('--random-x', randomX + 'px');
            button.style.setProperty('--random-y', randomY + 'px');
        });
</script>
</div>
<?php include('templates/footer.php');?>
</body>
</html>
