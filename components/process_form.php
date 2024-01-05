<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // Email settings
  $recipient = "your_email@example.com"; //Remember to put your correct email address here!
  $subject = "New contact message from $name";
  $message_body = "Name: $name\n";
  $message_body .= "Email: $email\n";
  $message_body .= "Message:\n$message";

  // Send email
  if (mail($recipient, $subject, $message_body)) {
    echo "<script>
                alert('Message sent successfully!');
                setTimeout(function(){ window.location.href = '../index.php'; }, 1000);
              </script>";
  } else {
    echo "<script>
                alert('Error sending the message.');
                setTimeout(function(){ window.location.href = '../index.php'; }, 1000);
              </script>";
  }
} else {
  echo "<script>
            alert('Error in the request method.');
            setTimeout(function(){ window.location.href = '../index.php'; }, 1000);
          </script>";
}
?>