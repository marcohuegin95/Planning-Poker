<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="templates/css/login.css">

</head>

<body>
    <div class="container">
        <div id="loginFrame" class="row">
            <div class="col-md-4"></div>

            <div class="col-md-4">
                <?php echo $this->err;
                      echo $this->message;  
                ?>
                
                <div class="card">
                    <div class="card-header">
                        <h4>Scrum Planning Poker</h4>
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" data-toggle="tab" href="#login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#register">Register</a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body">

                        <div class="tab-content">
                            <div id="login" class="tab-pane active">
                                <form action="/Login" method="post">
                                    <div class="form-group">
                                        <label for="inputEmail">Email address</label>
                                        <input name="email" type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp"
                                            placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Password</label>
                                        <input name="password" type="password" class="form-control" id="loginPassword" placeholder="Password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                            </div>

                            <div id="register" class="tab-pane">
                                <form action="/Register" method="post">
                                    <div class="form-group">
                                        <label for="inputUser">Username</label>
                                        <input name="username" type="test" class="form-control" id="registertUser" placeholder="Enter username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email address</label>
                                        <input name="email" type="email" class="form-control" id="registerEmail" aria-describedby="emailHelp"
                                            placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Password</label>
                                        <input name="password" type="password" class="form-control" id="registerPassword" placeholder="Password" required>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

</body>

</html>