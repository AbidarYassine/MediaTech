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
    <div class="row">
        <div class="col-md-6">
            <a data-toggle="modal" data-target="#AddClient" class="btn btn-success">
                <i class="fas fa-plus fa-1x mr-1"></i>Add new Client
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{route('client.categoryClient')}}" class="btn btn-default float-right text-white">Client Category</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">All Clients</div>
                <div class="card-body">
                    <table id="table_client" class="table table-hover table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Code Client</th>
                                <th>Telephone</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                            <tr>
                                <td>{{$client->id}}</td>
                                <td>{{$client->nom}}</td>
                                <td>{{$client->prenom}}</td>
                                <td>{{$client->code_client}}</td>
                                <td>{{$client->tele}}</td>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#EditClient" data-id="{{$client->id}}" data-nom="{{$client->nom}}" data-prenom="{{$client->prenom}}" data-tele="{{$client->tele}}" data-code="{{$client->code_client}}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{route('client.delete',$client->id)}}" class="btn_delete btn btn-danger btn-sm">supprimer</a>
                                </td>
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
@include('Client.include.modelAdd')
@include('Client.include.modalEdit')
@section('script')
<script>
    $(document).ready(function() {
        let item1 = '<li class="breadcrumb-item active">Client</li>';
        var item2 = '<li class="breadcrumb-item active">Index</li>';
        $("#list_breadcrumb").append(item1);
        $("#list_breadcrumb").append(item2);
        $('#table_client').DataTable({
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
                title: 'Are you shure to delete client and all facture the client?',
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
                        'client hass been deleted successfly',
                        'success'
                    )
                }
            })
        });
    });
</script>

@endsection
