<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Neues Spiel erstellen</title>
    <!--link rel="stylesheet" href="/templates/css/addgame.css"-->
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
            <ol class="navbar-nav">
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
            </ol>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="text-center">
            <h1>Neues Spiel erstellen</h1>
        </div>
        <form method="post" action="/savenewgame">
            <div class="row justify-center">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4><label>Titel <font color="red"><label id="warnungTitel"></label></font></label></h4>
                        <input id="in_titelNeuesProjekt" name="game_name" type="text" class="form-control" id="titelNeuesSpiel"
                            placeholder="Titel eingeben" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4><label>Enddatum </label></h4>
                    <div class="input-group">
                        <div class="form-group" style="width: 100%">
                            <input class="form-control" style="width: 100%" type="date" id="enddatum" name="enddatum"
                                min="2018-01-01" required />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h4><label>Teilnehmer <font color="red"><label id="warnungTeilnehmerHinzufuegen"></label></font></label></h4>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Verfügbare Teilnehmer</label>
                        </div>
                        <select class="custom-select" id="in_teilnehmer" name="users[]" required>
                            <?php echo $this->displayUserList() ?>
                        </select>
                    </div>


                </div>

                <div class="col-12">
                    <ul class="list-group">
                    </ul>
                    <div class="col-*-*">
                        <div class="row top-buffer"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <h4><label>User-Story hinzufügen <font color="red"><label id="warnungUserStoryHinzufuegen"></label></font></label></h4></label></h4>

                        <div class="row clearfix">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Titel
                                            </th>
                                            <th class="text-center">
                                                Beschreibung
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0' data-id="0">
                                            <td data-name="story_names">
                                                <input type="text" id="in_storyTitel" placeholder='Story-Titel eingeben'
                                                    name="story_names[]" class="form-control" required/>
                                            </td>
                                            <td data-name="story_descriptions">
                                                <input type="text" id="in_storyBeschreibung" placeholder='Beschreibung eingeben'
                                                    name="story_descriptions[]" class="form-control" required/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="button" id="btn_storyHinzufuegen" class="btn btn-primary">User-Story hinzufügen</button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save" style="font-size:36px"></i>
                            Speichern</button>
                        <a href="/dashboard" class="btn btn-lg btn-danger"><i class="fa fa-times" style="font-size:36px"></i>
                            Abbrechen</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="templates/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="templates/js/popper.min.js"></script>
    <script src="templates/js/bootstrap/bootstrap.min.js"></script>
    <script src="templates/js/addgame.js"></script>

</body>

</html>