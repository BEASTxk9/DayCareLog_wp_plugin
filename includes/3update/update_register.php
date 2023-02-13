<?php
// ADMIN
add_shortcode('update_admin', 'admin_update');
function admin_update($id)
{
    // ____________________________________________________________________________    
// connect to database.
    global $wpdb;

    // check connection
    if (!$wpdb) {
        $wpdb->show_errors();
    }

    // ____________________________________________________________________________    
    // Set table name that is being called
    $table_name = $wpdb->prefix . 'admin';

    // Get the id from the URL
    $id = $_GET['id'];

    // SQL query to retrieve data from the table
    $admin = $wpdb->get_row("SELECT * FROM $table_name WHERE id=$id");

    // ____________________________________________________________________________    
    // Update activities
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact_number = $_POST['contact_number'];
        $role = $_POST['role'];
        $password = $_POST['password'];





        // update mysql query
        $sql = "UPDATE $table_name set fullname='$fullname', contact_number='$contact_number', email='$email', role='$role', password='$password' where id=$id";
        $result = $wpdb->query($sql);

        if ($result) {
            // doesnt work idk why / works idk why
            wp_redirect(site_url() . '/admin/');
            exit;
        } else {
            die(mysqli_error($wpdb));
        }

    }

    // ____________________________________________________________________________    
// HTML DISPLAY

    // external links
    $output = '
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  ';

    //   header
    $output .= '
<div class="container mb-5">
<div class="row justify-content-center">
<div class="col-sm-8 col-md-6">
<h1>UPDATE PARENT FORM</h1>
</div>
</div>
</div>
';

    $output .= '
<div class="container">
<div class="row justify-content-center">
<div class="col-sm-8 col-md-6">
';
    // update form
    $output .= '<form method="post">';
    $output .= '<input type="hidden" name="id" value="' . $admin->id . '">';
    // name
    $output .= '
    <p>
    <label for="fullname">Name</label>
    <input type="text" id="fullname" name="fullname" value="' . $admin->fullname . '">
    </p>';

    // email
    $output .= '
    <p>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="' . $admin->email . '">
    </p>';

    // contact_number
    $output .= '
    <p>
    <label for="contact_number">Contact Number</label>
    <input type="text" id="contact_number" name="contact_number" value="' . $admin->contact_number . '">
    </p>';

    // role
    $output .= '
    <p>
    <label for="role">role</label>
    <input type="text" id="role" name="role" value="' . $admin->role . '">
    </p>';

    // password
    $output .= '
    <p>
    <label for="password">password </label>
    <input type="text" id="password" name="password" value="' . $admin->password . '">
    </p>';




    // submit btn
    $output .= '
    <div class="container">
    <div class="row justify-content-center ">
    <div class="col-sm-5 pt-3">
    <input class="submit-btn px-5" type="submit" name="submit" value="Update">
    <div>
    </div>
    </div>';

    $output .= '</form>';

    $output .= '
    </div>
    </div>
    </div>
    ';

    //  custon css
    $output .= '<style>
  label{
    font-weight: 500;
}


.submit-btn{
    background-color: black;
    color: white;
    width: 14vw;
}
.submit-btn:hover{
    background-color: black;
}

input{
border: 1px solid black !important;
}

  </style>';


    // ____________________________________________________________________________  
    return $output;

}

// TEACHER
add_shortcode('update_teachers', 'teacher_update');
function teacher_update($id)
{
    // ____________________________________________________________________________    
// connect to database.
    global $wpdb;

    // check connection
    if (!$wpdb) {
        $wpdb->show_errors();
    }

    // ____________________________________________________________________________    
    // Set table name that is being called
    $table_name = $wpdb->prefix . 'teachers';

    // Get the id from the URL
    $id = $_GET['id'];

    // SQL query to retrieve data from the table
    $teacher = $wpdb->get_row("SELECT * FROM $table_name WHERE id=$id");

    // ____________________________________________________________________________    
    // Update activities
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact_number = $_POST['contact_number'];
        $role = $_POST['role'];
        $password = $_POST['password'];





        // update mysql query
        $sql = "UPDATE $table_name set fullname='$fullname', contact_number='$contact_number', email='$email', role='$role', password='$password' where id=$id";
        $result = $wpdb->query($sql);

        if ($result) {
            // doesnt work idk why / works idk why
            wp_redirect(site_url() . '/teachers/');
            exit;
        } else {
            die(mysqli_error($wpdb));
        }

    }

    // ____________________________________________________________________________    
// HTML DISPLAY

    // external links
    $output = '
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  ';

    //   header
    $output .= '
<div class="container mb-5">
<div class="row justify-content-center">
<div class="col-sm-8 col-md-6">
<h1>UPDATE PARENT FORM</h1>
</div>
</div>
</div>
';

    $output .= '
<div class="container">
<div class="row justify-content-center">
<div class="col-sm-8 col-md-6">
';
    // update form
    $output .= '<form method="post">';
    $output .= '<input type="hidden" name="id" value="' . $teacher->id . '">';
    // name
    $output .= '
    <p>
    <label for="fullname">Name</label>
    <input type="text" id="fullname" name="fullname" value="' . $teacher->fullname . '">
    </p>';
    // email
    $output .= '
    <p>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="' . $teacher->email . '">
    </p>';

    // contact_number
    $output .= '
    <p>
    <label for="contact_number">Contact Number</label>
    <input type="text" id="contact_number" name="contact_number" value="' . $teacher->contact_number . '">
    </p>';


    // role
    $output .= '
<p>
<label for="role">role</label>
<input type="text" id="role" name="role" value="' . $teacher->role . '">
</p>';

    // password
    $output .= '
<p>
<label for="password">password </label>
<input type="text" id="password" name="password" value="' . $teacher->password . '">
</p>';

    // submit btn
    $output .= '
    <div class="container">
    <div class="row justify-content-center ">
    <div class="col-sm-5 pt-3">
    <input class="submit-btn px-5" type="submit" name="submit" value="Update">
    <div>
    </div>
    </div>';

    $output .= '</form>';

    $output .= '
    </div>
    </div>
    </div>
    ';

    //  custon css
    $output .= '<style>
  label{
    font-weight: 500;
}


.submit-btn{
    background-color: black;
    color: white;
    width: 14vw;
}
.submit-btn:hover{
    background-color: black;
}

input{
border: 1px solid black !important;
}

  </style>';


    // ____________________________________________________________________________  
    return $output;

}


?>