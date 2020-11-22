<?php

namespace App\Http\Controllers;

use App\FactureProduit;
use Illuminate\Http\Request;

class FactureProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FactureProduit.index');
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
        //facture_id">
        //  "produit_id">
        // "qty">
        $facturPro = new FactureProduit();
        $facturPro->facture_id = $request->facture_id;
        $facturPro->produit_id = $request->produit_id;
        $facturPro->qty = $request->qty;
        $facturPro->save();
        return "saved";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function show(FactureProduit $factureProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(FactureProduit $factureProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FactureProduit $factureProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(FactureProduit $factureProduit)
    {
        //
    }
}
