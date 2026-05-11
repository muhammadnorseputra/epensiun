<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import library dari RestController
use chriskacerguis\RestServer\RestController;

class Welcome extends RestController
{
  public function example_get()
  {
    echo "Called is called by Get method";
  }

  public function example_post()
  {
   echo "Called is called by Post method";
  }
}

?>