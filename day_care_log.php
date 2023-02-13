<?php
/**
 * Day Care Log
 *
 * @package   Day Care Log
 * @author    Shane Stevens, Ismaeel Adams, Joshua Solomons & Sabelo Mdashe :) 
 * @copyright 2023 LCStudio
 *
 * @wordpress-plugin 
 * Plugin Name:Day Care Log
 * Description: This is a WordPress plugin/theme that has an easy to use interface which allows the user access to a log system. Install the "Ultimate Member" plugin inorder to hide pages and assign roles to users.
 * Version: 1.0
 * Author: Shane Stevens, Ismaeel Adams, Joshua Solomons & Sabelo Mdashe :) 
 * License: Free
 */

// _________________________________________
// Call all files into 1 file inorder to activate all functions at once :) 

// _________________________________________
// FUNCTIONS

// 01- login & register
require_once plugin_dir_path(__FILE__) . './includes/5log-and-reg/login.php'; // parent login function
require_once plugin_dir_path(__FILE__) . './includes/5log-and-reg/register.php'; // register a admin and teacher

// 02- delete
require_once plugin_dir_path(__FILE__) . './includes/4delete/delete.php'; // all delete table data functions

// 03- update
require_once plugin_dir_path(__FILE__) . './includes/3update/update_register.php'; // update admin and teacher data function
require_once plugin_dir_path(__FILE__) . './includes/3update/update.php'; // all update table data functions

// 04- create
require_once plugin_dir_path(__FILE__) . './includes/1create/add_activities.php'; // create function
require_once plugin_dir_path(__FILE__) . './includes/1create/add_details.php'; // create function

// _________________________________________
// DISPLAY

// 01- admin table
require_once plugin_dir_path(__FILE__) . './includes/2read/admin.php'; // read function
// 02- teachers table
require_once plugin_dir_path(__FILE__) . './includes/2read/teachers.php'; // read function
// 03- details table
require_once plugin_dir_path(__FILE__) . './includes/2read/details.php'; // read function
// 04- activities
require_once plugin_dir_path(__FILE__) . './includes/2read/activities.php'; // read function
// 05- parents table
require_once plugin_dir_path(__FILE__) . './includes/2read/parents.php'; // read function



// _________________________________________
// CREATE DATABASE TABLES ON ACTIVATING PLUGIN
function create_table_on_activate()
{
	// connect to wordpress database
	global $wpdb;

	// _________________________________________
	// set table names
	$users = $wpdb->prefix . 'user_login';
	$admin = $wpdb->prefix . 'admin';
	$teachers = $wpdb->prefix . 'teachers';
	$details = $wpdb->prefix . 'student_details';
	$parents = $wpdb->prefix . 'parents';
	$activities = $wpdb->prefix . 'activities';

	$charset_collate = $wpdb->get_charset_collate();

	// _________________________________________
// mysql create tables query

	// users
	$sql = "CREATE TABLE $users (
        id INT(10) PRIMARY KEY auto_increment,
		email varchar(100) not null,
        role varchar(50) not null,
		password varchar(20) not null
        ) $charset_collate;";

	// admin
	$sql .= "CREATE TABLE $admin (
        id INT(10) PRIMARY KEY auto_increment,
        fullname varchar(50) not null,
		email varchar(100) not null,
        contact_number INT not null,
        role varchar(50) default 'admin',
		password varchar(20) default 'admin'
        ) $charset_collate;";

	// teachers
	$sql .= "CREATE TABLE $teachers (
        id INT(10) PRIMARY KEY auto_increment,
        fullname varchar(50) not null,
		email varchar(100) not null,
        contact_number INT not null,
        role varchar(50) default 'teacher',
        class varchar(15) not null,
		password varchar(20) default 'teacher'
        ) $charset_collate;";

	// child details
	$sql .= "CREATE TABLE $details (
		id INT(6) PRIMARY KEY AUTO_INCREMENT ,
		fullname VARCHAR(50) NOT NULL,
		img VARCHAR(255) NOT NULL,
		dob DATE NOT NULL,
		parent_name VARCHAR(30) NOT NULL,
		parent_email varchar(50) NOT NULL,
		parent_number VARCHAR(15) NOT NULL,
		allergies VARCHAR(255) NOT NULL,
		class VARCHAR(15) NOT NULL
		)$charset_collate;";


	// parents
	$sql .= "CREATE TABLE $parents (
		id INT(6) PRIMARY KEY auto_increment,
		fullname varchar(50) not null,
		email varchar(100) not null,
		contact_number INT not null,
		role varchar(50) default 'parent', 
		password varchar(50) not null default 'parent'
		)$charset_collate;";


	// activities
	$sql .= "CREATE TABLE $activities (
		id INT(6) PRIMARY KEY AUTO_INCREMENT,
		fullname varchar(50) not null,
		current_day DATE NOT NULL,
		arrive_time TIME NOT NULL,
    	m1 VARCHAR(20) NOT NULL,
		play_time TIME NOT NULL,
	    m2 VARCHAR(20) NOT NULL,
		first_break_time TIME NOT NULL,
	    m3 VARCHAR(20) NOT NULL,
		nap_time TIME NOT NULL,
	    m4 VARCHAR(20) NOT NULL,
		lunch_time TIME NOT NULL,
	    m5 VARCHAR(20) NOT NULL,
		lunch_food VARCHAR(50) NOT NULL,
		movie_time TIME NOT NULL,
	    m6 VARCHAR(20) NOT NULL,
		second_break_time TIME NOT NULL,
    	m7 VARCHAR(20) NOT NULL,
		story_time TIME NOT NULL,
	    m8 VARCHAR(20) NOT NULL,
		departure_time TIME NOT NULL,
		mood VARCHAR(20) NOT NULL,
		injury VARCHAR(255) NOT NULL,
		comment VARCHAR(255)
	)$charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$result = dbDelta($sql);


	if (is_wp_error($result)) {
		echo 'There was an error creating the tables';
		return;
	}

}
register_activation_hook(__FILE__, 'create_table_on_activate');



