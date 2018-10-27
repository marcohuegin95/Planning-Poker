<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Planning Poker</title>
    <link rel="stylesheet" href="templates/css/bewertung.css">
    <link rel="stylesheet" href="templates/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="templates/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/dashboard">Planning Poker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="mr-auto">

            </div>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["email"] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="Logout">Log out</a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
    <?php   echo $this->err;
            echo $this->message;  
    ?>

        <div class="text-center">
            <h1>Dashboard von <b><span id="aktuellerBenutzername"><?php echo $_SESSION["username"] ?></span></b></h1>
        </div>

        <div class="row">
            <!--div class="col-sm-1"></div-->
            <div class="col-sm-6 pt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Einladungen</h3>
                    </div>

                <?php echo $this->displayInvites(); ?>
                </div>
                <div class="card">
                    <div class="text-center">
                        <a href="/newgame">
                            <i class="fa fa-plus" style="font-size:50px;color:royalblue"></i>
                            <h4>
                                <p style="color: royalblue">Neues Spiel</p>
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
            <!--div class="col-sm-2"></div-->
            <div class="col-sm-6 pt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Vergangene Spiele</h3>
                    </div>
                    <?php echo $this->displayOldGames(); ?>
                </div>
                <div class="card">
                        <div class="text-center">
                            <a href="#">
                                <i class="fa fa-cog" style="font-size:50px;color:royalblue"></i>
                                <h4>
                                    <p style="color: royalblue">Account anpassen</p>
                                </h4>
                            </a>
                        </div>
                </div>
            </div>
            <!--div class="col-sm-1"></div-->
        </div>

    </div>
    <script src="templates/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="templates/js/popper.min.js"></script>
    <script src="templates/js/bootstrap/bootstrap.min.js"></script>

</body>

</html>