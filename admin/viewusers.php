<?php
    require_once("../functions/conn.php");
    require_once("../functions/functions.php");
    session_start();
    if (!isset($_SESSION["ID"]) || !isAdmin()){
        doUnauthorized();        
    }

    $conn = connect();
    $stmt = $conn->query("SELECT * FROM tbl_users");
    $users = $stmt->fetchall(PDO::FETCH_ASSOC);

    $stmt2 = $conn->query("SELECT userID, role FROM tbl_roles");
    $rol = $stmt2->fetchall(PDO::FETCH_ASSOC);
    $roles = array();
    foreach ($rol as $r) {
        if (array_key_exists($r['userID'],$roles)){
            array_push($roles[$r['userID']], $r['role']);
        }else{
            $roles[$r['userID']]  = array($r['role']);
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Users</title>
</head>
<body>
    
    <table>
        <thead>
            <tr>
                <td>Email</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Admin</td>
                <td>Role</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user) {
                $email = $user['email'];
                $firstname = $user['firstname'];
                $lastname = $user['lastname'];
                $admin = in_array('ADMIN', $roles[$user['ID']])? "TRUE":"FALSE";
                $role = "";
                if (in_array('DOCTOR', $roles[$user['ID']])){
                    $role = "DOCTOR";
                }elseif (in_array('SUPPORT', $roles[$user['ID']])){
                    $role = "SUPPORT";
                }
                echo <<<_END
            <tr>
                <td> $email</td>
                <td> $firstname</td>
                <td> $lastname</td>
                <td> $admin </td>
                <td> $role </td>
            </tr>
_END;
             }?>
        
        
        </tbody>
    </table>

</body>
</html>