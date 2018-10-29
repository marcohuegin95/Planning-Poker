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
                        <a class="dropdown-item" href="/dashboard">Dashboard</a>
                        <a class="dropdown-item" href="Logout">Log out</a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 text-center" id="abgelaufenPlaceholder">
            
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>
                            User-Story <b>[<span id="aktuelleUserStoryNr">1</span>/<span id="anzahlStorys">10</span>]</b>
                            <a href="#">
                                <i style="font-size:20px;color:blue" id="storyZurueck">zurück </i>
                            </a>
                            <a href="#">
                                <i style="font-size:20px;color:blue" id="storyVorwaerts"> vor</i>
                            </a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title" id="aktuelleUserStoryTitel">Lade...</h2>
                        </br>
                        <p class="card-text" id="aktuelleUserStoryBeschreibung">Lade...
                            <br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>
                            Schätzung: <b id="projektname">
                                <?php echo $this->vote->getName() ?></b>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="buttonAbschaetzung">
                            <button class="btn btn-primary m-1 p-1" id="button_Null" value="0" onclick="setValueFromVoteButtonToAjax(this.value, button_Null)">
                                <div class="numberCircle">0</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_EinHalb" value="0.5" onclick="setValueFromVoteButtonToAjax(this.value, button_EinHalb)">
                                <div class="numberCircleWithComma">0,5</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Eins" value="1" onclick="setValueFromVoteButtonToAjax(this.value, button_Eins)">
                                <div class="numberCircle">1</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Zwei" value="2" onclick="setValueFromVoteButtonToAjax(this.value, button_Zwei)">
                                <div class="numberCircle">2</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Drei" value="3" onclick="setValueFromVoteButtonToAjax(this.value, button_Drei)">
                                <div class="numberCircle">3</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Fuenf" value="5" onclick="setValueFromVoteButtonToAjax(this.value, button_Fuenf)">
                                <div class="numberCircle">5</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Acht" value="8" onclick="setValueFromVoteButtonToAjax(this.value, button_Acht)">
                                <div class="numberCircle">8</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Dreizehn" value="13" onclick="setValueFromVoteButtonToAjax(this.value, button_Dreizehn)">
                                <div class="numberCircle">13</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Zwanzig" value="20" onclick="setValueFromVoteButtonToAjax(this.value, button_Zwanzig)">
                                <div class="numberCircle">20</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Vierzig" value="40" onclick="setValueFromVoteButtonToAjax(this.value, button_Vierzig)">
                                <div class="numberCircle">40</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Hundert" value="100" onclick="setValueFromVoteButtonToAjax(this.value, button_Hundert)">
                                <div class="numberCircleHundert">100</div></br>SP
                            </button>
                            <button class="btn btn-primary m-1 p-1" id="button_Fragezeichen" value="-1" onclick="setValueFromVoteButtonToAjax(this.value, button_Fragezeichen)">
                            <div class="numberCircle">?</div></br>SP
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Statistik</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><b>Ende:</b></h3>
                            </div>
                            <div class="col-sm-8">
                                <h3>
                                    <?php echo $this->vote->getEnd() ?>
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3><b>Teilnehmer:</b></h3>
                            </div>
                            <div class="col-sm-8" id="currentUserBox">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Ergebnisse</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <h3>Du hast diese Aufgabe <b>
                                    <font color="red"><span id="eigeneSchaetzung">noch nicht geschätzt!</span></font>
                                </b>
                            </h3><br>
                        </p>
                        <p class="card-text">
                            <h3>Bisher haben<b>
                                    <font color="red"><span id="anzahlTeilnehmerMitAbschaetzung"></span> Teilnehmer</font>
                                </b> abgeschätzt.</h3><br>
                        </p>
                        <div id="summary">
                        <p class="card-text">
                            <h3>Ergebniss des Spieles ist  <b>
                                    <font color="red"><span id="durchschnitt"></span> </font>
                                </b> Story points</h3><br>
                        </p>    
                    </div>
                        
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
        currentVote = <?php echo $this -> voteData() ?>;
    </script>

</body>

</html>