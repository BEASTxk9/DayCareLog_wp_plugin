<?php

// Register the shortcode
add_shortcode('display_teachers', 'wp_Teachers_shortcode');

// shortcode function
function wp_Teachers_shortcode(){

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

  // SQL query to retrieve data from the table
  $teachers = $wpdb->get_results("SELECT * FROM $table_name");

  // ____________________________________________________________________________
// HTML DISPLAY

 // ADD TEACHERS BUTTON
 $output = '
 <div class="container">
 <div class="row">
 <div class="col-sm-3">
 <a href="'. site_url() .'/register_teacher/" class="btn button-add my-3">Register Teacher</a>
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

  ';

  // DETAILS TABLE HEAD
  $output .= '<table class="student-details-table table table-bordered">';
  $output .= '<thead>';
  $output .= '<th>ID</th>';
  $output .= '<th>fullname</th>';
  $output .= '<th>Email</th>';
  $output .= '<th>Contact</th>';
  $output .= '<th>Class</th>';
  $output .= '<th>Operators</th>';
  $output .= '</thead>';

  // DETAILS TABLE BODY
  $output .= '<tbody>';
  // for each
  foreach ($teachers as $teacher) {
    $output .= '<tr>';
    $output .= '<td>' . $teacher->id . '</td>';
    $output .= '<td>' . $teacher->fullname . '</td>';
    $output .= '<td>' . $teacher->email . '</td>';
    $output .= '<td>0' . $teacher->contact_number . '</td>';
    $output .= '<td>' . $teacher->class . '</td>';
    // OPERATORS
    $output .= '<td>
<!-- UPDATE BUTTON -->
<a href="' . '/update_teachers/?page=wp_teachers&action=update_teachers&id=' . $teacher->id . '" class="button-update btn my-2">Update</a>

<!-- DELETE BUTTON -->
<a href="' . admin_url('./4delete/delete.php?page=wp_teachers&action=delete(T)&id=' . $teacher->id) . '" class="button-delete btn">Delete</a>


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
    width: 12vw;
        }
        
        .button-delete, .button-add{
    background: #ebebeb;
    color: black;
    box-shadow: 8px 2px 20px rgba(0, 0, 0, 0.4);
    width: 12vw;
        }

        .button-update:hover{
          color: white;
        }


  </style>';

  // ____________________________________________________________________________
  // Return the table html
  return $output;
}
