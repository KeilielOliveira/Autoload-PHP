<?php

use Autoload\Autoload;

require('src/Autoload.php');

new Autoload([
    'Testes' => 'src/'
], [
    'load_undefined_class' => true
]);

new Src\ClasseDeTestes;

?>