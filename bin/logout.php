<?php
// Destroy the session
session_unset(); // Unset all session variables

// Redirect to the login page or any desired page after logout
echo '<script>window.location.href = "index.php";</script>';

exit();


?>