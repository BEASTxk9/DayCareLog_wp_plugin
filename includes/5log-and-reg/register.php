<?php
// admin
add_shortcode('register_admin_form', 'register_admin');
function register_admin()
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
    $admin = $wpdb->prefix . 'admin';
    $users = $wpdb->prefix . 'user_login';

    // add activities row
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact_number = $_POST['contact_number'];

        // mysql add query
        $sql = "insert into $admin (fullname, email, contact_number, role, password) values('$fullname', '$email', '$contact_number', 'admin', 'admin')";
        $sql2 = "insert into $users (email, role, password) values('$email', 'admin', 'admin')";

        $result = $wpdb->query($sql);
        $result .= $wpdb->query($sql2);

        if ($result) {
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
<h1>ADD ADMIN FORM</h1>
</div>
</div>
</div>
';

    $output .= '
<div class="container">
<div class="row justify-content-center">
<div class="col-sm-8 col-md-6">
';

    // ADD ADMIN FORM
    $output .= '<form method="post">';


    $output .= '<p><label for="fullname">Full Name</label>
    <input type="text" id="fullname" name="fullname" required>
    </p>';
    // email
    $output .= '<p>
       <label for="email">Email</label>
       <input type="email" id="email" name="email"  required>
       </p>';
    // contact_number
    $output .= '<p class="pt-2">
    <label for="current_day">Contact Number</label>
    <input type="number" id="contact_number" name="contact_number" maxlength="9" required>
    </p>';

    // submit btn
    $output .= '
<div class="container">
<div class="row justify-content-center ">
<div class="col-sm-5 pt-3">
<input class="submit-btn px-5" type="submit" name="submit" value="Add Activity">
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

input, select, textarea{
border: 1px solid black !important;
}
  </style>';

    // ____________________________________________________________________________
    return $output;
}

// teacher
add_shortcode('register_teacher_form', 'register_teacher');
function register_teacher()
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
    $teachers = $wpdb->prefix . 'teachers';
    $users = $wpdb->prefix . 'users';

    // add activities row
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact_number = $_POST['contact_number'];
        $class = $_POST['class'];



        // mysql add query
        $sql = "insert into $teachers (fullname, email, contact_number, role, class, password) values('$fullname', '$email', '$contact_number', 'teacher', '$class', 'teacher' )";
        $sql2 = "insert into $users (email, role, password) values('$email', 'teacher', 'teacher' )";

        $result = $wpdb->query($sql);
        $result .= $wpdb->query($sql2);

        if ($result) {
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
<h1>ADD TEACHER FORM</h1>
</div>
</div>
</div>
';

    $output .= '
<div class="container">
<div class="row justify-content-center">
<div class="col-sm-8 col-md-6">
';

    $output .= '<form method="post">';


    $output .= '<p><label for="fullname">Full Name</label>
    <input type="text" id="fullname" name="fullname" required>
    </p>';
    // email
    $output .= '<p>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        </p>';
    // contact_number
    $output .= '<p class="pt-2">
    <label for="current_day">Contact Number</label>
    <input type="number" id="contact_number" name="contact_number" maxlength="9" required>
    </p>';

    // class
    $output .= '<p>
    <label for="class">class</label>
    
    <select id="class" name="class" required>
    <option value="C1">C1</option>
    <option value="C2">C2</option>
    </select>
    </p>';

    // submit btn
    $output .= '
<div class="container">
<div class="row justify-content-center ">
<div class="col-sm-5 pt-3">
<input class="submit-btn px-5" type="submit" name="submit" value="Add Activity">
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

input, select, textarea{
border: 1px solid black !important;
}
  </style>';

    // ____________________________________________________________________________
    return $output;
}