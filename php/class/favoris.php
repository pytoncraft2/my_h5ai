<?php
class Favoris
{
    public function aff_fav()
    {
       $fav = explode(",", $_COOKIE['favoris']);
       $html = "<div class='fav'>";
       foreach ($fav as $liens) {
           $html .= "<div><a class='bloc' href='http://" . $_SERVER['HTTP_HOST'] . "/" . $liens . "'>" . $liens . "</a></div>";
       }
       $html .= "</div>";
       echo $html;
    }
}
