@extends('produtos.template.template')
@section('content')

<div id="graph"></div>

{!! $lava->render('ColumnChart', 'Quantidade de produtos por categoria', 'graph')!!}

@endsection

<!-- 

"Khill/lavacharts":"3.0"  no  "require": { AQUI } em composer.json 

via terminal dar um "composer update" 

depois na pasta config abra o app.php e registra  o 'providers' com:

Khill\Lavacharts\Laravel\LavachartsServiceProvider::class,

Deois em 'aliases' => [AQUI ]; adiciona 
'Lava' => Khill\Lavacharts\Laravel\LavachartsFacade::class,

Chama no controller 

use Khill\Lavacharts\Lavacharts;


--> 