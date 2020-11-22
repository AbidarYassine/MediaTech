@extends('admin.include.default')
@section('style')
<style>

</style>
@endsection

@section('content')
<div class="col-md-12">
    <h1 class="text-center lead">The products with the quantiy sold the {{date('yy/m/j')}} </h1>
    <hr>
    <div class="row">
        <div style="display: none;" class="alert alert-warning col-md-12" id="alerMessage"></div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <canvas id="myChart1"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
    <hr class="bg-default">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <!-- Card image -->
                <center><i class="fas fa-5x fa-users text-warning"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 id="nbrClient" class="card-title" style="font-style: italic;"></h4>
                    <!-- Text -->
                    <a href="{{route('client.index')}}" class="btn btn-outline-warning float-right">Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <!-- Card image -->
                <center><i class="fa-5x fab f fa-product-hunt text-primary"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 id="nbrProduit" class="card-title" style="font-style: italic;"></h4>
                    <!-- Text -->
                    <a href="{{route('produit.index')}}" class="btn btn-outline-primary float-right">Detail</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <!-- Card image -->
                <center><i class="mt-2 fa-5x fas fa-file-invoice text-default"></i></center>
                <div class="view overlay">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 id="nbrFacture" class="card-title" style="font-style: italic;"></h4>
                    <!-- Text -->
                    <a href="{{route('facture.index')}}" class="btn btn-outline-default float-right">Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="path/to/chartjs/dist/Chart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let item1 = '<li class="breadcrumb-item active">Dashboard</li>';

        $("#list_breadcrumb").append(item1);

        $.ajax({
            url: "/admin/dashboard/data",
            type: "get",
            data: {},
            success: function(data) {
                console.log(data);
                if (data.status) {
                    $("#nbrClient").text(data.nbrClient + " Clients");
                    $("#nbrProduit").text(data.nbrProduit + " Products");
                    $("#nbrFacture").text(data.nbrFacture + " Factures")
                    $("#alerMessage").hide();
                    var ctx = document.getElementById('myChart1');
                    var ctx2 = document.getElementById('myChart2');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.dataReference,
                            datasets: [{
                                label: 'Quantity Request',
                                data: data.dataQty,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(75, 192, 192, 1)',


                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(54, 162, 235, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    var myLineChart = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: data.dataReference,
                            datasets: [{
                                label: 'Quantity Request',
                                data: data.dataQty,
                                backgroundColor: [

                                    'rgba(255, 99, 132, 0.5)',
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },

                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }

                    });
                } else {
                    $("#alerMessage").show();
                    $("#nbrClient").text(data.nbrClient + " Clients");
                    $("#nbrProduit").text(data.nbrProduit + " Products");
                    $("#nbrFacture").text(data.nbrFacture+ " Factures")
                    $("#alerMessage").text('No facture yet');
                }
            },
            error: function(err, xhr, three) {
                console.log(err);
                console.log(xhr);
                console.log(three);
            }

        });
    });
</script>
@endsection
