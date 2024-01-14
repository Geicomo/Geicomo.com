<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>live_chat.info</title>
    <!-- Add your CSS styles here -->
    <style>
        .chatbox {
                position: absolute;
                text-align: center;
                padding: 10px;
		width: 100%;
	}
	.messages {
		padding: 5px;
		width: 100%;
                border: solid 1px;
                border-radius: 2px;
	}
    </style>
</head>
<body>
<div class="content">
<div class="chatbox">
        <strong>Live Chat</strong>
	<div class="messages" id="chat-box">
	<!-- Chat messages will be displayed here -->
	</div>
</div>
<br><br><br><br><br><br><br><br>
</div>
<script>
// Chat Script
function updateChat() {
    var chatBox = document.getElementById('chat-box');
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Update the chat box with new messages
            chatBox.innerHTML = xhr.responseText;

            // Scroll to the bottom of the chat box to show the latest messages
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    };

    xhr.open('GET', 'https://geicomo.com/livechat/get_chat_messages.php', true);
    xhr.send();
}

// Function to send a message using AJAX
function sendMessage(message) {
    var xhr = new XMLHttpRequest();
	box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);	

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Message sent successfully, update the chat
            updateChat();
        }
    };

    xhr.open('POST', 'https://geicomo.com/livechat/send_message.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('message=' + encodeURIComponent(message));
}

// Update the chat initially and every 5 seconds
updateChat();
setInterval(updateChat, 5000);

// Handle chat send button click
var sendButton = document.getElementById('send-button');
sendButton.addEventListener('click', function () {
    var messageInput = document.getElementById('message');
    var message = messageInput.value;

    // Send the message using AJAX
    sendMessage(message);

    // Clear the message input field
    messageInput.value = '';
});
</script>
<br><br><br><br><br><br><br><br><br>
</body>
</html>

