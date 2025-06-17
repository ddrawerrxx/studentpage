<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['user_id']) || !isset($_POST['book_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = $_POST['book_id'];
$borrow_date = date('Y-m-d');
$due_date = date('Y-m-d', strtotime('+7 days')); // 7-day loan period

// Insert borrow record
$stmt = $conn->prepare("INSERT INTO borrowed_books (user_id, book_id, borrow_date, due_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $user_id, $book_id, $borrow_date, $due_date);
$stmt->execute();

header("Location: Book-Details.php");
exit();
