<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>MediaTech</h3>
    </div>

    <ul class="list-unstyled components">
        <!-- <p>Dummy Heading</p> -->
        <!-- <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
                <li>
                    <a href="#">Home 3</a>
                </li>
            </ul>
        </li> -->
        <li>
            <a href="{{route('dashboard.index')}}">
            <i class=" mr-3 fas fa-home"></i>Dashbord </a>
        </li>
        <li>
            <a href="{{route('client.index')}}">
            <i class="mr-3 fas fa-users"></i>Client

            </a>
        </li>
        <li>
            <a href="{{route('produit.index')}}">
            <i class="mr-3 fab fa-product-hunt"></i>Product</a>
        </li>
        <li>
            <a href="{{route('facture.index')}}">
            <i class="mr-3 fas fa-file-invoice"></i>Facture</a>
        </li>
        <!-- FacturProduit -->
        @if(Auth::user()->name=='Admin')
        <li>
            <a href="{{route('user.index')}}">
            <i class="mr-3 fas fa-users-cog"></i>Users</a>
        </li>
        @endif

    </ul>
</nav>
