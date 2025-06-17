<?php
include('../dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $book_id = mysqli_real_escape_string($conn, $_POST['isbn']); // still using isbn as book_id
    $due_date = mysqli_real_escape_string($conn, $_POST['date']);
    $borrow_date = date('Y-m-d');
    $return_date = NULL;
    $status = 'pending'; // default status

    // Prevent borrowing same book if still pending or approved
    $check = mysqli_query($conn, "SELECT * FROM borrowed_books 
                                  WHERE user_id = '$user_id' 
                                  AND book_id = '$book_id' 
                                  AND status IN ('pending', 'approved')");

    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('You already requested or borrowed this book.'); history.back();</script>";
        exit;
    }

    $insert = "INSERT INTO borrowed_books 
        (user_id, book_id, borrow_date, due_date, return_date, status)
        VALUES ('$user_id', '$book_id', '$borrow_date', '$due_date', NULL, '$status')";

    if (mysqli_query($conn, $insert)) {
        header("Location: book_read.php?id=$book_id&borrowed=1");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>
