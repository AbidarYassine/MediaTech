<?php

namespace App\Http\Controllers;

use App\Client;
use App\Facture;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Produit;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function SeConnecter(Request $request)
    {
        $user = DB::table('users')->where('name', $request->name)->first();
        if ($user == null) {
            session()->flash('error', "invali user or password");
            toast(session('error'), 'error');
            return redirect(route('login.auth'));
        } else if (!Hash::check($request->password, $user->password)) {
            session()->flash('error', "invalid user or password");
            toast(session('error'), 'error');
            return redirect(route('login.auth'));
        } else {
            $request->session()->put('name', $user->name);
            $request->session()->put('id', $user->id);
            session()->flash('success', "Welcome ");
            toast(session('success'), 'success');
            return redirect(route('dashboard.index'));
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('id');
        $request->session()->forget('name');
        return redirect(route('login.auth'));
    }
    public function getAllUser()
    {
        $user = User::all();
        return view('User.index')->with('users', $user);
    }
    public function store(UserRequest $request)
    {
        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            session()->flash('success', "User created successfly ");
            toast(session('success'), 'success');
        } else {
            session()->flash('success', "User no  Created ");
            toast(session('success'), 'success');
        }
        return redirect(route('user.index'));
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $result = $user->delete();
        if ($result) {
            session()->flash('success', "User deleted successfly ");
            toast(session('success'), 'success');
        } else {
            session()->flash('error', "User no deleted ");
            toast(session('error'), 'error');
        }
        return redirect(route('user.index'));
    }
    public function dashbord()
    {
        return view('dashbord.index');
    }
    public function getDataProduitQty(Request $request)
    {
        $facture_produit = DB::table('facture_produits')
            ->whereYear('created_at', date('yy'))
            ->whereMonth('created_at', date('m'))
            ->whereDay('created_at', date('j'))
            ->get();
        $dataReference = [];
        $nbrClient = Client::all()->count();
        $nbrProduit = Produit::all()->count();
        $nbrFacture = Facture::all()->count();
        $dataQty = [];
        if (count($facture_produit) > 0) {
            foreach ($facture_produit as $proFacture) {
                $resulta = DB::select("SELECT sum(fp.qty) as qty_demande
            FROM facture_produits fp
            WHERE fp.produit_id=$proFacture->produit_id");
                $produit = Produit::find($proFacture->produit_id);
                if (!in_array($produit->ref_produit, $dataReference)) {
                    array_push($dataReference, $produit->ref_produit);
                    array_push($dataQty, $resulta[0]->qty_demande);
                }
            }
            return response()->json([
                'status' => true,
                'msg' => 'check data',
                'dataReference' => $dataReference,
                'dataQty' => $dataQty,
                'result' => $resulta[0]->qty_demande,
                'nbrClient' => $nbrClient,
                'nbrProduit' => $nbrProduit,
                'nbrFacture' => $nbrFacture,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'nbrProduit'=>$nbrProduit,
                'nbrClient'=>$nbrClient,
                'nbrFacture'=>$nbrFacture,
                'msg' => 'no facture yet',
            ]);
        }
    }
}
