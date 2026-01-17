<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLoteRequest;
use App\Models\Lote;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lotes = Lote::paginate(10);
        return Inertia::render('Lote/Index',compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $lote = null;
        return Inertia::render('Lote/Form', compact('lote'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLoteRequest $request)
    {
        //
        Lote::create($request->all());
        return redirect()->route('lote.index');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Lote $lote)
    // {
    //     //
    //     return Inertia::render('Lote/Form',compact('lote'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lote $lote)
    {
        //
        return Inertia::render('Lote/Form',compact('lote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateLoteRequest $request, Lote $lote)
    {
        //
        $lote->update($request->all());
        return redirect()->route('lote.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lote $lote)
    {
        //
        $lote->delete();
        return redirect()->route('lote.index');
    }
}
