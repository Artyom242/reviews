<?php
/** @var PDO $db */
$db = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

$name = $_POST['name'];
$review = $_POST['review'];
$data = date("y.m.d");
$time = date("H:i:s");

$query = $db->prepare ('insert into reviews (name, review, data, time) values (:name, :review, :data, :time)');
$flag = $query->execute(['name' => $name, 'review' => $review, 'data' => $data, 'time' => $time]);

header('Location: /mini_project?flag=' . $flag);
