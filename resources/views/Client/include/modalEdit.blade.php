<div class="modal fade" id="EditClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddClient">Update Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('client.updateClient')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_cli" id="id_cli">
                    <div class="form-group">
                        <label for="nom" class="col-form-label">nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nomu" name="nom">
                        @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenom" class="col-form-label">prenom</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenomu" name="prenom">
                        @error('prenom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code_client" class="col-form-label">Code Client</label>
                        <input type="text" class="form-control @error('code_client') is-invalid @enderror" id="code_clientu" name="code_client">
                        @error('code_client')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tele" class="col-form-label">telephone</label>
                        <input type="text" class="form-control @error('tele') is-invalid @enderror" name="tele" id="teleu">
                        @error('tele')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
