<?php
require 'Page.php';

/**
 * DashboardPage
 *
 * Dashboard Page which renders the Dashboard Site
 */
class DashboardPage implements Page{


    private $invites = [];

    private $oldgames = [];

    function __construct($votes) {
        $this->extractInvites($votes);
    }

    public function render(){
        include ("templates/dashboard.php");
    }

    /**
     * Extracts the old games and invites from the given paramter
     * and saves them in the fields invites and oldgames
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
                                <p class="mb-1">Kleine Beschreibung des tollen Projektes
                                    <button href="#" class="btn btn-lg btn-success">Teilnehmen</button>
                                    <button href="#" class="btn btn-default"><i class="fa fa-trash-o" style="font-size:30px;color:red"></i></button>
                                </p>
                            </div>
                        </div>
                       </div>';
        }
        if ($items === ''){
            $items = 'Keine Einladungen';
        }
        return $items;
    }

    private function displayOldGames(){
        $items = '';
        foreach($this->oldgames as $oldgame){
            $items .= '<div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">'.$oldgame->getName().'
                                        <span class="badge badge-success">45SP</span>
                                    </h5>
                                    <small>'.$oldgame->getEnd().'</small>
                                </div>
                                <p class="mb-1">
                                    Kleine Beschreibung des tollen Projektes
                                    <a href="#">
                                        <i class="fa fa-external-link" style="font-size:40px;color:white"></i>
                                    </a>
                                </p>
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