<?php

namespace App\Controller;

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: authorization');



use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Entity\User;



$username = $_SERVER['PHP_AUTH_USER'] ?? "";
$password = $_SERVER['PHP_AUTH_PW'] ?? "";

echo json_encode(
    [
        "username" => $username,
        "password" => $password
    ]
);






class UserController extends AbstractController
{
    public function afficherUser()
    {   
        session_start();
        $this->deleteUser();
        $this->changeRole();
        $method = new UserManager(new PDOFactory());
        $User = $method->getAllUser();
        $this->render("afficher-users.php", ["User" => $User], 'afficher users');
    }


    public function register()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $manager = new UserManager(new PDOFactory());
            $user = $manager->getUserByUsername($username);

            if ($user) {
                throw new \Exception('trop ici');
            }

            if ($_POST['password'] !== $_POST['confirmPassword']) {
                throw new \Exception('bad password');
            }

            $newUser = (new User())
                ->setUsername($username)
                ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                ->setEmail($email);


            if (!$manager->insertUser($newUser)) {
                throw new \Exception('insert foireux');
            }


            header('Location: /login');
            exit;
        }

        $this->render("register.php", [], 'register');
    }


    public function login()
    {   
        session_start();
        if (isset($username) && isset($password)) {

            $manager = new UserManager(new PDOFactory());
            $user = $manager->getUserByUsername($username);

            if (!$user) {
                throw new \Exception('WRONG USERNAME OR PASSWORD');
                // throw new \Exception('CET USER EXISTE PAS');
            } else {
                $pw = $user->getPassword();
            }
            
            if (password_verify($password, $pw)) {
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $user->getId();

                header('Location: /post');
            } else {
                throw new \Exception('WRONG USERNAME OR PASSWORD');
            }


            exit;
        }
        $this->render("login.php", [], 'login');

    }
}
