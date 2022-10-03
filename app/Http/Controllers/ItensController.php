<?php

namespace App\Http\Controllers;

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
        $data['itens'] = Item::paginate(10);
        return view('itens.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('itens.create');
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
            'local' => $request_data['local'],
            'marca' => $request_data['marca'],
            'categoria' => $request_data['categoria'],
            'barcode' => $request_data['barcode'],
            'entrada' => $request_data['entrada'],
            'validade' => $request_data['validade'],
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
        return view('itens.show', compact('item'));
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

    public function checkout(Request $request)
    {
        $item = Item::find($request->keys()[0]);
        $item->update(['saida' => now()]);
        return redirect()->route('show', $item->id);;
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
        $item->delete();
        return redirect()->route('index');
    }
}
