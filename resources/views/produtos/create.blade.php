@extends('produtos.template.template')
@section('content')

@if(isset($product))
	<h1 class="title-pg"> Editar Produto</h1>
@else
	<h1 class="title-pg"> Cadastro de Produtos</h1>
@endif
	
		@if(isset($errors) && count($errors)>0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $erro)
				<p>{{$erro}}</p>
				@endforeach
			</div>
		@endif
	

	 @if(isset($product))
	<form class="form" method="post" action="{{route('painel.produtos.update',$product->id)}}" enctype="multipart/form-data">
		{!!method_field('PUT')!!}
	@else
	<form class="form" method="post" action="{{route('painel.produtos.store')}}" enctype="multipart/form-data">
	@endif		
		 {!! csrf_field() !!}
		<div class="form-group">
			<input type="text" name="name" placeholder="Nome" class="form-control" value="{{$product->name or old('name')}}">
		</div>
		<div class="form-group">
			<label><input type="checkbox" name="active" value="1" @if(isset($product) && $product->active == '1') checked @endif>  <b>Ativo?</b></label>
		</div>
		<div class="form-group">
			<input type="text" name="number" placeholder="Número" class="form-control" value="{{$product->number or old('number')}}">
		</div>
		<div class="form-group">
			<select class="form-control" name="category">
				<option value="">Escolha uma categoria</option>
				@foreach($categorys as $cat)
				<option value="{{$cat}}" @if(isset($product) && $product->category == $cat) selected @endif>
					{{$cat}}
				</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<textarea class="form-control" name="description" placeholder="Descrição" >{{$product->description or old('description')}}</textarea>
		</div>

		<div class="form-group">
			<input type="file" name="image" class="form-control" value="{{$product->image or old('image')}}">
		</div>

		<button class="btn btn-primary">Cadastrar</button>
	</form>

@endsection