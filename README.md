# Autoload

Essa classe tem como função o autocarregamento de outras classes.
Atualmente bem simplificada somente para usos mais comuns.

**Exemplo:**
```php
<?php

require('src/Autoload.php');

/*
Registra o namespace Testes.
*/

new Autoload\Autoload([
    'Testes' => 'src/'
]);

?>
```

Por horá somente duas funcionalidades foram implementadas. O registro de namespaces para carregar classes e a possibilidade de tentar carregar classes não registradas.

Para tentar carregar as classes não registradas deve-se passar um segundo parâmetro para o contrutor.

**Exemplo:**
```php
<?php

require('src/Autoload.php');

new Autoload\Autoload([
    'Testes' => 'src/'
], [
    'load_undefined_class' => true
]);

?>
```

Ao passar o segundo parametro de configurações com o **load_undefined_class** a classe irá tentar carregar as classes não correspondem a nenhum namespace registrado. Para que isso aconteça o namespace dessas classes deve corresponder também com o caminho do ROOT até o arquivo php da classe, caso contrario não será possivel carregar.

Atualmente a classe não possui tratamentos de erro, os erros emitidos são os padrões do php.