<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="/templates/css/bewertung.css">
    <link rel="stylesheet" href="/templates/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/templates/css/index.css">
</head>

<body>
    <div class="container mt-5">
        <div class="text-center">
            <h1>Wilkommen zum Planning Poker!</h1>
        </div>
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
                        <?php   echo $this->err;
                            echo $this->message;  
                            ?>
                        <div class="tab-content">
                            <div id="login" class="tab-pane active">
                                <form action="/Login" method="post">
                                    <div class="form-group">
                                        <label for="inputEmail">E-Mail</label>
                                        <input name="email" type="email" class="form-control" id="loginEmail"
                                            aria-describedby="emailHelp" placeholder="E-Mail eingeben" >
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Passwort</label>
                                        <input name="password" type="password" class="form-control" id="loginPassword"
                                            placeholder="Passwort" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                            </div>

                            <div id="register" class="tab-pane">
                                <form action="/Register" method="post">
                                    <div class="form-group">
                                        <label for="inputUser">Username</label>
                                        <input name="username" type="test" class="form-control" id="registertUser"
                                            placeholder="Username eingeben" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">E-Mail Adresse</label>
                                        <input name="email" type="email" class="form-control" id="registerEmail"
                                            aria-describedby="emailHelp" placeholder="E-Mail eingeben" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Passwort</label>
                                        <input name="password" type="password" class="form-control" id="registerPassword"
                                            placeholder="Passwort eingeben" required>
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
    <script src="/templates/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="/templates/js/popper.min.js"></script>
    <script src="/templates/js/bootstrap/bootstrap.min.js"></script>

</body>

</html>