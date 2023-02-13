<?php
// _______________________________
// ADMIN
function delete_admin($id)
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
    $table_name = $wpdb->prefix . 'admin';

    // SQL query to delete the row with the specified ID
    $wpdb->delete($table_name, array('id' => $id));

}

// _______________________________
// TEACHER
function delete_teacher($id)
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
    $table_name = $wpdb->prefix . 'teachers';

    // SQL query to delete the row with the specified ID
    $wpdb->delete($table_name, array('id' => $id));
}

// _______________________________
// DETAILS
function delete_student_details($id)
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
    $table_name = $wpdb->prefix . 'student_details';

    // SQL query to delete the row with the specified ID
    $wpdb->delete($table_name, array('id' => $id));

}

// _______________________________
// ACTIVITIES
function delete_activities($id)
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

    // SQL query to delete the row with the specified ID
    $wpdb->delete($table_name, array('id' => $id));
}

// _______________________________
// PARENT
function delete_parent($id)
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
    $table_name = $wpdb->prefix . 'parents';

    // SQL query to delete the row with the specified ID
    $wpdb->delete($table_name, array('id' => $id));
}





// _______________________________
// Call the delete ADMIN function
if (isset($_GET['action']) && $_GET['action'] == 'delete(admin)' && isset($_GET['id'])) {
    delete_admin($_GET['id']);
    // Redirect to the student details page after deletion
    header('location:' . site_url() . '/admin/');
    exit;
}

// Call the delete TEACHER function
if (isset($_GET['action']) && $_GET['action'] == 'delete(T)' && isset($_GET['id'])) {
    delete_teacher($_GET['id']);
    // Redirect to the activities page after deletion
    header('location:' . site_url() . '/teachers/');
    exit;
}
// Call the delete DETAILS function
if (isset($_GET['action']) && $_GET['action'] == 'delete(D)' && isset($_GET['id'])) {
    delete_student_details($_GET['id']);
    // Redirect to the student details page after deletion
    header('location:' . site_url() . '/details/');
    exit;
}
// Call the delete ACTIVITIES function
if (isset($_GET['action']) && $_GET['action'] == 'delete(A)' && isset($_GET['id'])) {
    delete_activities($_GET['id']);
    // Redirect to the activities page after deletion
    header('location:' . site_url() . '/activities/');
    exit;
}
// Call the delete PARENT function
if (isset($_GET['action']) && $_GET['action'] == 'delete(P)' && isset($_GET['id'])) {
    delete_parent($_GET['id']);
    // Redirect to the activities page after deletion
    header('location:' . site_url() . '/parents/');
    exit;
}


?>