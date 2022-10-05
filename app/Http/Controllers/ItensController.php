<?php

namespace App\Http\Controllers;

use App\Models\Fluxo;
use App\Models\Item;
use Illuminate\Http\Request;

class ItensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['itens'] = Item::where('ativo', 1)->get();
        return view('itens.index')->with($data);
    }

    public function inativos()
    {
        $data['itens'] = Item::where('ativo', 0)->get();
        return view('itens.inativos')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(sizeof($request->keys()) == 1)
            $item = Item::find($request->keys()[0]);
        else
            $item = false;

        $nome = Item::select('nome')->distinct()->get()->toArray();
        $marca = Item::select('marca')->distinct()->get()->toArray();
        $categoria = Item::select('categoria')->distinct()->get()->toArray();
        $local = Item::select('local')->distinct()->get()->toArray();
        return view('itens.create', ['item' => $item, 'nome' => json_encode($nome), 'marca' => json_encode($marca),
            'categoria' => json_encode($categoria), 'local' => json_encode($local)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'local' => 'required',
            'marca' => 'required',
            'categoria' => 'required',
        ]);

        $request_data = $request->all();

        $create = Item::create([
            'nome' => $request_data['nome'],
            'qtd' => $request_data['qtd'],
            'local' => $request_data['local'],
            'marca' => $request_data['marca'],
            'categoria' => $request_data['categoria'],
            'barcode' => $request_data['barcode'],
            'entrada' => $request_data['entrada'],
            'validade' => $request_data['validade'],
        ]);
        $fluxo = Fluxo::create([
            'id_item' => $create->id,
            'qtd' => $create->qtd,
            'tipo' => 0
        ]);

        return redirect()->route('show', $create->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = Item::find($request->keys()[0]);
        $fluxo = Fluxo::where('id_item', $item->id)->get();
        return view('itens.show', ['item' => $item, 'fluxo' => $fluxo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $item = Item::find($request->keys()[0]);
        return view('itens.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'local' => 'required',
        ]);
        $item = Item::find($request->input('id'));
        $item->update($request->except('id'));
        return redirect()->route('show', $item->id);
    }

    public function fluxo(Request $request)
    {
        $item = Item::find($request->input('i'));
        $t = $request->input('t');
        $q = $request->input('q');
        if ($t == 's'){
            $item->qtd = $item->qtd - $q;
            $item->update(['saida' => now()]);
        }else{
            $item->qtd = $item->qtd + $q;
            $item->update(['entrada' => now()]);
        }
        $fluxo = Fluxo::create([
            'id_item' => $item->id,
            'qtd' => $q,
            'tipo' => $t == 's'
        ]);

        return redirect()->route('show', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Item::find($request->keys()[0]);
        Fluxo::where('id_item', $item->id)->delete();
        $item->delete();
        return redirect()->route('index');
    }

    public function enable(Request $request)
    {
        $item = Item::find($request->keys()[0]);
        $item->update(['ativo' => !$item->ativo]);
        return redirect()->route('index');
    }
}
