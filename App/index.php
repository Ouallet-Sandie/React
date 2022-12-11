<?php 

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') die;

// $body = json_decode(file_get_contents('php://input'), true);





require_once "vendor/autoload.php";

switch ($_SERVER["REQUEST_URI"]) {

    case "/":
        break;

    case "/login":
        $method = new \App\Controller\UserController();
        $method->login();
        break;


    case "/register":
        $method = new \App\Controller\UserController();
        $method->register();
        break;

    case "/homepage":
        $method = new \App\Controller\PostController();
        $method->homepage();
        break;

    case "/ajouter-post":
        $method = new \App\Controller\PostController();
        $method->ajouterPost();
        break;
    
    default:
        echo "Cette page n'existe pas ...";
}










$username = $_SERVER['PHP_AUTH_USER'] ?? "";
$password = $_SERVER['PHP_AUTH_PW'] ?? "";

echo json_encode(
    [
        // "valeur 1" => 12,
        // "val 2" => "francis",
        // "array" => [1, 2, 4],

        // 'info recue' => $body['info'] ?? "",

        "username" => $username,
        "password" => $password
    ]
);


