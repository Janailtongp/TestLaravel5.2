<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SiteController extends Controller
{
	public function __construct(){
		//$this->middleware('auth')->only(['contato']);
        $this->middleware('auth');
    
	}
    //
    public function index(){
    	return 'Bem vindo ao site';
    }

    public function contato($id =0){
    	$titulo="Contato";
    	$xss = '<script>alert("Hackeado por JankieChan");</script>';
    	return view('site/sobre',["id"=>$id, "title"=>$titulo, "xss"=>$xss]);
    }

}
