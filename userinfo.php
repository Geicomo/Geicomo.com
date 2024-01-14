<!DOCTYPE html>
<html lang="en">
<head>
	<title>user_info.geic</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="https://www.geicomo.com/templates/base.css">
</head>
<body>
<?php
	// Start a session
	session_start();

	// Initialize the $isValidLogin variable
	$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
	$username = $isValidLogin ? $_SESSION['username'] : 'Guest';

	// Path to the JSON file
	$jsonFilePath = '/var/www/data.json';

	// Read the file contents
	$jsonString = file_get_contents($jsonFilePath);

	// Decode the JSON string into an associative array
	$jsonArray = json_decode($jsonString, true);

	// Function to get the last login time for a given username
	function getLastLoginTime($username, $jsonArray) {
	    if (isset($jsonArray[$username]['lastLogin'])) {
	        return $jsonArray[$username]['lastLogin'];
	    } else {
		if ($username === 'Guest') {
			return "No last login time for Guest.";
			exit;
		}
		return "Last login time not found for user: $username";
	    }
	}



?>
<a style="font-size:15px;float:right;"href="https://geicomo.com/help">help.info</a>
<p style="font-size:17px">Welcome: <?php echo "$username" ?> </p>
Last Login:
<?php echo getLastLoginTime($username, $jsonArray); ?>
<br><br>
<a style="font-size:17px;">Live chat messaging:</a><br>
    <?php
	if ($username !== 'Guest') {
    		echo '<input type="text" id="message" placeholder="Type your message" required>';
           	echo '<button id="send-button">Send</button>';
	} else {
    		echo '<input type="text" id="message" disabled placeholder="Guests cant post">';
		echo '<button id="send-button" disabled>X</button>';
	}
    ?>
<br><br>
    <?php
    if ($username === 'Geicomo') {
        // Display input fields for title and blog content
        echo '<a style="font-size:18px;">Post to the Blog</a><br><br>';
        echo '<label for="blog_title">Title:</label><br>';
        echo '<input type="text" id="blog_title" required><br>';
        echo '<label for="blog_content">Content:</label><br>';
        echo '<textarea id="blog_content" rows="4" cols="50" required></textarea><br>';
        echo '<button id="submit_blog" style="align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:60px;float:left;background-color:#34b500;">Submit</button>';
    }
            if (!$username) {
        echo '<h2>Blog Posts</h2>';
        $blogFilePath = 'blogs.txt';
        if (file_exists($blogFilePath)) {
            $blogPosts = file_get_contents($blogFilePath);
            $postsArray = explode("\n\n", $blogPosts); // Split posts based on double newline
            foreach ($postsArray as $post) {
                echo '<div class="blog-post">';
                // Extract the title, date, and content from each post
                list($title, $date, $content) = explode("\n", $post, 3);
                echo '<p class="blog-title">' . $title . '</p>';
                echo '<p class="blog-date">' . $date . '</p>';
                echo '<p class="blog-content">' . nl2br($content) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No blog posts available.</p>';
        }
    }
    ?>

    <!-- Include JavaScript for submitting the blog post -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submitButton = document.getElementById('submit_blog');
            const blogTitle = document.getElementById('blog_title');
            const blogContent = document.getElementById('blog_content');

            submitButton.addEventListener('click', function () {
                const title = blogTitle.value;
                const content = blogContent.value;
                // Send the title and content to the PHP script using AJAX
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Refresh the page after successful submission
                        location.reload();
                    }
                };
                xhr.open('POST', 'https://geicomo.com/blog/posttoblog.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('blog_title=' + encodeURIComponent(title) + '&blog_content=' + encodeURIComponent(content));
            });
	});

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

    xhr.open('GET', 'https://geicomo.com/livechat/get_chat_messages.php', true);
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
<?php
if ($_SESSION['authorized']) {
// Check if the logout button was clicked
if (isset($_POST['logout'])) {
    // Unset the authorized session variable to log the user out
    $_SESSION['authorized'] = false;

    // Redirect to the home page after logging out
    echo "<script>window.location.href = 'https://geicomo.com/index.php';</script>";
    exit;
}

// Check if the user is not logged in, then redirect to index.php
if (!$isValidLogin) {
    header("Location: index.php");
    exit;
}
    echo "<form method='post' action=''>";
    echo "<button class='btn' type='submit' name='logout' style='display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:60px;float:left;background-color:#fda502;'>Logout</button>";
    echo "</form>";
} else {
     echo "<a href='https://geicomo.com/index.php'><button class='btn' style='width:display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:60px;float:left;background-color:#fda502;'>Login</button></a>";
}
?>
<br><br><br>
<a href="https://geicomo.com/livechat/messageboard.php">chat.info</a>
<br><br><br><br>
<?php include('templates/directory.php');?>
</body>
</html>
