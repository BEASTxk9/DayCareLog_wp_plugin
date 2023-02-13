<?php
add_shortcode('add_details', 'add_student_details');
function add_student_details()
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
    $details = $wpdb->prefix . 'student_details';
    $parents = $wpdb->prefix . 'parents';
    $users = $wpdb->prefix . 'user_login';

    // add details row
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $img = $_POST['img'];
        $dob = $_POST['dob'];
        $parent_name = $_POST['parent_name'];
        $parent_email = $_POST['parent_email'];
        $parent_number = $_POST['parent_number'];
        $allergies = $_POST['allergies'];
        $class = $_POST['class'];

        // mysql add query
        $sql = "insert into $details (fullname,img,dob,parent_name,parent_email,parent_number, allergies,class) values('$fullname','$img','$dob','$parent_name','$parent_email','$parent_number','$allergies','$class');";
        $sql2 = "insert into $parents (fullname,  email, contact_number, role, password) values('$parent_name', '$parent_email','$parent_number', 'parent', 'parent');";
        $sql3 = "insert into $users (email, role, password) values('$parent_email', 'parent', 'parent')";

        $result = $wpdb->query($sql);
        $result .= $wpdb->query($sql2);
        $result .= $wpdb->query($sql3);

        if ($result) {
            echo "Data added successfully";
            wp_redirect(site_url() . '/details/');
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
<h1>ADD DETAILS FORM</h1>
</div>
</div>
</div>
';

    $output .= '
<div class="container">
<div class="row justify-content-center">
<div class="col-sm-8 col-md-6">
';

    // ADD STUDENT FORM
    $output .= '<form method="post">';
    $output .= '<p><label for="fullname">Full Name</label>
    <input required type="text" id="fullname" name="fullname">
    </p>';

    $output .= '<p><label for="img">Image</label>
    <input required type="text" id="img" name="img">
    </p>';

    $output .= '<p><label for="dob">DOB</label>
    <input required type="date" id="dob" name="dob" >
    </p>';

    $output .= '<p><label for="parent_name">Parent Name</label>
    <input required type="text" id="parent_name" name="parent_name">
    </p>';

    $output .= '<p><label for="parent_email">Parent Email</label>
    <input required type="text" id="parent_email" name="parent_email" >
    </p>';
    $output .= '<p><label for="parent_number">Parent Number</label>
    <input required type="text" id="parent_number" name="parent_number" maxlength="9">
    </p>';

    $output .= '<p><label for="allergies">Allergies</label>
    <input required type="text" id="allergies" name="allergies">
    </p>';

    $output .= '<p><label for="class">Class</label>
    <select id="class" name="class" required>
    <option vlaue="C1">C1</option>
    <option vlaue="C2">C2</option>
    </select>
    </p>';

    // submit btn
    $output .= '
<div class="container">
<div class="row justify-content-center ">
<div class="col-sm-5 pt-3">
<input class="submit-btn px-5" type="submit" name="submit" value="Add Details">
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

input, select{
border: 1px solid black !important;
}
  </style>';

    // ____________________________________________________________________________
    return $output;
}

?>