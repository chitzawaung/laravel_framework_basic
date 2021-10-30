<?php 
 function _HomeController() {
     $data = [
        "students" => [
            [
                "id" => 1, 
                "name" => "Aye Aye",
                "phone_no" => "09000000000"
            ],
            [
                "id" => 2,
                "name" => "Mya Mya",
                "phone_no" => "84034805830"
            ]
        ],
       
        "classes" => [
             [
                "id" => 1, 
                "name" => "WPA"
            ],
            [
                "id" => 2,
                "name" => "WPF"
            ],
        ],
        "batches" => [
            [
                "id" => 1,
                "class_name" => 1,
                "batch" => 1,
            ],
            [
                "id" => 2,
                "class_name" =>2,
                "batch" =>2,
            ],
        ],
        "student_batch" => [
            [
                "id" =>1,
                "student_id" =>1,
                "batch_id" =>1,
            ],
            [
                "id" =>2,
                "student_id" =>2,
                "batch_id" =>2,
            ]
        ],
     ];

    _get_view("home", $data);
 }

 function _BlogController() {
     _get_view("blog");
 }

 function _PageController() {
     $data = [
         'title' => 'How Are U?',
         'hello' => 'this is hello form page'
     ];
     _get_view("page", $data);
 }

 function _RegisterController() {
    $hostname = _config_get("database.hostname");
    $db_username = _config_get("database.username");
    $db_password = _config_get("database.password");
    $dbname = _config_get("database.dbname");
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        if(_check_empty($username)) {
            _dump("User Name is Empty");  
        } 
        if(_check_empty($password)) {
            _dump("Password is empty");
        }
        if(_check_empty($confirm_password)) {
            _dump("Confirm Password is empty");
        }
        if(_check_equal($password, $confirm_password)){
            _dump("Password does not match!");
        }
        if(_check_count($password, 4)) {
            _dump("Password need to b 4 chars", true);
        }
        
        $link = mysqli_connect($hostname, $db_username, $db_password, $dbname);
        
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        } 
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            if(mysqli_stmt_execute($stmt)){
                // Redirect to index page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    _get_view("register");
}

function _LoginController() {
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php?page=welcome");
        exit;
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $user_password = $_POST["password"];
        
        $hostname = _config_get("database.hostname");
        $db_username = _config_get("database.username");
        $db_password = _config_get("database.password");
        $dbname = _config_get("database.dbname");
        
        $link = mysqli_connect($hostname, $db_username, $db_password, $dbname);
        
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        } 
        
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){  
                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        
                        if(password_verify($user_password, $hashed_password)){
                            
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                    
                            header("location: index.php?page=welcome");
                            exit;
                        }
                    }
                    
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
            
            mysqli_close($link);
        }     
        
    }
    _get_view("login");    
}

function _WelcomeController() {
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php?page=login");
        exit;
        
    }
    _get_view("welcome");
}

function _LogoutController() {
    session_start();
    
    // Unset all of the session variables
    $_SESSION = array();
    
    // Destroy the session.
    session_destroy();
    
    // Redirect to login page
    header("location: index.php?page=login");
    exit;
}
?>
