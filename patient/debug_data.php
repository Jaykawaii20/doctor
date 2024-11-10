<?php
// Debug Data Output
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : 'No title';
    $start = isset($_POST['start']) ? $_POST['start'] : 'No start time';
    $pid = isset($_POST['pid']) ? $_POST['pid'] : 'No PID';

    // Debug output to check values
    echo "<strong>Data Debug Output:</strong><br>";
    echo "Title: " . htmlspecialchars($title) . "<br>";
    echo "Start: " . htmlspecialchars($start) . "<br>";
    echo "PID: " . htmlspecialchars($pid) . "<br>";

    // You can also split the start date and time here if needed for debugging
    $date = date('Y-m-d', strtotime($start));
    $time = date('H:i:s', strtotime($start));

    echo "Date: " . htmlspecialchars($date) . "<br>";
    echo "Time: " . htmlspecialchars($time) . "<br>";
}
?>
