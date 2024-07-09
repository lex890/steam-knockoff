<?php

session_start();
include_once 'db_conn.php';

$email = $_SESSION['email'];

// Prepare and execute the SQL statement to get the user ID
$stmt_user = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
    $user_row = $result_user->fetch_assoc();
    $user_id = $user_row['user_id'];

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $game_title) {
            // Prepare and execute the SQL statement to get the game ID
            $stmt_games = $conn->prepare("SELECT game_id FROM games WHERE title = ?");
            $game_title_safe = htmlspecialchars($game_title);
            $stmt_games->bind_param("s", $game_title_safe);
            $stmt_games->execute();
            $result_games = $stmt_games->get_result();

            if ($result_games->num_rows > 0) {
                $game_row = $result_games->fetch_assoc();
                $game_id = $game_row['game_id'];

                // Prepare and execute the SQL statement to insert into user_games using INSERT IGNORE
                $stmt_insert = $conn->prepare("INSERT IGNORE INTO user_games (user_id, game_id) VALUES (?, ?)");
                $stmt_insert->bind_param("ii", $user_id, $game_id);
                $stmt_insert->execute();
            }
        }

        header("Location: purchase_confirmation.php");
        exit;
    } else {
        echo "<p>Your cart is empty.</p>";
    }
} else {
    echo "<p>User not found.</p>";
}

$stmt_user->close();
$conn->close();
?>
