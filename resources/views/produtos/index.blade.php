@extends('produtos.template.template')
@section('content')
	<h1 class="title-pg"> Produtos do BD</h1>
	
	<a href="{{route('painel.produtos.create')}}"type="button" class="btn btn-primary btn-add">
		<span class="glyphicon glyphicon-plus"></span> Cadastrar 
	</a>
		<table class="table table-striped">
			<tr>
				<th>Nome</th>
				<th>Descrição</th>
				<th width="100px">Ações</th>
			</tr>
			
				@foreach($produtos as $prod)
				<tr>
					<td>{{$prod->name}}</td>
					<td>{{$prod->description}}</td>
					<td>
						<a href="{{route('painel.produtos.edit', $prod->id)}}" class="actions edit">
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
						<a href="" class="actions delete">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>
				@endforeach
			
		</table>
		{!!$produtos->links()!!}
@endsection