@extends('admin.include.default')
@section('style')
<style>
</style>
@endsection
@section('content')
<div id="tabs" class="col-md-12">
    <ul>
        <li> <a href="#fort"> Fort</a></li>
        <li> <a href="#moyenne">moyenne</a></li>
        <li> <a href="#faible">Faible </a></li>
    </ul>
    <div id="fort">
        <table class="table table-bordered table-primary">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Reference</th>
                    <th>Libelle</th>
                    <th>Quantity Demande</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produitFort as $prodFort)
                <tr>
                    <td>{{$prodFort[0]->id}}</td>
                    <td>{{$prodFort[0]->ref_produit}}</td>
                    <td>{{$prodFort[0]->libelle}}</td>
                    <td>{{$prodFort[0]->qtyDemande}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="moyenne">
        <table class="table table-bordered table-primary">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Reference</th>
                    <th>Libelle</th>
                    <th>Quantity Demande</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produitMoyen as $proMoyen)
                <tr>
                    <td>{{$proMoyen[0]->id}}</td>
                    <td>{{$proMoyen[0]->ref_produit}}</td>
                    <td>{{$proMoyen[0]->libelle}}</td>
                    <td>{{$proMoyen[0]->qtyDemande}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="faible">
        <table class="table table-bordered table-primary">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Reference</th>
                    <th>Libelle</th>
                    <th>Quantity Demande</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produitFaible as $profaible)
                <tr>
                    <td>{{$profaible[0]->id}}</td>
                    <td>{{$profaible[0]->ref_produit}}</td>
                    <td>{{$profaible[0]->libelle}}</td>
                    @if($profaible[0]->qtyDemande==null)
                    <td>0</td>
                    @else
                    <td>{{$profaible[0]->qtyDemande}}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



@section('script')
<script>
    $(document).ready(function() {
        let item1 = '<li class="breadcrumb-item active">Product</li>';
        var item2 = '<li class="breadcrumb-item active">Order</li>';
        $("#list_breadcrumb").append(item1);
        $("#list_breadcrumb").append(item2);
        $("#tabs").tabs();
    });
    $(".table").dataTable();
</script>
@endsection
