<div class="modal fade" id="AddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddClient">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('produit.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ref_produit" class="col-form-label">Reference Produit</label>
                        <input type="text" class="form-control @error('ref_produit') is-invalid @enderror" id="ref_produit" name="ref_produit" value="{{old('ref_produit')}}">
                        @error('ref_produit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="libelle" class="col-form-label">Libelle</label>
                        <input type="text" class="form-control @error('libelle') is-invalid @enderror" name="libelle" id="libelle" value="{{old('libelle')}}">
                        @error('libelle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenom" class="col-form-label">prix unitaire</label>
                        <input type="text" class="form-control @error('prix_unitaire') is-invalid @enderror" id="prix_unitaire" name="prix_unitaire" value="{{old('prix_unitaire')}}">
                        @error('prix_unitaire')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity_stock" class="col-form-label">Quantity en stock</label>
                        <input type="number" min="1" class="form-control @error('quantity_stock') is-invalid @enderror" id="quantity_stock" name="quantity_stock" value="{{old('quantity_stock')}}">
                        @error('quantity_stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
