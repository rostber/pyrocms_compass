<?php

class compass {

    public function init($css = '')
    {
      require "compass/vendor/autoload.php";
      require "compass/compass.inc.php";

      $scss = new scssc();
      new scss_compass($scss);

      return $scss->compile('@import "compass";'.$css);
    }
}
