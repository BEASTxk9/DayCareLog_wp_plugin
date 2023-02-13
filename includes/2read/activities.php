<?php

// Register the shortcode
add_shortcode('display_activities', 'display_activities_shortcode');


function display_activities_shortcode()
{
  // ____________________________________________________________________________
  // connect to database.
  global $wpdb;

  // check connection
  if (!$wpdb) {
    $wpdb->show_errors();
  }

  // ____________________________________________________________________________
  // Table name
  $table_name = $wpdb->prefix . 'activities';

  // SQL query to retrieve data from the table
  $activities = $wpdb->get_results("SELECT * FROM $table_name");


  // ____________________________________________________________________________
  // HTML DISPLAY

  // ADD ACTIVITIES BUTTON
  $output = '
  <div class="container">
  <div class="row">
  <div class="col-sm-3">
  <a href="' . site_url() . '/add_activities/" class="btn button-add my-3">Add Activity</a>
  </div>
  </div>
  </div>
  ';

  // open section
  $output .= '<section id="admin-table">';

  // external links
  $output .= '
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  ';

  // ACTIVITIES TABLE HEAD
  $output .= '<table class="student-details-table table table-bordered">';
  $output .= '<thead>';
  $output .= '<tr>';
  $output .= '<th>ID</th>';
  $output .= '<th>Name</th>';
  $output .= '<th>Date</th>';
  $output .= '<th>Arrival Time</th>';
  $output .= '<th>Play Time</th>';
  $output .= '<th>1st Break</th>';
  $output .= '<th>Nap Time</th>';
  $output .= '<th>Lunch Time</th>';
  $output .= '<th>Lunch Food</th>';
  $output .= '<th>Movie Time</th>';
  $output .= '<th>2nd Break</th>';
  $output .= '<th>Story Time</th>';
  $output .= '<th>Departure Time</th>';
  $output .= '<th>Mood</th>';
  $output .= '<th>Injury</th>';
  $output .= '<th>Comment</th>';
  $output .= '<th>Operators</th>';
  $output .= '</tr>';
  $output .= '</thead>';

  // DETAILS TABLE BODY
  $output .= '<tbody>';
  // FOR EACH
  foreach ($activities as $activity) {
    $output .= '<tr>';
    $output .= '<td>' . $activity->id . '</td>';
    $output .= '<td>' . $activity->fullname . '</td>';
    $output .= '<td>' . $activity->current_day . '</td>';
    $output .= '<td>' . substr($activity->arrive_time, 0, -3) . ' <br><hr>Mood:' . $activity->m1 . '</td>';
    $output .= '<td>' . substr($activity->play_time, 0, -3) . ' <br><hr>Mood:' . $activity->m2 . '</td>';
    $output .= '<td>' . substr($activity->first_break_time, 0, -3) . ' <br><hr>Mood:' . $activity->m3 . '</td>';
    $output .= '<td>' . substr($activity->nap_time, 0, -3) . ' <br><hr>Mood:' . $activity->m4 . '</td>';
    $output .= '<td>' . substr($activity->lunch_time, 0, -3) . ' <br><hr>Mood:' . $activity->m5 . '</td>';
    $output .= '<td>' . $activity->lunch_food . ' <br><hr>Mood:' . $activity->m6 . '</td>';
    $output .= '<td>' . substr($activity->movie_time, 0, -3) . ' <br><hr>Mood:' . $activity->m7 . '</td>';
    $output .= '<td>' . substr($activity->second_break_time, 0, -3) . ' <br><hr>Mood:' . $activity->m8 . '</td>';
    $output .= '<td>' . substr($activity->story_time, 0, -3) . ' <br><hr>Mood:' . $activity->mood . '</td>';
    $output .= '<td>' . substr($activity->departure_time, 0, -3) . '</td>';
    $output .= '<td>' . $activity->mood . '</td>';
    $output .= '<td>' . $activity->injury . '</td>';
    $output .= '<td>' . $activity->comment . '</td>';
    // OPERATORS
    $output .= '<td>
    <!-- UPDATE BUTTON -->
<a href="' . '/update_activities/?page=activities&action=update_activities&id=' . $activity->id . '" class="button-update btn my-2">Update</a>

<!-- UPDATE BUTTON -->
<a href="' . admin_url('.4delete/delete.php?page=wp_activities&action=delete(A)&id=' . $activity->id) . '" class="button-delete btn" id="delete">Delete</a>


</td>';

    $output .= '</tr>';
  }
  $output .= '<tbody>';

  // End the table html
  $output .= '</table>';

  // close section
  $output .= '</section>';

  //  custon css
  $output .= '<style>
  label{
    font-weight: 500;
}


    #admin-table{
    border: 1px solid grey;
    max-height: 70vh;
    overflow-x:scroll;
    overflow-y:scroll;
    }

    .button-update{
background: black;
color: white;
box-shadow: 8px 2px 20px rgba(0, 0, 0, 0.4);
width: 14vw;
    }
    .button-delete, .button-add{
background: #ebebeb;
color: black;
box-shadow: 8px 2px 20px rgba(0, 0, 0, 0.4);
width: 14vw;
    }
    

    .button-update:hover{
      background: black;
      color: white;
    }


    </style>';

  // ____________________________________________________________________________
  // Return the table html

  return $output;
}
