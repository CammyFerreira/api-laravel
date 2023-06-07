<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Produto::with('CATEGORIA')->where('produto_ativo', 1);
        $filterParameter = $request -> input("filtro");

        if($filterParameter == null) {
            $produtos = $query->get();

            $response = response() -> json([
                'status' => 200,
                'mensagem' => 'Lista de produtos retornada',
                'produtos' => ProdutoResource::collection($produtos)
            ], 200);
        } else {
            [$filterCriteria, $filterValue] = explode(':', $filterParameter);

            if($filterCriteria == 'id_produto') {
                $produtos = $query->where('PRODUTO_ID', $filterValue)->get();

                $response = response() -> json([
                    'status' => 200,
                    'mensagem' => 'Lista de produtos filtrada',
                    'produtos' => ProdutoResource::collection($produtos)
                ], 200);
            } else {
                $response = response() -> json([
                    'status' => 406,
                    'mensagem' => 'Filtro não aceito',
                    'produtos' => []
                ], 406);
            }
        }

        return $response;
    }

    public function searchByName(Request $request)
    {
        $nome = $request->input('nome');
        $produtos = Produto::where('PRODUTO_NOME', 'LIKE', '%' . $nome . '%')->get();;
        return ProdutoResource::collection($produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
