<!DOCTYPE html>
<html>


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account-Einstellungen</title>
    <h1 class="text-hide" style="background-image: url('/images/karte.png); width: 50px; height: 50px;">Bootstrap</h1>
    <link rel="stylesheet" href="css/bewertung.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Planning Poker</a>
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
                        timonmw@gmail.com
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Log out</a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="jumbotron">
    <?php echo $this->err;
          echo $this->message;  
                            ?>
    <div class="container">
        <div id="loginFrame" class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Scrum Planning Poker</h4>
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" data-toggle="tab" href="#login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#register">Registrieren</a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="login" class="tab-pane active">
                                <form action="/Login" method="post">
                                    <div class="form-group">
                                        <label for="inputEmail">E-Mail</label>
                                        <input name="email" type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp"
                                            placeholder="E-Mail eingeben" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Passwort</label>
                                        <input name="password" type="password" class="form-control" id="loginPassword" placeholder="Passwort" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                            </div>

                            <div id="register" class="tab-pane">
                                <form action="/Register" method="post">
                                <div class="form-group">
                                        <label for="inputUser">Vorname</label>
                                        <input name="vorname" type="test" class="form-control" id="registertVorname" placeholder="Vorname eingeben" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUser">Nachname</label>
                                        <input name="nachname" type="test" class="form-control" id="registertNachname" placeholder="Nachname eingeben" required>
                                        </div>
                                        <div class="form-group">
                                    <label for="sel1">Erfahrung des Mitarbeiter</label>
                                    <select class="form-control" id="sel1">
                                        <option>Gar keine</option>
                                        <option>Wenig</option>
                                        <option>Einige</option>
                                        <option>Viel</option>
                                    </select>
                                    </div>                               
                                    <div class="form-group">
                                        <label for="inputUser">Username</label>
                                        <input name="username" type="test" class="form-control" id="registertUser" placeholder="Username eingeben" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">E-Mail Adresse</label>
                                        <input name="email" type="email" class="form-control" id="registerEmail" aria-describedby="emailHelp"
                                            placeholder="E-Mail eingeben" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Passwort</label>
                                        <input name="password" type="password" class="form-control" id="registerPassword" placeholder="Passwort eingeben" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    </div>
    <script src="js/jquery/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

</body>

</html>