<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //protected $table ='produtos';
    protected $fillable =[
    	'name', 'number', 'active', 'category', 'description', 'image'];
    //protected $guarded = [];
    	public $rules =[
			'name'		=> 'required|min:3|max:100',
			'number'	=> 'required|unique:produtos|numeric|digits_between:1,11',
			'category'	=> 'required',
			'description'	=> 'min:3|max:1000',
			'image' => 'required | mimes:jpeg,jpg,png | max:1024'
    	];

    	public $messages = [
            'name.required' 		=>'O campo nome é obrigatório',
            'name.min'				=>'O campo nome deve possuir no mínimo 3 caracteres',
            'name.max' 				=>'O campo nome deve possuir no máximo 100 caracteres',
            'number.required' 		=>'O campo número é obrigatório',
            'number.numeric' 		=>'O campo número deve possuir apenas números',
            'number.unique'         =>'O número do produto já existe, tente outro.',
            'number.digits_between' =>'O campo número deve possuir entre 1 e  11 caracteres',
            'description.min' 		=>'O campo descrição deve possuir no mínimo 3 caracteres',
            'description.max' 		=>'O campo descrição deve possuir no máximo 1000 caracteres',
            'category.required' 	=>'O campo categoria é obrigatório',
            'image.required'		=>'Imagem obrigatória',
            'image.mimes'			=>'Apenas imagens nos formatos jpeg e jpg',
            'image.max'				=>'Tamanho máximo da imagem é de 1MB',
		];

}
