<?php
session_start();

// Check if the user is logged in as "Geicomo" or another authenticated user
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if ($username === 'Geicomo' && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["blog_title"]) && isset($_POST["blog_content"])) {
    // Get the blog title and content from the POST data
    $blogTitle = $_POST["blog_title"];
    $blogContent = $_POST["blog_content"];

    date_default_timezone_set('America/Los_Angeles');

    // Sanitize and prepare the title and content
    $blogTitle = htmlspecialchars($blogTitle, ENT_QUOTES, 'UTF-8');
    $blogContent = htmlspecialchars($blogContent, ENT_QUOTES, 'UTF-8');

    $blogFilePath = 'blogs.txt';

    // Create the new blog post with the current date
    $formattedBlogPost = $blogTitle . "\n" . date('jS \of F, Y, g:ia') . "\n" . $blogContent . "\n\n";

    // Read the existing content of the file
    $existingContent = file_get_contents($blogFilePath);

    // Create a temporary file
    $tempFilePath = 'temp_blogs.txt';

    // Open the temporary file for writing
    $tempFile = fopen($tempFilePath, 'w');

    // Write the new blog post to the temporary file
    fwrite($tempFile, $formattedBlogPost);

    // Write the existing content to the temporary file
    fwrite($tempFile, $existingContent);

    // Close the temporary file
    fclose($tempFile);

    // Replace the original file with the temporary file
    rename($tempFilePath, $blogFilePath);

    // Respond with a success message
    echo "Blog post added successfully!";
} else {
    // Respond with an error message or redirect to an error page
    echo "Blog post not added. Please try again.";
}
?>

