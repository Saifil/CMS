<?php

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

function confirm_query($result_query) {
    if (!$result_query) { //test for any query error
        die("Database query failed.");
    }
}

function find_all_subjects() {
    global $conn;
    $query  = "SELECT * ";
    $query .= "from subjects ";
    //$query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC;";

    $result = mysqli_query($conn,$query);
    confirm_query($result);

    return $result;
}

function find_pages_for_subject($subject_id) {
    global $conn;

    $safe_subject_id = mysqli_real_escape_string($conn,$subject_id);

    $query  = "SELECT * ";
    $query .= "from pages ";
    $query .= "WHERE subject_id = {$safe_subject_id} ";
    //$query .= "AND visible = 1 ";
    $query .= "ORDER BY position ASC;";

    $result_pages = mysqli_query($conn,$query);
    confirm_query($result_pages);

    return $result_pages;
}

function find_subject_by_id($subject_id) {
    global $conn;

    $safe_subject_id = mysqli_real_escape_string($conn,$subject_id);

    $query  = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id};";
    //$query .= "AND visible = 1 ";

    $result = mysqli_query($conn,$query);
    confirm_query($result);

    if ($subject = mysqli_fetch_assoc($result)) {
        return $subject;
    } else {
        return null;
    }
}

function find_page_by_id($page_id) {
    global $conn;

    $safe_page_id = mysqli_real_escape_string($conn,$page_id);

    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$safe_page_id};";
    //$query .= "AND visible = 1 ";

    $result = mysqli_query($conn,$query);
    confirm_query($result);

    if ($page = mysqli_fetch_assoc($result)) {
        return $page;
    } else {
        return null;
    }
}

function count_all_subjects() {
    global $conn;

    $query  = "SELECT count(id) AS subj_count ";
    $query .= "FROM subjects;";

    $result = mysqli_query($conn,$query);
    confirm_query($result);

    $result["subj_count"];
}

function mysql_prep($string) {
    global $conn;

    //Escape the string
    $escaped_string = mysqli_real_escape_string($conn,$string);
    return $escaped_string;
}

?>