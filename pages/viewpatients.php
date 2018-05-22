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
    <link rel="stylesheet" type="text/css" media="screen" href="/newgate.ho/assets/css/main.css"/>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/newgate.ho/assets/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Patients</title>
</head>
<body>
    <div class="grid">
        <div class = "logo">sss</div>
        <div class = "profile">adsdas</div>
        <div class = "navbar ">
                <div class="damn">
                <a href="/newgate.ho/admin/viewusers.php"><button class="nav-btn">Manage Patients</button></a> 
                <a href="/newgate.ho/pages/addpatients.php"><button class="nav-btn">Add Patients</button></a>
            </div>
        </div>
 <div class = "stuff">

    <div>
        <input type="number" name="id" onkeyup="typeSearch()" id="id">
        <input type="text" name="name" onkeyup="typeSearch()" id="name">
        <input type="email" name="email" onkeyup="typeSearch()" id="email">
    </div>
            
    <table id="patientTable">
        <thead>
            <tr>
                <td> ID </td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Phone No</td>
                <td>Email</td>
             
            </tr>
        </thead>

        <tbody>
            <?php foreach ($patients as $patient) {
                echo <<<_END
            <tr>
                <td> $patient->ID </td>
                <td> $patient->firstname</td>
                <td> $patient->lastname</td>
                <td> $patient->phone_num </td>
                <td> $patient->email </td>
                
            </tr>
_END;
             }?>
        
        
        </tbody>
    </table>
        </div>
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
                            tstring += "<tr>";
                        }
                        
                    }
                    pTab.innerHTML = tstring;
                }
            });
        }
    </script>
</body>
</html>