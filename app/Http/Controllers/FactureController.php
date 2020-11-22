<?php

namespace App\Http\Controllers;

use App\Client;
use App\Facture;
use App\FactureProduit;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::all();

        // foreach ($factures as $facture) {
        //     $cliet = $facture->client;
        //     $factureCli[] = [$facture, $facture->client];
        // }
        // dd($factureCli);
        foreach ($factures as $factuCli) {
            if ($factuCli->client !== null) {
                $factuCli->setAttribute('client', $factuCli->client);
            }
        }
        //  dd($factures);
        return view('facture.index')->with('factures', $factures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $products = Produit::all();
        return view('facture.create')->with('clients', $clients)
            ->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produits = $request->produits;
        $qty_demande = $request->qty_demnde;
        $size = count($produits);
        $erros = [];
        for ($i = 0; $i < $size; $i++) {
            $produit = Produit::find($produits[$i]);

            if ($produit->quantity_stock <   $qty_demande[$i]) {
                $erros[] = [$produit->libelle];
            }
        }
        $client = Client::find($request->client);
        $date =  date('d/m/yy');
        if (count($erros) > 0) {
            return response()->json([
                'status' => false,
                'error' => $erros,
                'msg' => 'quantity Insufissante',
            ]);
        } else {
            $facture = Facture::create([
                'code_facture' => $request->code_facture,
                'date_creation' => $date,
                'client_id' => $client->id,
            ]);
            $facture_id = DB::table('factures')->max('id');
            $output = "";
            $total = 0;
            for ($i = 0; $i < $size; $i++) {
                $produit = Produit::find($produits[$i]);
                $total += $produit->prix_unitaire * $qty_demande[$i];
                $factProduit = FactureProduit::create([
                    'facture_id' => $facture_id,
                    'produit_id' => $produits[$i],
                    'qty' => $qty_demande[$i],
                ]);
                $output .= '<tr>
                    <td>' . $produit->ref_produit . '</td>
                    <td>' . $produit->libelle . '</td>
                    <td>' . $produit->prix_unitaire . '</td>
                    <td>' . $qty_demande[$i] . '</td>
                    <td>' . $qty_demande[$i] * $produit->prix_unitaire . '</td>
                    </tr>';
            }
            return response()->json([
                'status' => true,
                'facture_id' => $facture_id,
                'resumer' => $output,
                'message' => 'Facture aded successfly',
                'total' => $total,
            ]);
        }
    }
    public function getPdfFacture($id)
    {
        $facture = Facture::find($id);
        // dd($facture, $facture->produits);
        $client = Client::find($facture->client_id);
        $tabProduct = [];
        $ligne_factures = DB::table('facture_produits')->where('facture_id', $id)->get();
        $total = 0;
        foreach ($ligne_factures as $ligne_facture) {
            $produit = Produit::find($ligne_facture->produit_id);
            $tabProduct[] = [$produit, $ligne_facture->qty];
            $total += $produit->prix_unitaire * $ligne_facture->qty;
        }
        // dd($tabProduct);
        $data = [
            'facture' => $facture,
            'produits' => $tabProduct,
            'client' => $client,
            'total' => $total,
        ];
        $pdf = PDF::loadView('facture.apercu', $data);
        return $pdf->download('Facture.pdf');
    }

    public function showFacture($id)
    {
        $facture = Facture::find($id);
        // dd($facture, $facture->produits);
        $client = Client::find($facture->client_id);
        $tabProduct = [];
        $ligne_factures = DB::table('facture_produits')->where('facture_id', $id)->get();
        $total = 0;
        foreach ($ligne_factures as $ligne_facture) {
            $produit = Produit::find($ligne_facture->produit_id);
            $tabProduct[] = [$produit, $ligne_facture->qty];
            $total += $produit->prix_unitaire * $ligne_facture->qty;
        }
        return view('facture.show')->with([
            'facture' => $facture,
            'produits' => $tabProduct,
            'client' => $client,
            'total' => $total,
        ]);
    }

    public function deletefacture($id)
    {
        $status = $this->deletFactureService($id);
        if ($status) {
            session()->flash('success', "facture  deleted Successfully");
            toast(session('success'), 'success');
        } else {
            session()->flash('error', "facture doesn't existe");
            toast(session('error'), 'error');
        }
        return redirect(route('facture.index'));
    }

    public function getCodeFacture($code)
    {
        $facture = DB::table('factures')->where('CODE_FACTURE', $code)->first();
        if ($facture != null) {
            return response()->json([
                'status' => false,
                'message' => 'Code already token'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => ''
            ]);
        }
    }
    public function deletFactureService($id)
    {
        $facture = Facture::find($id);
        if ($facture != null) {
            // dd($facture);
            $facture_produit = DB::table('facture_produits')->where('FACTURE_ID', $facture->id)->get();
            // dd($facture_produit);
            foreach ($facture_produit as $factProduit) {
                $facture_produit = FactureProduit::find($factProduit->id);
                $produit = Produit::find($factProduit->produit_id);
                $produit->update([
                    'quantity_stock' => $produit->quantity_stock + $factProduit->qty,
                ]);
                $facture_produit->delete();
            }
            $facture->delete();

            return true;
        } else {
            return false;
        }
    }
}
