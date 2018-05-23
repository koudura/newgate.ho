<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css"/>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/web-fonts-with-css/css/fontawesome-all.css">

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <title>Manage Patients</title>
</head>
<body>
<section id="sideMenu">
    <img class="logo" src="../assets/images/newgate.svg" alt="logo here">
    <nav>
        <a href="viewpatients.php" class="dash_btn"><i class="fas fa-long-arrow-alt-left"></i>Back</a>
        <a href="#" class="active dash_btn"><i class="fas fa-user-circle"></i>Patient Report</a>
        <a href="../pages/dashboard.php" class="dash_btn"><i class="fas fa-home"></i>Home</a>
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
<section id="content-area">
    <div class="heading">
        <h1>Patient Report</h1>
        <p>Generate and edit patient report</p>
    </div>
    <div class="cards">
        <div class="card">
            <div class="patient-img"></div>
            <span class="user-name">#Patient Name</span>
            <span class="user-detail">#Patient genger, #age, ref.no</span>
            <hr>
            <div class="col-md-4">
                <span class="height">Height</span>
                <span class="weight">Weight</span>
            </div>
            <div class="col-md-4">
                <span class="weight">#patient weight</span>
                <span class="height">#patient height</span>
            </div>
            <input type="button" class="edit_btn" name="" href="editpatient.php">
         </div>
        <div class="card">

        </div>
        <div class="card">
            <h3>Patient Report</h3>
            <div class="history_display">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'allergies')"><i class="fas fa-syringe"></i>Allergies</button>
                    <button class="tablinks" onclick="openCity(event, 'sessions')"><i class="fas fa-clock"></i>Sessions</button>
                    <button class="tablinks" onclick="openCity(event, 'contact')"><i class="fas fa-phone"></i>Contact Details</button>
                </div>

                <div id="allergies" class="tabcontent">

                </div>
                <div id="sessions" class="tabcontent">
                    <table id="sess_table" class="genTab">
                        <thead>
                            <tr>
                                <th>
                                    Session Ref.No
                                </th>
                                <th>
                                    Doctor
                                </th>
                                <th>
                                    Start Date
                                </th>
                                <th>
                                    End Date
                                </th>
                                <th>
                                    No. of Prescription
                                </th>
                                <th>
                                    Session Bill(N)
                                </th>
                                <th>
                                    Paid Status
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div id="contact" class="tabcontent">
                </div>

                <script>
                    function openCity(evt, Name) {
                        var i, tabcontent, tablinks;
                        tabcontent = document.getElementsByClassName("tabcontent");
                        for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";
                        }
                        tablinks = document.getElementsByClassName("tablinks");
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace("active", "");
                        }
                        document.getElementById(Name).style.display = "block";
                        evt.currentTarget.className += "active";
                    }
                </script>
            </div>
        </div>
    </div>
</section>

</body>
</html>