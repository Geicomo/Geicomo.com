<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>geic_bloc.info</title>
    <!-- Add your CSS styles here -->
	<style>
    		        /* Add your CSS styles for blog display here */
	.blog-post {
	    max-width: 85vh;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            background-color: #f9f9f9;
        }

        .blog-title {
            font-size: 19px;
	    font-weight: bold;
	    margin-bottom: -5px;
        }

	.blog-date {
	    margin-bottom: -15px;
            font-size: 13px;
            color: #888;
        }

        .blog-content {
            font-size: 16px;
            line-height: 1.4;
	}
	</style>
</head>
<body>
    <h1>Welcome to the Blog Page</h1>
    
    <?php
    session_start();

    // Check if the username is "Geicomo"
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

    if ($username) {
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
                xhr.open('POST', 'posttoblog.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('blog_title=' + encodeURIComponent(title) + '&blog_content=' + encodeURIComponent(content));
            });
        });
    </script>
</body>
</html>

