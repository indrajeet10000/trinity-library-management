<?php
// ADD students

function add_student($name, $student_id_number, $contact_info){
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'students',
		array(
			'name' => $name,
			'student_id_number' => $student_id_number,
			'contact_info' => $contact_info,
		)
	);
}

// GET All students
function get_all_students() {
	global $wpdb;
	return $wpdb->get_results("SELECT *FROM".$wpdb->prefix."students",ARRAY_A);
}

// GET students by ID
function get_all_student_id($student_id) {
	global $wpdb;
	return $wpdb->get_row($wpdb->prepare("SELECT *FROM".$wpdb->prefix."students WHERE student_id = %d", $book_id), ARRAY_A);
}

// Update students
function update_book($book_id, $title, $author, $isbn, $quantity_available) {
	global $wpdb;
	return $wpdb->update(
		$wpdb->prefix.'students',
		array(
			'name' => $name,
			'student_id_number' => $student_id_number,
			'contact_info' => $contact_info,
		), array('student_id'=>$student_id)
	);
}

// Delete Book
function delete_student($student_id){
	global $wpdb;
	$wpdb->delete(
		$wpdb->prefix.'students', array('student_id'=>$student_id)
	);
}
?>