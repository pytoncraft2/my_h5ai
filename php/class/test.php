<?php

class Test
{
    public $chemin = array();

    public function __construct()
    {
    }

    public function __toString()
    {
      $html = "<div id=recherche><input type=text value=recherche></div>";
        $html .= "<div class='liste-gauche'></div>";
        $html .= "<div class='liste-droite'>";
        $html .= "<div id='apres'><div><a href='..' id='av'><div class='avant'></div></a></div>" .$_SERVER['DOCUMENT_ROOT']. $_SERVER['REQUEST_URI'] ."  <div id=ap></div></div><a href='..'><div id='back'>...</div></a>";
        $html .= count($this->chemin[0]) > 0 ? "" : "Vide &#129335;";
        foreach ($this->chemin[0] as $value) {
            $type = is_dir($value) == 1 ? "dossier" : 'fichier';
            $html .= "<a href=" . basename(($value)) . " class='bloc' draggable='true'><div class='" . $type . "'></div><div class='nom'> " . basename(($value)) . "</div><div class='byte'>" .  filesize($value) . " bytes</div><div class='date'> " . date("F d Y H:i:s.", filemtime($value)) . "</div></a><br>";
        }
        $html .= "</div>";
        return $html;
    }

    public function lis_dos($path)
    {
        $paths = [];
        if (is_dir($path)) {
            foreach (scandir($path) as $name) {
                if ($name !== '.' && $name !== '..') {
                    $paths[] = $path . '/' . $name;
                }
            }
        }
        $this->chemin[0] = $paths;
        return $paths;
    }
}
