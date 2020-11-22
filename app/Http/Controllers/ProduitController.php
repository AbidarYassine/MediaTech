<?php

namespace App\Http\Controllers;

use App\Produit;
use Illuminate\Http\Request;
use App\Http\Requests\ProduitRequest;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::all();
        // dd(count($produits));
        return view('produit.index')->with('produits', $produits);
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
    public function store(ProduitRequest $request)
    {
        $produit = Produit::create([
            //   'ref_produit','prix_unitaire','quantity_stock','libelle',
            'ref_produit' => $request->ref_produit,
            'prix_unitaire' => $request->prix_unitaire,
            'quantity_stock' => $request->quantity_stock,
            'libelle' => $request->libelle,
        ]);
        $request->session()->flash('success', "product  created Successfully");
        toast(session('success'), 'success');
        return redirect(route('produit.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //
    }
    public function updateProduit(Request $request)
    {
        $produit = Produit::find($request->product_id);
        $request->validate([
            'ref_produit' => ['required', 'String', \Illuminate\Validation\Rule::unique('produits')->ignore($produit->id)],
            'prix_unitaire' => ['required', 'numeric'],
            'quantity_stock' => ['required', 'integer'],
            'libelle' => ['required', 'string'],
        ]);

        // 'ref_produit','prix_unitaire','quantity_stock','libelle',
        $produit->ref_produit = $request->ref_produit;
        $produit->prix_unitaire = $request->prix_unitaire;
        $produit->quantity_stock = $request->quantity_stock;
        $produit->libelle = $request->libelle;
        $produit->save();
        $request->session()->flash('success', "product  updated Successfully");
        toast(session('success'), 'success');
        return redirect(route('produit.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        //
    }
    public function deleteproduit($id)
    {
        $produit = Produit::find($id);
        $produit->delete();
        session()->flash('success', "product  deleted Successfully");
        toast(session('success'), 'success');
        return redirect(route('produit.index'));
    }
    public function getProduitSelection(Request $request)
    {
        $output = '';
        if (($request->products) == null) {
            return response()->json([
                'status' => false,
                'message' => 'no item selected'
            ]);
        } else {
            foreach ($request->products as $product) {
                // 'ref_produit','prix_unitaire','quantity_stock','libelle',
                $produit = Produit::find($product);
                $output .= '<tr>
                <td>' . $produit->id . '</td>
                <td>' . $produit->prix_unitaire . '</td>
                <td>' . $produit->quantity_stock . '</td>
                <td>  <input class="input_qty" id="qty_demande" type="number" min="1" value="1" name="qty_demnde[]"> </td>
      </tr>';
            }
            return response()->json([
                'products' => $output,
                'status' => true,
            ]);
        }
    }
    public function getDemandeProduit()
    {
        $produits = Produit::all();
        $produitFaible = [];
        $produitMoyen = [];
        $produitFort = [];
        foreach ($produits as $produit) {
            $resulta = DB::select("SELECT sum(fp.qty) as qty_demande
            FROM facture_produits fp
            WHERE fp.produit_id=$produit->id");
            if ($resulta[0]->qty_demande > 15) {
                $produit->setAttribute('demande', 'fort');
                $produit->setAttribute('qtyDemande', $resulta[0]->qty_demande);
                $produitFort[] = [$produit];
            } else if ($resulta[0]->qty_demande >= 11) {
                $produit->setAttribute('demande', 'moyene');
                $produit->setAttribute('qtyDemande', $resulta[0]->qty_demande);
                $produitMoyen[] = [$produit];
            } else {
                $produit->setAttribute('demande', 'faible');
                $produit->setAttribute('qtyDemande', $resulta[0]->qty_demande);
                $produitFaible[] = [$produit];
            }
        }
        // dd($produitFaible, $produitMoyen, $produitFort);
        return view('produit.demande')->with('produitFaible', $produitFaible)
            ->with('produitMoyen', $produitMoyen)
            ->with('produitFort', $produitFort);
    }
}
