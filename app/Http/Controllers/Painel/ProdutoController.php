<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use Khill\Lavacharts\Lavacharts;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $produto;
    private $totalpage = 3;

    public function __construct(Produto $prod){
            $this->produto = $prod;
            $this->middleware('auth');
    
    }

    public function index()
    {
        $title = "Listagem de produtos";    
        $produtos = $this->produto->paginate($this->totalpage);
        return view('produtos/index',["produtos"=>$produtos, "title"=>$title]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho']; 
        $title ="Cadasatro de Produtos";
        return view("produtos/create",["title"=>$title, "categorys"=>$categorys]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $dataform = $request->all();
        
        
        //$this->validate($request, $this->produto->rules);
        $validate = validator($dataform, $this->produto->rules, $this->produto->messages);
        if($validate->fails()){
            return redirect()->route('painel.produtos.create')
                ->withErrors($validate)
                ->withInput();
                
        }else{
            //TESTA SE TEM IMAGEM
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $name = time().$request->file('image')->getClientOriginalName();
                $destination = base_path() . '/public/uploads';
                $file->move($destination, $name);
                $dataform['image'] = $name;

             //SALVA O RESTANTE DOS DADOS      
                $insert =  $this->produto->create($dataform);
            return redirect()->route('painel.produtos.index')
                ->with(["errors"=>"{$dataform['name']} cadastrado com sucesso!"]);

            }else{
                return redirect()->back()->with('errors', 'Falha no envio da imagem');
            }

            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dados = $this->produto->all();
        //dd ($dados->category);
        
        $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho']; 
        $quantidade = array(0, 0, 0, 0);
        foreach ($dados as $produto) {  
            if($produto->category == $categorys[0])
                $quantidade[0] +=1;
            else if($produto->category == $categorys[1])
                $quantidade[1] +=1;
            else if($produto->category == $categorys[2])
                $quantidade[2] +=1;
            else if($produto->category == $categorys[3])
                $quantidade[3] +=1; 
        }

        $lava = new Lavacharts();
        $graficoCategorias =  $lava->DataTable();
        $graficoCategorias->addStringColumn('Categoria')->addNumberColumn('Quantidade de produtos');
        for($i = 1; $i <= count($quantidade); $i++){
            $graficoCategorias->addRow([$categorys[$i-1], $quantidade[$i-1]]); 

        }

        $lava->ColumnChart('Quantidade de produtos por categoria', $graficoCategorias);
       
        return view('produtos/show', ['categoria' => $categorys, 'lava'=> $lava]);
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->produto->find($id);

        $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho']; 
        $title ="Editar Produto: {$product->name}";
         return view("produtos/create",["title"=>$title, "categorys"=>$categorys,"product"=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $dataform = $request->all();
         $product = $this->produto->find($id);
         $validate = validator($dataform, $this->produto->rules, $this->produto->messages);
         if($validate->fails()){
            return redirect()->route('painel.produtos.edit',$id)
                ->withErrors($validate)
                ->withInput();
                
        }else{
         $update = $product->update($dataform);
         return redirect()->route('painel.produtos.index')
                ->with(["errors"=>"{$dataform['name']} editado com sucesso!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function tests(){
       
    /*
        INSERIR DADOS _______________
        $prod = $this->produto;
        $prod->name = "Carro M8";
        $prod->number = 2222;
        $prod->active = true;
        $prod->category = "eletronicos";
        $prod->description = "Descrição do meu produto";
        $insert = $prod->save();
        if($insert)
            return 'Deu certo!';
        else
            return 'Deu ruim!';
    */
    /*     
        INSERIR DADOS _______________
        $insert = $this->produto->create([
            'name'          => 'Produto 3',
            'number'        =>3333,
            'active'        =>false,
            'category'      =>'eletronicos',
            'description'   =>'produto 3 e sua descrição',
        ]);

        if($insert)
            return "Deu certo! ID: {$insert->id}";
        else
            return 'Deu ruim!';
    */
    /*        
        ATUALIZAR DADOS__________________
         //$prod = $this->produto->where('number',3030);    
         $prod = $this->produto->find(2);
        // dd($prod);   
        $up = $prod->update([
            'name'          => 'M8 Atualizado XD',
            'number'        =>3030,
            'active'        =>false,
            'category'      =>'eletronicos',
            'description'   =>'M8 atualizado e sua descrição',
        ]);

        if( $up )
            return "Atualizado XD!";
        else
            return 'Não Atualizou!'; 
    */
    /*
       DELETANDO __________________
        $prod = $this->produto->find(4);
        $dell = $prod->delete();
        if( $dell )
            return "Deletado!";
        else
            return 'Não Deletado!'; 
     */
    }
}
