<!DOCTYPE html>
<html class="h-100">
<head>
    <title>Oichi International</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="image/oichi_init.png" sizes="16x16"> 
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css"> 
</head>

<style>
    body{
        height: 100%;
        background-color: currentColor;
        font-family: 'Ubuntu Condensed', sans-serif;
        font-size: 20px;
    }

    p{
        text-align: justify;
    }

    .space{
        padding: 30px;
    }

    .d-space{
        padding: 50px;
    }


    .fa-logo-size{
        font-size: 40px;
        height: 65px;
    }

    .padding-top-bottom{
        padding-top: 8%;
        padding-bottom: 8%;
    }

    .padding-top{
        padding-top: 4%;
    }

    .dropdown:hover>.dropdown-menu {
      display: block;

    }

    .dropdown>.dropdown-toggle:active {
      /*Without this, clicking will make it sticky*/
        pointer-events: none;
    }

    .dropdown-menu>.dropdown-item:hover{
        color: white;
        background-color: gray;
    }

</style>

<body>
    <div class="bg-light text-center" id="nav-image">
        <img src="image/oichi_init.png" width="128" height="128" style="margin: 10px;" class="d-inline-block align-bottom" alt="">
    </div>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark py-2" id="navbar">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbar1">
                <ul class="navbar-nav">
                    <li class="nav-item" id="index">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> HOME</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                          <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-award"></i> About us</a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" id="introduction" href="introduction.php"><i class="fas fa-flag"></i> Introduction</a>
                            <a class="dropdown-item" id="proprietor_message" href="proprietor_message.php"><i class="fas fa-comment"></i> Message from Propritor</a>
                            <a class="dropdown-item" id="ceo_message" href="ceo_message.php"><i class="fas fa-comment-alt"></i> Message from CEO</a>
                            <a class="dropdown-item" id="organogram" href="organogram.php"><i class="fas fa-sitemap"></i> Company Organogram</a>
                          </div>
                        </div>
                    </li>
                    <li class="nav-item" id="recruitment">
                        <a class="nav-link" href="recruitment.php"><i class="fas fa-clipboard-list"></i> Recruitment Procedures</a>
                    </li>
                    <li class="nav-item" id="hr">
                        <a class="nav-link" href="hr.php"><i class="fas fa-chart-line"></i> Human Resource</a>
                    </li>
                    <li class="nav-item" id="img_gallary">
                        <a class="nav-link" href="img_gallary.php"><i class="far fa-images"></i> Gallary</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>