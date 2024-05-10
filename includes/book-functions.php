<?php
// ADD Book

function add_book($title, $author, $isbn, $quantity_available){
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix.'books',
		array(
			'title' => $title,
			'author' => $author,
			'isbn' => $isbn,
			'quantity_available' => $quantity_available,
		)
	);
}

// GET All Books
function get_all_books() {
	global $wpdb;
	return $wpdb->get_results("SELECT *FROM".$wpdb->prefix."books",ARRAY_A);
}

// GET Books by ID
function get_all_books_id($book_id) {
	global $wpdb;
	return $wpdb->get_row($wpdb->prepare("SELECT *FROM".$wpdb->prefix."books WHERE book_id = %d", $book_id), ARRAY_A);
}

// Update Books
function update_book($book_id, $title, $author, $isbn, $quantity_available) {
	global $wpdb;
	return $wpdb->update(
		$wpdb->prefix.'books',
		array(
			'title' => $title,
			'author' => $author,
			'isbn' => $isbn,
			'quantity_available' => $quantity_available,
		), array('book_id'=>$book_id)
	);
}

// Delete Book
function delete_book($book_id){
	global $wpdb;
	$wpdb->delete(
		$wpdb->prefix.'books', array('book_id'=>$book_id)
	);
}// GET All Books
function get_all_books() {
	global $wpdb;
	return $wpdb->get_results("SELECT *FROM".$wpdb->prefix."books",ARRAY_A);
}
?>