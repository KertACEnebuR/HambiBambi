<?php
include_once "connect.php";

$sql = "SELECT posts.*, users.fname, users.lname, users.img FROM posts
        LEFT JOIN users ON posts.user_id = users.user_id
        ORDER BY posts.created_at DESC";

$query = mysqli_query($conn, $sql);
$output = '';

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $output .= '<div class="post">
                        <div class="post-header">
                            <img src="php/images/' . $row['img'] . '" alt="Profile Image">
                            <span>' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            <small>' . $row['created_at'] . '</small>
                        </div>
                        <p>' . $row['content'] . '</p>';
        if ($row['post_image']) {
            $output .= '<img src="php/images/posts/' . $row['post_image'] . '" class="post-image">';
        }
        $output .= '</div>';
    }
} else {
    $output = "Nincsenek bejegyzések.";
}

echo $output;

