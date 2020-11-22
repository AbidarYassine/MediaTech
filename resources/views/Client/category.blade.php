@extends('admin.include.default')
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="container" id="tabs">
        <ul>
            <li> <a href="#vip"> VIP</a></li>
            <li> <a href="#client_Ordinaire">client ordinaire</a></li>
            <li> <a href="#client_potentielle">client à potentiel </a></li>
        </ul>
        <div id="vip">
            <table class="table table-bordered table-primary">
                <thead>
                    <tr>
                        <th>Nom Client </th>
                        <th>Prenom Client </th>
                        <th>Nombre de facture</th>
                        <th>Chiffre Affaire</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientVip as $client)
                    <tr>
                        <td>{{$client[1]->nom}}</td>
                        <td>{{$client[1]->prenom}}</td>
                        <td>{{$client[1]->nbrFacture}}</td>
                        <td>{{$client[0][0]->chiffre_affaire}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="client_Ordinaire">
            <table class="table table-bordered table-primary">
                <thead>
                    <tr>
                        <th>Nom Client </th>
                        <th>Prenom Client </th>
                        <th>Nombre de facture</th>
                        <th>Chiffre Affaire</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientOrdinaire as $clientor)
                    <tr>
                        <td>{{$clientor[1]->nom}}</td>
                        <td>{{$clientor[1]->prenom}}</td>
                        <td>{{$clientor[1]->nbrFacture}}</td>
                        <td>{{$clientor[0][0]->chiffre_affaire}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="client_potentielle">
            <table class="table table-bordered table-primary">
                <thead>
                    <tr>
                        <th>Nom Client </th>
                        <th>Prenom Client </th>
                        <th>Nombre de facture</th>
                        <th>Chiffre Affaire</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientPotentiel as $clientPo)
                    <tr>
                        <td>{{$clientPo[1]->nom}}</td>
                        <td>{{$clientPo[1]->prenom}}</td>
                        <td>{{$clientPo[1]->nbrFacture}}</td>
                        <td>{{$clientPo[0][0]->chiffre_affaire}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let item1 = '<li class="breadcrumb-item active">Client</li>';
        var item2 = '<li class="breadcrumb-item active">Category</li>';
        $("#list_breadcrumb").append(item1);
        $("#list_breadcrumb").append(item2);
        $("#tabs").tabs();
        $(".table").DataTable();
    });
</script>
@endsection
