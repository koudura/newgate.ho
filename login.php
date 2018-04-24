<?php
    require_once("functions/conn.php");
    require_once("functions/functions.php");

    if (isset($_POST["submit"])){
        $conn = connect();
        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = :email AND password = :password");
        $data = array("email"=> $_POST['email'], "password" => sha1($_POST['password']));
        $stmt->execute($data);

        if( $result = $stmt->fetch(PDO::FETCH_ASSOC) ){
        
            $id = $result["ID"];
            $stmt2 = $conn->query("SELECT * FROM rel_user_roles WHERE userID = $id");
            $result2 = $stmt2->fetchall(PDO::FETCH_ASSOC);
            $rolearray = array();
            foreach ($result2 as $row) {
                array_push($rolearray,intval($row["roleID"]));
            }
            session_start();
            $_SESSION['ID'] = $id;
            $_SESSION['email'] = $result["email"];
            $_SESSION['role'] = $rolearray;
            header("Location: landing.php");
        }
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <title> Login </title>
</head>
<body>
    <div class="text-center">
        <h1 class="jumbotron">New Gate Hospital</h1>
        <div class="backbone">
            <div class="card mx-auto" style="width:20rem;height:20rem">
                <div class="card-body ">
                    <div class="card-content ">
                        <h3 class="card-heading ">Login</p>
                    </div>
                    <div>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <input type="email" name="email" placeholder="email" class="inputext">
                            <input type="password" name="password" placeholder="password" class="inputext">
                            <input type="submit" name="submit" value="Login" class="btn btn-primary">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>