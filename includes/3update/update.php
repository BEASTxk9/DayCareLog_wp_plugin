<?php
// PARENTS
add_shortcode('update_parents', 'parent_update');
// Create the update function in the plugin file
function parent_update($id)
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
    $table_name = $wpdb->prefix . 'parents';

    // Get the id from the URL
    $id = $_GET['id'];

    // SQL query to retrieve data from the table
    $parent = $wpdb->get_row("SELECT * FROM $table_name WHERE id=$id");

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
            wp_redirect(site_url() . '/parents/');
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
    $output .= '<input type="hidden" name="id" value="' . $parent->id . '">';
    // name
    $output .= '
    <p>
    <label for="fullname">Name<a class="px-1" href="' . site_url() . '/details/">(*YOU CAN ONLY UPDATE Parent Name ON THE DETAILS TABLE *)</a></label>
    <input type="text"  readonly="readonly" id="fullname" name="fullname" value="' . $parent->fullname . '">
    </p>';
    // email
    $output .= '
    <p>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="' . $parent->email . '">
    </p>';

    // contact_number
    $output .= '
    <p>
    <label for="contact_number">Contact Number</label>
    <input type="text" id="contact_number" name="contact_number" value="' . $parent->contact_number . '">
    </p>';
    // role
    $output .= '
    <p>
    <label for="role">role</label>
    <input type="text" id="role" name="role" value="' . $parent->role . '">
    </p>';
    // password
    $output .= '
    <p>
    <label for="password">password</label>
    <input type="text" id="password" name="password" value="' . $parent->password . '">
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


// DETAILS
add_shortcode('update_details', 'student_details_update');
// Create the update function in the plugin file
function student_details_update($id)
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


    // Get the id from the URL
    $id = $_GET['id'];

    // SQL query to retrieve data from the table
    $student_details = $wpdb->get_row("SELECT * FROM $details WHERE id=$id");

    // ____________________________________________________________________________    
    // Update details
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $img = $_POST['img'];
        $dob = $_POST['dob'];
        $parent_name = $_POST['parent_name'];
        $parent_email = $_POST['parent_email'];
        $parent_number = $_POST['parent_number'];
        $allergies = $_POST['allergies'];
        $class = $_POST['class'];

        // update mysql query
        $sql = "UPDATE $details set fullname='$fullname', img='$img', dob='$dob', parent_name='$parent_name', parent_email='$parent_email', parent_number='$parent_number', allergies='$allergies', class='$class' where id=$id";
        $sql2 = "UPDATE $parents set fullname='$parent_name', email='$parent_email', contact_number='$parent_number' where fullname=$parent_name, email=$parent_email, contact_number=$parent_number";

        // mysql add query
        $result = $wpdb->query($sql);
        $result .= $wpdb->query($sql2);

        if ($result) {
            // doesnt work idk why / works idk why
            wp_redirect(site_url() . '/details/');
            exit;


        }
        // else {
        //     die(mysqli_error($wpdb));
        // }

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
<h1>UPDATE DETAILS FORM</h1>
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
    $output .= '<input type="hidden" name="id" value="' . $student_details->id . '">';
    $output .= '<p>
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" value="' . $student_details->fullname . '">
    </p>';
    $output .= '<p>
    <label for="img">Image:</label>
    <input type="text" id="img" name="img" value="' . $student_details->img . '">
    </p>';

    $output .= '<p>
    <label for="dob">DOB:</label>
    <input type="date" id="dob" name="dob" value="' . $student_details->dob . '">
    </p>';

    $output .= '<p>
    <label for="parent_name">Parent Name:</label>
    <input type="text" id="parent_name" name="parent_name" value="' . $student_details->parent_name . '">
    </p>';

    $output .= '<p>
    <label for="parent_email">Parent Email:</label>
    <input type="email" id="parent_email" name="parent_email" value="' . $student_details->parent_email . '">
    </p>';

    $output .= '<p>
    <label for="parent_number">Parent Number:</label>
    <input type="number" id="parent_number" name="parent_number" maxlength="10" value="' . $student_details->parent_number . '">
    </p>';

    $output .= '<p>
    <label for="allergies">Allergies:</label>
    <input type="text" id="allergies" name="allergies" value="' . $student_details->allergies . '">
    </p>';

    $output .= '<p><label for="class">Class</label>
    <select id="class" name="class">
    <option value="' . $student_details->class . '">' . $student_details->class . '</option>
    <option vlaue="C1">C1</option>
    <option vlaue="C2">C2</option>
    </select>
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


