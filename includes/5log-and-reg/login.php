<?php

add_shortcode('login_form', 'process_login');
// Function to process the login form
function process_login()
{
  global $wpdb;

  // Set table name that is being called
  $table_name = $wpdb->prefix . 'users';

  // Check if the form is submitted
  if (isset($_POST['submit'])) {
    // Sanitize the user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // mySQL query
    $sql = "SELECT * FROM $table_name WHERE email = '$email' AND password = '$password'; ";
    $result = $wpdb->query($sql);
    // SELECT ROLE IF EMAIL AND PASSWORD IS CORRECT
    $users = $wpdb->get_results("SELECT role FROM $table_name WHERE email = '$email' AND password = '$password'; ");

    // If the query returns a result, the login is successful
    if ($result > 0) {
      session_start();
      $_SESSION['logged_in'] = true;

      foreach ($users as $user) {

        if ($user->role == 'parent') {
          echo 'parent logged in';
        } else if ($user->role == 'teacher') {
          echo 'teacher logged in';
          wp_redirect(site_url() .'/teachers/');
          exit;
        } else if ($user->role == 'admin') {
          echo 'admin logged in';
        } else {
          echo 'shi dont work';
        }
      }

    } else {
      // If the query returns no results, the login is unsuccessful
      $error = "Incorrect fullname or password. Please try again.";
    }
  }

  $output = '<h1>Parents Login</h1>';

  // <!-- Display an error message if the login is unsuccessful -->
  if (isset($error)) {
    $output .= '<b>' . $error . '</b>';
  }


  $output .= '
    <!-- HTML code for the login form -->
<form action="" method="post">
  <label for="email">email:</label>
  <input type="text" id="email" name="email" required>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>
  <input type="submit" value="Login" name="submit">
</form>
    ';

  return $output;
}

// Call the process_login function
process_login();






?>