// _________________________________________
// CREATE PAGE FUNCTION
function create_page($title_of_the_page, $content, $parent_id = NULL)
{
	$objPage = get_page_by_title($title_of_the_page, 'OBJECT', 'page');
	if (!empty($objPage)) {
		// echo "Page already exists:" . $title_of_the_page . "<br/>";
		return $objPage->ID;
	}

	$page_id = wp_insert_post(
		array(
			'comment_status' => 'close',
			'ping_status' => 'close',
			'post_author' => 1,
			'post_title' => ucwords($title_of_the_page),
			'post_name' => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
			'post_status' => 'publish',
			'post_content' => $content,
			'post_type' => 'page',
			'post_parent' => $parent_id //'id_of_the_parent_page_if_it_available'
		)
	);
	echo "Created page_id=" . $page_id . " for page '" . $title_of_the_page . "'<br/>";
	return $page_id;
}

// _________________________________________
// ACTIVATE
function on_activating_your_plugin()
{
	//  create wp pages and add shortcode to the pages automatically

	// _________________________________________
	// login
	// create_page('parent_login', '[login_form]');

	// _________________________________________
// register
	create_page('register_teacher', '[register_teacher_form]');
	create_page('register_admin', '[register_admin_form]');


	// _________________________________________
// display

	create_page('activities', '[display_activities]'); // read wp page
	create_page('details', '[display_student_details]'); // read wp page
	create_page('parents', '[display_parents]'); // read wp page
	create_page('teachers', '[display_teachers]'); // read wp page
	create_page('admin', '[display_admin]'); // read wp page

	// _________________________________________
// create
	create_page('add_activities', '[add_activities]'); // create wp page
	create_page('add_details', '[add_details]'); // create wp page

	// _________________________________________
// update
	create_page('update_activities', '[update_activities]'); // update wp page
	create_page('update_details', '[update_details]'); // update wp page
	create_page('update_parents', '[update_parents]'); // update wp page
	create_page('update_teachers', '[update_teachers]'); // update wp page
	create_page('update_admin', '[update_admin]'); // read wp page


}
register_activation_hook(__FILE__, 'on_activating_your_plugin');


// _________________________________________
// DEACTIVATE
function on_deactivating_your_plugin()
{

	// login & register
	$login_parent = get_page_by_path('parent_login');
	wp_delete_post($login_parent->ID, true);
	$register_teacher = get_page_by_path('register_teacher');
	wp_delete_post($register_teacher->ID, true);
	$register_admin = get_page_by_path('register_admin');
	wp_delete_post($register_admin->ID, true);

	// display
	$teachers = get_page_by_path('teachers');
	wp_delete_post($teachers->ID, true);
	$parents = get_page_by_path('parents');
	wp_delete_post($parents->ID, true);
	$activities = get_page_by_path('activities');
	wp_delete_post($activities->ID, true);
	$details = get_page_by_path('details');
	wp_delete_post($details->ID, true);
	$admin = get_page_by_path('admin');
	wp_delete_post($admin->ID, true);


	// add
	$add_activities = get_page_by_path('add_activities');
	wp_delete_post($add_activities->ID, true);
	$add_details = get_page_by_path('add_details');
	wp_delete_post($add_details->ID, true);

	// update
	$update_activities = get_page_by_path('update_activities');
	wp_delete_post($update_activities->ID, true);
	$update_admin = get_page_by_path('update_admin');
	wp_delete_post($update_admin->ID, true);
	$update_details = get_page_by_path('update_details');
	wp_delete_post($update_details->ID, true);
	$update_parents = get_page_by_path('update_parents');
	wp_delete_post($update_parents->ID, true);
	$update_teachers = get_page_by_path('update_teachers');
	wp_delete_post($update_teachers->ID, true);


}
register_deactivation_hook(__FILE__, 'on_deactivating_your_plugin');





?>