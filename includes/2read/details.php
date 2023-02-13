<?php

// Register the shortcode
add_shortcode('display_student_details', 'display_student_details_shortcode');

// shortcode function
function display_student_details_shortcode(){

  // ____________________________________________________________________________
// connect to database.
  global $wpdb;

  // check connection
  if (!$wpdb) {
    $wpdb->show_errors();
  }


  // ____________________________________________________________________________
  // Set table name that is being called
  $table_name = $wpdb->prefix . 'student_details';


  // SQL query to retrieve data from the table
  $student_details = $wpdb->get_results("SELECT * FROM $table_name");
// ____________________________________________________________________________
// HTML DISPLAY

 // ADD DETAILS BUTTON
 $output = '
 <div class="container">
 <div class="row">
 <div class="col-sm-3">
 <a href="'. site_url() .'/add_details/" class="btn button-add my-3">Add Details</a>
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
  $output .= '<th>Name</th>';
  $output .= '<th>Image</th>';
  $output .= '<th>DOB</th>';
  $output .= '<th>Parent Name</th>';
  $output .= '<th>Parent Email</th>';
  $output .= '<th>Parent Number</th>';
  $output .= '<th>Allergies</th>';
  $output .= '<th>Class</th>';
  $output .= '<th>Operators</th>';
  $output .= '</thead>';

  // DETAILS TABLE BODY
  $output .= '<tbody>';
  // for each
  foreach ($student_details as $student) {
    $output .= '<tr>';
    $output .= '<td>' . $student->id . '</td>';
    $output .= '<td>' . $student->fullname . '</td>';
    $output .= '<td><img id="student-img" src="' . $student->img . '" alt="' . $student->fullname . '" /></td>';
    $output .= '<td>' . $student->dob . '</td>';
    $output .= '<td>' . $student->parent_name . '</td>';
    $output .= '<td>' . $student->parent_email . '</td>';
    $output .= '<td>' . $student->parent_number . '</td>';
    $output .= '<td>' . $student->allergies . '</td>';
    $output .= '<td>' . $student->class . '</td>';
    // OPERATORS
    $output .= '<td>
<!-- UPDATE BUTTON -->
<a href="' . '/update_details/?page=student-details&action=update_details&id=' . $student->id . '" class="button-update btn my-2">Update</a>

<!-- DELETE BUTTON -->
<a href="' . admin_url('./4delete/delete.php?page=student-details&action=delete(D)&id=' . $student->id) . '" class="button-delete btn">Delete</a>


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

  #student-img{
    height: 30%;
    width: 30%;
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
          color: white;
        }


  </style>';

  // ____________________________________________________________________________
  // Return the table html
  return $output;
}