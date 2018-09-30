<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">    
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>

            <div class="col-md-4">
                
                <div class="card">
                    <div class="card-header">
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
                                <label for="username">Username</label>
                                <input class="form-control" name="username" id="username" placeholder="Username" required="" >
                                <label for="password">Password</label>
                                <input class="form-control" name="password" id="password" placeholder="Password" required="" type="password">
                            </div>

                            <div id="register" class="tab-pane">
                                <label for="username">Username</label>
                                <input class="form-control" name="username" id="username" placeholder="Username" required="" >
                                <label for="password">E-Mail</label>
                                <input class="form-control" name="password" id="password" placeholder="email@server.de" required="" type="password">
                                <label for="password">Password</label>
                                <input class="form-control" name="password" id="password" placeholder="Password" required="" type="password">
                            </div>
                        </div>

                        
                    </div>
                </div>

            
            </div>
            
            <div class="col-md-4"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</body>
</html>