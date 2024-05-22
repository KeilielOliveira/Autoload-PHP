<?php 

namespace Autoload;

use Exception;

class Autoload {
    
    protected static $namespaces;
    protected static $config;
    protected static $autoloads;

    public function __construct(array $namespaces, array $config = []) {
        
        self::$autoloads = ['loader', 'loadUndefinedClass'];
        self::$namespaces = $namespaces;
        self::$config = $config;

        //Registra todos os metodos de autoload dinamicamente.
        foreach (self::$autoloads as $key => $autoload) {
            
            spl_autoload_register([__CLASS__, $autoload]);
        }
    }

    /**
     * Carrega a classe se ela for encontrada.
     */
    protected function loader($namespace) {

        $namespace = explode('\\', $namespace);
        $class = array_pop($namespace);
        $namespace = implode('\\', $namespace);

        if(isset(self::$namespaces[$namespace])) {
            //Se esse namespace estiver registrado.

            $dir = self::$namespaces[$namespace]; //Recupera a pasta do namespace.
            $filename = $dir . $class . '.php';
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $filename); //Monta o nome do arquivo.
            if(file_exists($file)) {
                //Se o arquivo existir.

                require($file);
                return true;
            }
        }
    }

    protected function loadUndefinedClass($namespace) {

        if(isset(self::$config['load_undefined_class']) && self::$config['load_undefined_class']) {
            //Se foi permitido a tentativa de carregamento de classes não registradas.

            $namespace = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
            $file = $namespace . '.php';

            if(file_exists($file)) {
                //Se o arquivo for encontrado.

                require($file);
                return true;
            }

        }
    }

}

?>