<?php

    $conn = mysqli_connect("localhost", "oussama", "oussama123", "pizza recipes");

    if (!$conn) {
        echo "Connection error: " . mysqli_connect_error();
    }

?>