<?php
$host = 'localhost';
$dbname = 'survey';
$username = 'root';
$password = '';

try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("INSERT INTO answers (
    nickname, language, language_free, language_reason,
    experience,
    most_profitable, most_profitable_free, most_profitable_reason,
    best_for_job, best_for_job_free, best_for_job_reason,
    easiest, easiest_free, easiest_reason,
    domain, domain_free, domain_reason,
    next_language, next_language_free, next_language_reason,
    using_now, comment
) VALUES (
    :nickname, :language, :language_free, :language_reason,
    :experience,
    :most_profitable, :most_profitable_free, :most_profitable_reason,
    :best_for_job, :best_for_job_free, :best_for_job_reason,
    :easiest, :easiest_free, :easiest_reason,
    :domain, :domain_free, :domain_reason,
    :next_language, :next_language_free, :next_language_reason,
    :using_now, :comment
)");

$stmt->execute([
    ':nickname' => htmlspecialchars($_POST['nickname'], ENT_QUOTES, 'UTF-8'),
    ':language' => htmlspecialchars($_POST['language'], ENT_QUOTES, 'UTF-8'),
    ':language_free' => htmlspecialchars($_POST['language_free'], ENT_QUOTES, 'UTF-8'),
    ':language_reason' =>