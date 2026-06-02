<?php
// ============================================================
// api/login.php — POST handler for user login
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
$email    = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

// Validate
if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(["message" => "Email and password are required"]);
    exit;
}

// Find user by email
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    http_response_code(404);
    echo json_encode(["message" => "User not found"]);
    exit;
}

// Verify password
if (!password_verify($password, $user["password"])) {
    http_response_code(401);
    echo json_encode(["message" => "Incorrect password"]);
    exit;
}

http_response_code(200);
echo json_encode([
    "message"  => "Login successful!",
    "username" => $user["username"]
]);
?>
