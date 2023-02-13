<?php
// Register the shortcode
add_shortcode('display_parents', 'wp_Parents_shortcode');

// shortcode function
function wp_Parents_shortcode(){

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

  // SQL query to retrieve data from the table
  $parents = $wpdb->get_results("SELECT * FROM $table_name");

  // ____________________________________________________________________________
// HTML DISPLAY

  // open section
  $output = '<section id="admin-table">';

  // external links
  $output .= '
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  ';

  // DETAILS TABLE HEAD
  $output .= '<table class="student-details-table table table-bordered">';
  $output .= '<thead>';
  $output .= '<tr>';
  $output .= '<th>ID</th>';
  $output .= '<th>Fullname</th>';
  $output .= '<th>email</th>';
  $output .= '<th>contact_numbers</th>';
  $output .= '<th>operator</th>';
  $output .= '<tr>';
  $output .= '</thead>';

  // DETAILS TABLE BODY
  $output .= '<tbody>';
  // for each
  foreach ($parents as $parents) {
    $output .= '<tr>';
    $output .= '<td>' . $parents->id . '</td>';
    $output .= '<td>' . $parents->fullname . '</td>';
    $output .= '<td>' . $parents->email . '</td>';
    $output .= '<td>' . $parents->contact_number . '</td>';
  
    // OPERATORS
    $output .= '<td>
<!-- UPDATE BUTTON -->
<a href="' . '/update_parents/?page=wp_parents&action=parent_update&id=' . $parents->id . '" class="button-update btn my-2">Update</a>

<!-- DELETE BUTTON -->
<a href="' . admin_url('delete.php?page=wp_parents&action=delete(P)&id=' . $parents->id) . '" class="button-delete btn">Delete</a>


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
    width: 10vw;
        }
        
        .button-delete, .button-add{
    background: #ebebeb;
    color: black;
    box-shadow: 8px 2px 20px rgba(0, 0, 0, 0.4);
    width: 10vw;
        }

        .button-update:hover{
          color: white;
        }


  </style>';

  // ____________________________________________________________________________
  // Return the table html
  return $output;
}


?>