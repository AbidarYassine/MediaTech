<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <center>
        <h1 class="text-danger">Facture Numero
            <br>
            {{$facture->code_facture}}</h1>
    </center>
    <div class="container-fluid">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td>Nom Client</td>
                    <td>{{$client->nom}}</td>
                </tr>
                <tr>
                    <td>Prenom</td>
                    <td>{{$client->prenom}}</td>
                </tr>
                <tr>
                    <td>Code Client</td>
                    <td>{{$client->code_client}}</td>
                </tr>
                <tr>
                    <td>Telephone</td>
                    <td>{{$client->tele}}</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Reference Produit</th>
                        <th>Libelle produit</th>
                        <th>Prix Unitaire</th>
                        <th>Quantity</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                    <tr>
                        <!-- 'ref_produit', 'prix_unitaire', 'quantity_stock', 'libelle', -->
                        <td>{{$produit[0]->ref_produit}}</td>
                        <td>{{$produit[0]->libelle}}</td>
                        <td>{{$produit[0]->prix_unitaire}}</td>
                        <td>{{$produit[1]}}</td>
                        <td>{{$produit[0]->prix_unitaire * $produit[1]}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <label class="float-right"> Total:{{$total." "." DH"}}</label>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
