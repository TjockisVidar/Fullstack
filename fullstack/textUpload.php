<?php
header("Content-Type: application/json");

$host = 'localhost';
$db   = 'fullstack';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

if ($method === 'GET') {
    if ($action === 'getNextId') {
        $result = $conn->query("SELECT MAX(TextID) as maxId FROM texts");
        $row = $result->fetch_assoc();
        $nextId = ($row['maxId'] !== null) ? $row['maxId'] + 1 : 1;
        echo json_encode(['nextId' => $nextId]);
        exit;
    }

    if ($action === 'count') {
        $result = $conn->query("SELECT COUNT(*) as total FROM texts");
        $row = $result->fetch_assoc();
        echo json_encode(['total' => $row['total']]);
        exit;
    }

    if ($action === 'getAll') {
        $result = $conn->query("SELECT TextID, Heading FROM texts");
        $texts = [];
        while ($row = $result->fetch_assoc()) {
            $texts[] = [
                'TextID' => $row['TextID'],
                'Heading' => $row['Heading']
            ];
        }
        echo json_encode(['texts' => $texts]);
        exit;
    }

    if ($action === 'getOne' && isset($_GET['textID'])) {
        $textID = (int)$_GET['textID'];

        $stmt = $conn->prepare("SELECT Username, Heading, Text FROM texts WHERE TextID = ?");
        $stmt->bind_param("i", $textID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            echo json_encode([
                'Username' => $row['Username'],
                'Heading' => $row['Heading'],
                'Text' => $row['Text']
            ]);
        } else {
            echo json_encode(['error' => 'Texten hittades inte']);
        }

        exit;
    }

    echo json_encode(['error' => 'Ogiltig GET-action']);
    exit;
}

if ($method === 'POST') {
    $username = $_POST['Username'] ?? '';
    $heading = $_POST['Heading'] ?? '';
    $text = $_POST['Text'] ?? '';
    $textID = $_POST['TextID'] ?? '';

    if (!$username || !$heading || !$text || !$textID) {
        echo json_encode(['status' => 'error', 'message' => 'Saknar data']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM texts WHERE TextID = ?");
    $stmt->bind_param("i", $textID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'TextID används redan']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO texts (TextID, Username, Heading, Text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $textID, $username, $heading, $text);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'ok', 'message' => 'Post tillagd']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Fel vid infogning']);
    }
    exit;
}

echo json_encode(['error' => 'Ogiltig förfrågan']);