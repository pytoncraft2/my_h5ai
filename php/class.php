<?php
class Charger
{

    private static $cheminDoss = ['class', 'test'];

    public function go()
    {
        spl_autoload_register(['Charger', 'chargeDoss']);
        $recursive = new Test();
        $favoris = new Favoris();
        $arbre = new Arbre();
        $recursive->lis_dos($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']);
        echo $recursive->__toString();
        require __DIR__ . '/pages/default.php';
        $favoris->aff_fav();
        $arbre->totalarray($_SERVER['DOCUMENT_ROOT']);

    }

    public function chargeDoss($class_name)
    {

        $filename = strtolower($class_name) . '.php';
        foreach (Charger::$cheminDoss as $chemin) {
            $file = __DIR__  . '/' . $chemin . '/' . $filename;
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
        }
    }
}
