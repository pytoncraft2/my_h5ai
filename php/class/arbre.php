<?php
class Arbre
{
    public $paths = [];
    public $chemin = array();

    public function __construct()
    {
    }
    public function aff($arbre)
    {
        $resultat = $this->rglob($arbre);
        echo "<div class='arbre'>" . $resultat . "</div><button></button>";
    }

    public function rglob($arbre)
    {
        $mark ='';
        foreach ($arbre as $branch => $pbranch) {
            $mark .= "<li><span class=i ></span><a href=" . str_replace($_SERVER['DOCUMENT_ROOT'],"",$branch) . '>' . (is_array($pbranch) ? basename($branch) . $this->rglob($pbranch) : $pbranch) . '</a></li>';
        }
        return "<ul class='el'>" . $mark . "</ul>";
    }


    public function totalarray($toCheck)
    {
        $this->aff($this->dossier_scan($toCheck));
    }

    public function dossier_scan($path)
    {
        $arbre= [];
        $scan = scandir($path);
        foreach ($scan as $value) {
            if ($value == '.' || $value == '..') {
                continue;
            }

            $chemin = $path  . '/' . $value;

            if (is_dir($chemin)) {
                $arbre[$chemin] =  $this->dossier_scan($chemin);
            }
        }
        return ($arbre);
    }
}
