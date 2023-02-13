<?php
// class 1
add_shortcode('add_activities', 'add_activities');
function add_activities()
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
    $table_name = $wpdb->prefix . 'activities';

    // add activities row
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        // $current_day = $_POST['current_day'.];
        $arrive_time = $_POST['arrive_time'];
        $m1 = $_POST['m1'];
 

        // mysql add query
        $sql = "INSERT INTO $table_name (fullname, current_day, arrive_time, m1) 
        values('$fullname', CURDATE(), '$arrive_time','$m1'
        )";
        $result = $wpdb->query($sql);

        if ($result) {
            echo "Data added successfully";
            wp_redirect(site_url() . '/activities/');
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
<h1>ADD ACTIVITY FORM</h1>
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

    $output .= '
    <label for="fullname">Select name from the Details Table</label>
    ';
    // select all fullnames from details table.
    $results = $wpdb->get_results("SELECT `fullname` FROM `wp_student_details`");
    $output .= '<select id="fullname" name="fullname" required>';
    foreach ($results as $result) {
        $output .= '<option class="fullname" id="fullname" name="fullname">' . $result->fullname . '</option>';
    }
    $output .= '</select>';

    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="arrive_time">Arrival Time</label>
    <!-- INPUT-->
    <div class="col-sm-6">
    <input type="time" id="arrive_time" name="arrive_time"  placeholder="Enter arrive_time" required>
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m1" name="m1">
    <option value="Happy" >Happy</option>
    <option value="Sad" >Sad</option>
    <option value="Angry" >Angry</option>
    <option value="Excited" >Excited</option>
    <option value="Bored" >Bored</option>
    <option value="Tired" >Tired</option>
    <option value="Playfull" >Playfull</option>
    <option value="Calm" >Calm</option>
    <option value="Confused" >Confused</option>
    <option value="Upset" >Upset</option>
    <option value="Cheerful" >Cheerful</option>
    <option value="Reflective" >Reflective</option>
    <option value="Gloomy" >Gloomy</option>
    <option value="Humorous" >Humorous</option>
    <option value="Romantic" >Romantic</option>
    </select>
    </div>
    </div>
    </div>
    </p>';
   
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
