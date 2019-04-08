@extends('site/template/template1')
@section('content')

	Janailton Galvão pereira {{$id}}
	<!-- {{$xss}} Com proteção a scripts inject !--> 

	<!-- {!!$xss!!} Sem proteção a scripts inject !--> 
	@if($id == 1)
		<p>É um</p>
	@else
		<p>Não é um</p>
	@endif

	@for($i = 0; $i < 10; $i++)
		<p>{{$i}}</p>

	@endfor
@endsection

{{--	Comentarios!!!!	--}}
@php 
		//comenados PHP
@endphp