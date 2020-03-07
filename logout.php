
<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: login"); // Redirecting To Home Page
}
?>
