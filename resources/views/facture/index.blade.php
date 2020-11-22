@extends('admin.include.default')
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="col-md-12">
    @if(session()->has('success'))
    <center>
        <div class="alert alert-success col-md-12 justify-content-center">
            {{session()->get('success')}}
        </div>
    </center>
    @endif
    @if(session()->has('error'))
    <center>
        <div class="alert alert-success col-md-12 justify-content-center">
            {{session()->get('error')}}
        </div>
    </center>
    @endif
    <div class="row">
        <div class="col-md-6">
            <a href="{{route('facture.create')}}" class="btn btn-success">
                <i class="fas fa-plus fa-1x mr-1"></i>Add new Facture
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">All Factures</div>
                <div class="card-body">
                    <table id="table_facture" class="table table-bordered mt-3" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Code Facture</th>
                                <th>date creation</th>
                                <th>Nom Client</th>
                                <th>Prenom Client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factures as $facture)
                            <tr>
                                <td>{{$facture->id}}</td>
                                <td>{{$facture->code_facture}}</td>
                                <td>{{$facture->date_creation}}</td>
                                <th>{{$facture->client->nom}}</th>
                                <th>{{$facture->client->prenom}}</th>
                                <th>
                                    <a href="{{route('facture.showFact',$facture->id)}}" class="btn btn-sm btn-info">Show</a>
                                    <a href="/admin/facture/delete/{{$facture->id}}" class="btn_delete btn btn-sm btn-danger">delete</a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        let item1 = '<li class="breadcrumb-item active">Facture</li>';
        var item2 = '<li class="breadcrumb-item active">Index</li>';
        $("#list_breadcrumb").append(item1);
        $("#list_breadcrumb").append(item2);
        $('#table_facture').DataTable({
            "order": [
                [3, "desc"]
            ],
            "paging": true,
        });
        $('#EditClient').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = $(this)
            modal.find('#id_cli').val(button.data('id'));
            modal.find('#nomu').val(button.data('nom'));
            modal.find('#prenomu').val(button.data('prenom'));
            modal.find('#teleu').val(button.data('tele'));
            modal.find('#code_clientu').val(button.data('code'));
        });
        $('.btn_delete').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            console.log(url);
            Swal.fire({
                title: 'Are you shure to delete facture ?',
                text: "La suppression est reversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'delete'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                    Swal.fire(
                        'deleting!',
                        'facture hass been deleted successfly',
                        'success'
                    )
                }
            })
        });
    });
</script>

@endsection
