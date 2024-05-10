<?php 
/*
Plugin Name : trinity-library-management
Plugin URI : https://your-website.com
Description : This a books management system. A wordpress plugin for managing books, students, and borrowing in trinity library.
Version : 1.0
Author : Kumar Indrajeet Jha
Author URI: https://your-website.com
License : GPL v2 or later
License URI: https://wwww.gnu.org/licenses/gpl-2.0.htmlentities
Text Domain: trinity-library-Management
*/

register_activation_hook( __FILE__, 'trinity_library_management_activate' );
register_deactivation_hook( __FILE__, 'trinity_library_management_deactivate' );

function trinity_library_management_activate(){
	global $wpdb;
	require_once ABSPATH.'wp-admin/includes/upgrade.php';
	$charset_collate = $wpdb->get_charset_collate();
	
	// Create books table
	
	$sql_books = "CREATE TABLE".$wpdb->prefix."books(
		book_id INT AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(255) NOT NULL,
		author VARCHAR(255) NOT NULL,
		isbn VARCHAR(20) NOT NULL,
		quantity_available INT DEFAULT 0,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) $charset_collate;";
	
	// CREATE Students table
	$sql_students = "CREATE TABLE".$wpdb->prefix."students(
		student_id INT AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(255) NOT NULL,
		student_id_number VARCHAR(20) NOT NULL,
		contact_info VARCHAR(255),
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) $charset_collate;";
		
	// CREATE Borrowed table
	$sql_students = "CREATE TABLE".$wpdb->prefix."borrowed_books(
		borrow_id INT AUTO_INCREMENT PRIMARY KEY,
		book_id INT NOT NULL,
		student_id_number VARCHAR(20) NOT NULL,
		borrow_date DATE NOT NULL,
		return_date DATE,
		is_returned BOOLEAN DEFAULT 0,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (book_id) REFERENCES".$wpdb->prefix."books(book_id),
		FOREIGN KEY (student_id) REFERENCES".$wpdb->prefix."students(student_id)
		) $charset_collate;";
		
	// CREATE Borrowed table
	$sql_students = "CREATE TABLE".$wpdb->prefix."notes(
		note_id INT AUTO_INCREMENT PRIMARY KEY,
		student_id_number VARCHAR(20) NOT NULL,
		note_description TEXT,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (student_id) REFERENCES".$wpdb->prefix."students(student_id)
		) $charset_collate;";
		
	dbDelta($sql_books);
	dbDelta($sql_students);
	dbDelta($sql_borrowed_books);
	dbDelta($sql_notes);
	
	// Include necessary files
	require_once plugin_dir_path(_FILE_).'includes/book-functions.php';
	
	require_once plugin_dir_path(_FILE_).'includes/student-functions.php';
	
	
	// Add admin menu
	add_action('admin_menu', 'trinity_library_management_menu');
	
	function trinity_library_management_menu(){
		add_menu_page(
			'Library Management',
			'Library management',
			'Manage_options',
			'trinity-library-management',
			'trinity_library_management_page',
			'dashicons-book-alt',
		);
	}
	
	// Admin page callback
	function trinity_library_management_page() {
		?>
		<div class="wrap">
			<h1> library management</h1>
			<p> Welcome to Trinity Library management system.</p>
		</div>
		<?php
	}
	
}
function trinity_library_management_deactivate(){}

?>