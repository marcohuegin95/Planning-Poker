<?php
require 'Page.php';
require 'MessagePage.php';

/**
 * DashboardPage
 * 
 * Zeigt das Dashboard eines users an
 * @author Timon Müller-Wessling
 */
class DashboardPage extends MessagePage implements Page{


    private $invites = [];

    private $oldgames = [];

    function __construct($votes) {
        $this->extractInvites($votes);
    }

    public function render(){
        include ("templates/dashboard.php");
    }

    /**
     * Teilt die übergeben votes anhand ihres Endes in
     * Einladungen und Abgelaufenen Spiele ein und speichert
     * diese in die vorgesehenen Attibute
     */
    private function extractInvites($votes){
        $now = new DateTime();

        foreach($votes as $vote){
            $date = new DateTime($vote->getEnd());
            if ($date < $now){
                $this->oldgames[] = $vote;
            }else{
                $this->invites[] = $vote;
            }
        }
    }

    /**
     * Gibt den Html code einer Liste der Einladungen zurück
     */
    private function displayInvites(){
        $items = '';
        foreach($this->invites as $invite){
            $items .= '<div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">'.$invite->getName().'</h5>
                                    <small>'.$invite->getEnd().'</small>
                                </div>
                                <div class="mb-1">
                                    <a href="/game?id='.$invite->getId().'" class="btn btn-lg btn-success">Teilnehmen</a>
                                </div>
                            </div>
                        </div>
                       </div>';
        }
        if ($items === ''){
            $items = 'Keine Einladungen';
        }
        return $items;
    }

    /**
     * Gibt den Html code einer Liste alter spiele zurück
     */
    private function displayOldGames(){
        $items = '';
        foreach($this->oldgames as $oldgame){
            $items .= '<div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">'.$oldgame->getName().'
                                    </h5>
                                    <small>'.$oldgame->getEnd().'</small>
                                </div>
                                <div class="mb-1">
                                    <a href="/game?id='.$oldgame->getId().'" class="btn btn-lg btn-success">Aufrufen</a>
                                </div>
                            </div>
                        </div>
                       </div>';
        }
        if ($items === ''){
            $items = 'Keine vergangenen Spiele';
        }
        return $items;
    }
}