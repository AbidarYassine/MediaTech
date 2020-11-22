<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'ref_produit','prix_unitaire','quantity_stock','libelle',
            'ref_produit' => ['required', 'String', 'unique:produits'],
            'prix_unitaire' => ['required', 'numeric'],
            'quantity_stock' => ['required', 'integer'],
            'libelle' => ['required', 'string'],
        ];
    }
}
