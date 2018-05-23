<?php
require_once("../functions/conn.php");
require_once("../functions/functions.php");
require_once("../classes/user.php");
require_once("../classes/patient.php");

session_start();
$current_user = getCurrentUserOrDie();
if (!$current_user->isDoctor() && $current_user->isSupport()) {
    doUnauthorized();
}
$conn = connect();
$patients = Patient::getAllPatients($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/viewpatients.css"/>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Patients</title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="#" class="active dash_btn"><i class="fas fa-file-alt"></i>Patients Explorer</a>
        <a href="addpatients.php" class="dash_btn"><i class="fas fa-plus-circle"></i>Add Patient</a>
        <a href="../pages/dashboard.php" class="dash_btn"><i class="fas fa-home"></i>Home</a>
        <a href="../logout.php" class="dash_btn"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </nav>
</section>
<header>
    <div class="search-field">
        <i class="fas fa-search"></i>
        <input type="text" name="" value="">
    </div>
    <div class="user-field">
        <a href="#"><i class="b far fa-question-circle"></i></a>
        <a href="#" class="notification"><i class="b fas fa-bell"></i><span class="circle">3</span></a>
        <a href="#">
            <div class="user-img"></div>
            <i class="b far fa-user"></i>
        </a>
    </div>
</header>
<section class="main-container">
    <div class = "stuff">

        <div>
            <input class = "inputext" type="number" name="id" onkeyup="typeSearch()" id="id" placeholder = "Search by ID">
            <input class = "inputext" type="text" name="name" onkeyup="typeSearch()" id="name" placeholder = "Search by Name">
            <input class = "inputext" type="email" name="email" onkeyup="typeSearch()" id="email" placeholder = "Search by Email">
        </div>

        <table id="patientTable" class="genTab">
            <thead>
            <tr>
                <th> ID </th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Action</th>

            </tr>
            </thead>

            <tbody>
            <?php foreach ($patients as $patient) {
                echo <<<_END
            
            <tr>
                <td> $patient->ID </td>
                <td> $patient->firstname </td>
                <td> $patient->lastname </td>
                <td> $patient->phone_num </td>
                <td> $patient->email</td>
                <td> 
                <a href="patientfile.php?id=$patient->ID"><button class="bodbut">View</button></a>
                <a href="managepatients.php?id=$patient->ID"><button class="bodbut">Edit</button></a>
                </td>
            </tr>
            
_END;
            }?>


            </tbody>
        </table>
    </div>



    <script src="/newgate.ho/assets/js/jquery-3.3.1.min.js"></script>
    <script>
        console.log($("#patientTable tbody"));
        function typeSearch(){
            var postData = {
                'id' : document.getElementById('id').value,
                'name': document.getElementById('name').value,
                'email': document.getElementById('email').value
            };
            $.ajax({
                url: "../functions/ajax/searchpatients.php",
                dataType: 'json',
                type : 'post',
                data: postData,
                success : function(data){
                    let tstring = "";
                    var pTab = document.querySelector("#patientTable tbody");
                    if(data){
                        for(var i = 0; i < data.length; i++){
                            tstring += "<tr>";
                            tstring += "<td>"+ data[i]['ID'] +"</td>";
                            tstring += "<td>"+ data[i]['firstname'] +"</td>";
                            tstring += "<td>"+ data[i]['lastname'] +"</td>";
                            tstring += "<td>"+ data[i]['phone_num'] +"</td>";
                            tstring += "<td>"+ data[i]['email'] +"</td>";
                            tstring += '<td> <a href="patientfile.php?id='+data[i]['ID']  + '">Manage</a></td>';
                            tstring += "</tr>";
                        }
                    }
                    pTab.innerHTML = tstring;
                }
            });
        }
    </script>
</body>
</html>