// ACTIVITIES
add_shortcode('update_activities', 'activities_update');
// Create the update function in the plugin file
function activities_update($id)
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

    // Get the id from the URL
    $id = $_GET['id'];

    // SQL query to retrieve data from the table
    $activities = $wpdb->get_row("SELECT * FROM $table_name WHERE id=$id");

    // ____________________________________________________________________________    
    // Update activities
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $arrive_time = $_POST['arrive_time'];
        $play_time = $_POST['play_time'];
        $first_break_time = $_POST['first_break_time'];
        $nap_time = $_POST['nap_time'];
        $lunch_time = $_POST['lunch_time'];
        $lunch_food = $_POST['lunch_food'];
        $movie_time = $_POST['movie_time'];
        $second_break_time = $_POST['second_break_time'];
        $story_time = $_POST['story_time'];
        $departure_time = $_POST['departure_time'];
        $mood = $_POST['mood'];
        $injury = $_POST['injury'];
        $comment = $_POST['comment'];

        // update mysql query
        $sql = "UPDATE $table_name SET fullname='$fullname', arrive_time='$arrive_time', play_time='$play_time', first_break_time='$first_break_time', nap_time='$nap_time', lunch_time='$lunch_time', lunch_food='$lunch_food', movie_time='$movie_time', second_break_time='$second_break_time', story_time='$story_time', departure_time='$departure_time', mood='$mood', injury='$injury', comment='$comment' where id=$id";
        $result = $wpdb->query($sql);

        if ($result) {
            // doesnt work idk why / works idk why
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
<h1>UPDATE ACTIVITY FORM</h1>
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
    $output .= '<input type="hidden" name="id" value="' . $activities->id . '">';
    // name
    $output .= '
    <p>
    <label for="fullname">Name<a class="px-1" href="' . site_url() . '/details/">(*YOU CAN ONLY UPDATE FULL NAME ON THE DETAILS TABLE *)</a></label>
    <input type="text"  readonly="readonly" id="fullname" name="fullname" value="' . $activities->fullname . '">
    </p>';

    //  arrive time
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="arrive_time">Arrival Time</label>
    <!-- INPUT-->
    <div class="col-sm-6">
    <input type="time" id="arrive_time" name="arrive_time" value="' . $activities->arrive_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m1" name="m1">
    <option  value="' . $activities->m1 . '">' . $activities->m1 . '</option>
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

    // play time
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="play_time">Play Time</label>
    <!-- INPUT-->
    <div class="col-sm-6">
    <input type="time" id="play_time" name="play_time" value="' . $activities->play_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m2" name="m2">
    <option  value="' . $activities->m2 . '">' . $activities->m2 . '</option>
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

    // 1st break
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="first_break_time">1st Break</label>
    <!-- INPUT-->
    <div class="col-sm-6">
        <input type="time" id="first_break_time" name="first_break_time" value="' . $activities->first_break_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m3" name="m3">
    <option  value="' . $activities->m3 . '">' . $activities->m3 . '</option>
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

    // nap time
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="nap_time">Nap Time</label>
    <!-- INPUT-->
    <div class="col-sm-6">        
    <input type="time" id="nap_time" name="nap_time" value="' . $activities->nap_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m4" name="m4">
    <option  value="' . $activities->m4 . '">' . $activities->m4 . '</option>
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


    // lunch time
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="arrive_time">Mood at lunch time</label>
    <!-- INPUT-->
    <div class="col-sm-6">        
    <input type="time" id="arrive_time" name="arrive_time" value="' . $activities->arrive_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m5" name="m5">
    <option  value="' . $activities->m5 . '">' . $activities->m5 . '</option>
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

    // lunch food
    $output .= '<p>
         <label for="lunch_food">Lunch Food</label>      
    <input type="text" id="lunch_food" name="lunch_food" value="' . $activities->lunch_food . '">
    </p>';

    // movie time
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="movie_time">Movie Time</label>
    <!-- INPUT-->
    <div class="col-sm-6">         

    <input type="time" id="movie_time" name="movie_time" value="' . $activities->movie_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m6" name="m6">
    <option  value="' . $activities->m6 . '">' . $activities->m6 . '</option>
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

    // 2nd break
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="second_break_time">2nd Break</label>
    <!-- INPUT-->
    <div class="col-sm-6">         
    <input type="time" id="second_break_time" name="second_break_time" value="' . $activities->second_break_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m7" name="m7">
    <option  value="' . $activities->m7 . '">' . $activities->m7 . '</option>
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


    // story time
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="story_time">Story Time</label>
    <!-- INPUT-->
    <div class="col-sm-6">         
        <input type="time" id="story_time" name="story_time" value="' . $activities->story_time . '">
    </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="m8" name="m8">
    <option  value="' . $activities->m8 . '">' . $activities->m8 . '</option>
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

    // departure time
    $output .= '<p>
   
    <div class="container">
    <div class="row justify-content-center text-center">
    <label for="departure_time">Departure Time</label>
    <!-- INPUT-->
    <div class="col-sm-6">         
    <input type="time" id="departure_time" name="departure_time" value="' . $activities->departure_time . '">
       </div>
    <!-- SELECT MOOD-->
    <div class="col-sm-6">
    <select id="mood" name="mood">
    <option  value="' . $activities->mood . '">' . $activities->mood . '</option>
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

    // injury
    $output .= '
    <p>
    <label for="injury">Injury</label>
    <input type="text" id="injury" name="injury" value="' . $activities->injury . '">
    </p>';
    // comment
    $output .= '
    <p>
    <label for="comment">Comment</label>
    <input type="text" id="comment" name="comment" value="' . $activities->comment . '">
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