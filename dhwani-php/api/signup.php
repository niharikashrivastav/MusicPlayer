<?php
// ============================================================
// api/signup.php — POST handler for user registration
// ============================================================

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit;
}

require_once "db.php";

// Read JSON body
$data     = json_decode(file_get_contents("php://input"), true);
$username = trim($data["username"] ?? "");
$email    = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

// Validate
if (!$username || !$email || !$password) {
    http_response_code(400);
    echo json_encode(["message" => "All fields are required"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid email address"]);
    exit;
}

if (strlen($password) < 6) {
    http_response_code(400);
    echo json_encode(["message" => "Password must be at least 6 characters"]);
    exit;
}

// Check if email already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    http_response_code(400);
    echo json_encode(["message" => "Email already registered"]);
    exit;
}

// Check if username already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    http_response_code(400);
    echo json_encode(["message" => "Username already taken"]);
    exit;
}

// Hash password and insert
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashedPassword]);

http_response_code(200);
echo json_encode(["message" => "Signup successful! Please login."]);
?>
