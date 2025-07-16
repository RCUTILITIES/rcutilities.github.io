<?php
// Set the recipient email addresses
$to = "rossmogridge@rcutilities.co.uk, craigjenkins@rcutilities.co.uk";

// Sanitize and validate form input
$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(trim($_POST['phone']));
$message = htmlspecialchars(trim($_POST['message']));

// Basic validation
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    echo "All fields are required.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit;
}

// Compose the email
$subject = "Callback Request from $name";
$body = "You have received a new callback request:\n\n"
      . "Name: $name\n"
      . "Email: $email\n"
      . "Phone: $phone\n\n"
      . "Message:\n$message";

$headers = "From: contact-form@rcutilities.co.uk\r\n";
$headers .= "Reply-To: $email\r\n";

// Attempt to send the email
if (mail($to, $subject, $body, $headers)) {
    // Redirect to thank-you page
    header("Location: thank-you.html");
    exit;
} else {
    echo "Sorry, something went wrong. Please try again.";
}
?>
