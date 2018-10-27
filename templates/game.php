<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Planning Poker Game</title>
    <link rel="stylesheet" href="templates/css/bewertung.css">
    <link rel="stylesheet" href="templates/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="templates/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <?php echo $_SESSION["email"] ?>
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
        <div class="col-*-*">
            <div class="row top-buffer"></div>
        </div>
        <div class="col-*-*">
            <div class="row top-buffer"></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            User-Story <b>[<span id="aktuelleUserStoryNr">1</span>/<span id="anzahlStorys">10</span>]</b>
                            <a href="#">
                                <i class="fa fa-arrow-left" style="font-size:40px;color:blue" id="storyZurueck"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-arrow-right" style="font-size:40px;color:blue" id="storyVorwaerts"></i>
                            </a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title" id="aktuelleUserStoryTitel">Optimierung der DB-Anbindung</h2>
                        </br>
                        <p class="card-text" id="aktuelleUserStoryBeschreibung">Lorem ipsum dolor sit amet, consetetur
                            sadipscing elitr, sed diam nonumy
                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                            eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
                            sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing
                            elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed
                            diam voluptua.<br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Schätzung: <b id="projektname"><?php echo $this->vote->getName() ?></b>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="buttonAbschaetzung">
                        <button class="btn btn-primary" id="button_Null" value="0" onclick="setValueFromVoteButtonToAjax(this.value, button_Null)">
                            <div class="numberCircle">0</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_EinHalb" value="0,5" onclick="setValueFromVoteButtonToAjax(this.value, button_EinHalb)">
                            <div class="numberCircleWithComma">0,5</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Eins" value="1" onclick="setValueFromVoteButtonToAjax(this.value, button_Eins)">
                            <div class="numberCircle">1</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Zwei" value="2" onclick="setValueFromVoteButtonToAjax(this.value, button_Zwei)">
                            <div class="numberCircle">2</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Drei" value="3" onclick="setValueFromVoteButtonToAjax(this.value, button_Drei)">
                            <div class="numberCircle">3</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Fuenf" value="5" onclick="setValueFromVoteButtonToAjax(this.value, button_Fuenf)">
                            <div class="numberCircle">5</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Acht" value="8" onclick="setValueFromVoteButtonToAjax(this.value, button_Acht)">
                            <div class="numberCircle">8</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Dreizehn" value="13" onclick="setValueFromVoteButtonToAjax(this.value, button_Dreizehn)">
                            <div class="numberCircle">13</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Zwanzig" value="20" onclick="setValueFromVoteButtonToAjax(this.value, button_Zwanzig)">
                            <div class="numberCircle">20</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Vierzig" value="40" onclick="setValueFromVoteButtonToAjax(this.value, button_Vierzig)">
                            <div class="numberCircle">40</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Hundert" value="100" onclick="setValueFromVoteButtonToAjax(this.value, button_Hundert)">
                            <div class="numberCircleHundert">100</div></br>SP
                        </button>
                        <button class="btn btn-primary" id="button_Fragezeichen" value="-1" onclick="setValueFromVoteButtonToAjax(this.value, button_Fragezeichen)">
                            <div class="numberCircle"><i class="fa fa-question" style="font-size:35px;color:black"></i></div></br>SP
                        </button>
                        </div>
                    </div>
                    <div class="col-*-*">
                        <div class="row top-buffer"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-*-*">
            <div class="row top-buffer"></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Statistik</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><b>Ende:</b></h3>
                            </div>
                            <div class="col-sm-8">
                                <h3><?php echo $this->vote->getEnd() ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><b>Teilnehmer:</b></h3>
                            </div>
                            <div class="col-sm-8">
                                <h3>
                                    <div class="card">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fa fa-edit" style="font-size:36px"></i>
                                            Maxi
                                            <span class="badge badge-primary badge-pill">10</span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fa fa-comment-o" style="font-size:36px"></i>
                                            Julia
                                            <span class="badge badge-primary badge-pill">5</span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fa fa-github-square" style="font-size:36px"></i>
                                            Timon
                                            <span class="badge badge-primary badge-pill">3</span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <i class="fa fa-github-square" style="font-size:36px"></i>
                                            Jeffrey
                                            <span class="badge badge-primary badge-pill">5</span>
                                        </div>
                                    </div>
                            </div>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Ergebnisse</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <h3>Du hast diese Aufgabe auf <b>
                                    <font color="red"><span id="eigeneSchaetzung">4</span> Story Points</font>
                                </b> geschätzt!</h3><br>
                        </p>
                        <p class="card-text">
                            <h3>Bisher haben <b>
                                    <font color="red"><span id="anzahlTeilnehmerMitAbschaetzung">5</span> Teilnehmer</font>
                                </b> abgeschätzt.</h3><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                    <div>
                    </div>
                    <div><a href="" id="aktuellesSpielLink">
                            <i class="fa fa-link" style="font-size:48px;color:red"></i>
                            <h2>
                                <font color="red">Link</font>
                            </h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="templates/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="templates/js/popper.min.js"></script>
    <script src="templates/js/bootstrap/bootstrap.min.js"></script>
    <script src="templates/js/game.js"></script>
    <script>
        currentVote = <?php echo $this->voteData() ?>;
    </script>

</body>

</html>