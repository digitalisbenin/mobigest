<ul style="background-color: #A52A2A !important;" class="navbar-nav   sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        
        <div class="text-white text-center ">
            <img src="{{asset('fourniture.png')}}" alt="Logo" class="rounded-circle" width="50" height="50">
        </div>
        
        
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    {{--  <li class="nav-item active">
        <a class="nav-link" href="dashboards">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>  --}}

    <!-- Divider -->
    {{--  <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>  --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{--  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>  --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{--  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>  --}}

    <!-- Divider -->
    {{--  <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>  --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{--  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>  --}}

    @if(Auth::check() && Auth::user()->role->name === 'SUPERVISEUR')


    <!-- Nav Item - Charts -->
    <li class="nav-item "style="font-size: 1px;" >
        <a class="nav-link text-white font-bold" href="{{url('ventes-articles')}}" >
            <i class="fas fa-fw fa-chart-area"></i>
            <span class="font-bold"><strong>ENREGISTRER UNE VENTE</strong></span></a>
    </li>
    <li class="nav-item"style="font-size: 1px;" >
        <a class="nav-link text-white " href="{{url('ventes-article')}}" >
            <i class="fas fa-fw fa-chart-area"></i>
            <span><strong>ANNULER UNE VENTE</strong></span></a>
    </li>

    <!-- Nav Item - Tables -->
    {{--  <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>VENTE ACCESSOIRE</span></a>
    </li>  --}}
    <li class="nav-item">
        <a class="nav-link text-white" href="{{url('liste-reglement-ventes')}}">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>REGLER UNE CREANCE</strong></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="{{url('depenses')}}">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>ENREGISTRER UNE DEPEN...</strong> </span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

 <li class="nav-item">
        <a class="nav-link text-white" href="{{url('entree-articles')}}">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>ENTREE EN STOCK</strong></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link small text-white" href="{{url('retour-articles')}}">
            <i class="fas fa-fw fa-table"></i>
            <span ><strong>RETOUR AU FOURNISSEUR</strong></span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link text-white" href="{{url('articles')}}">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>ENREGISTRER UN ARTICLE</strong></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="{{url('users')}}">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>ENREGISTRER UN UTILISA...</strong></span></a>
    </li>
    {{--  <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>DECONNEXION</strong></span></a>
            
            

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    </li>  --}}
    {{--  <li class="nav-item">
        <a class="nav-link text-white" href="articles">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>ENTREPRISE</strong></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link  text-white" href="articles">
            <i class="fas fa-fw fa-table"></i>
            <span><strong>FAMILLE</strong></span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span><strong>GESTION DES STOCKS</strong></span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">GESTION DES STOCKS:</h6>
              <a class="collapse-item" href="{{url('get-entre-article')}}">Point des Entrées</a>
              <a class="collapse-item" href="{{ url('get-etat-stock') }}">Etat des Stocks</a>
              <a class="collapse-item" href="{{url('get-article-retour-fournisseurs')}}">Point des Retours au Fournisseur</a>
              <a class="collapse-item" href="{{url('get-articles')}}">Rechercher un Article</a>
          </div>
      </div>
  </li>


  <hr class="sidebar-divider d-none d-md-block">

   <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
          aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span><strong>CONTROLES</strong></span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">CONTROLES:</h6>
              <a class="collapse-item" href="{{url('get-vente-articles')}}">Point des Ventes Périodiques</a>
              <a class="collapse-item" href="{{url('get-reglements')}}">Point des Règlements</a>
              <a class="collapse-item" href="{{url('get-article-retour-ventes')}}">Point des Ventes Annulées</a>
              <a class="collapse-item" href="{{url('get-depense')}}">Point des Dépenses</a>
          </div>
      </div>
  </li>  --}}
  <hr class="sidebar-divider d-none d-md-block">
  @elseif(Auth::check() && Auth::user()->role->name === 'RESPONSABLE')
  <hr class="sidebar-divider d-none d-md-block">

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span><strong>GESTION DES STOCKS</strong></span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">GESTION DES STOCKS:</h6>
            <a class="collapse-item" href="{{url('get-entre-article')}}">Point des Entrées</a>
            <a class="collapse-item" href="{{url('get-etat-stock')}}">Etat des Stocks</a>
            <a class="collapse-item" href="{{url('get-article-retour-fournisseurs')}}">Point des Retours au Fournisseur</a>
            <a class="collapse-item" href="{{url('get-articles')}}">Rechercher un Article</a>
        </div>
    </div>
</li>


<hr class="sidebar-divider d-none d-md-block">

 <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span><strong>CONTROLES</strong></span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">CONTROLES:</h6>
            <a class="collapse-item" href="{{url('get-vente-articles')}}">Point des Ventes Périodiques</a>
            <a class="collapse-item" href="{{url('get-reglements')}}">Point des Règlements</a>
            <a class="collapse-item" href="{{url('get-article-retour-ventes')}}">Point des Ventes Annulées</a>
            <a class="collapse-item" href="{{url('get-depense')}}">Point des Dépenses</a>
        </div>
    </div>
</li>
<hr class="sidebar-divider d-none d-md-block">
@elseif(Auth::check() && Auth::user()->role->name === 'CONTROLEUR')

<li class="nav-item">
    <a class="nav-link text-white" href="{{url('entree-articles')}}">
        <i class="fas fa-fw fa-table"></i>
        <span><strong>ENTREE EN STOCK</strong></span></a>
</li>
<hr class="sidebar-divider d-none d-md-block">

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
      aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span><strong>GESTION DES STOCKS</strong></span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">GESTION DES STOCKS:</h6>
          <a class="collapse-item" href="{{url('get-entre-article')}}">Point des Entrées</a>
          <a class="collapse-item" href="{{url('get-etat-stock')}}">Etat des Stocks</a>
          <a class="collapse-item" href="{{url('get-article-retour-fournisseurs')}}">Point des Retours au Fournisseur</a>
          <a class="collapse-item" href="{{url('get-articles')}}">Rechercher un Article</a>
      </div>
  </div>
</li>


<hr class="sidebar-divider d-none d-md-block">

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
      aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-wrench"></i>
      <span><strong>CONTROLES</strong></span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">CONTROLES:</h6>
          <a class="collapse-item" href="{{url('get-vente-articles')}}">Point des Ventes Périodiques</a>
          <a class="collapse-item" href="{{url('get-reglements')}}">Point des Règlements</a>
          <a class="collapse-item" href="{{url('get-article-retour-ventes')}}">Point des Ventes Annulées</a>
          <a class="collapse-item" href="{{url('get-depense')}}">Point des Dépenses</a>
      </div>
  </div>
</li>
<hr class="sidebar-divider d-none d-md-block">
@elseif(Auth::check() && Auth::user()->role->name === 'STOCK')
<li class="nav-item">
    <a class="nav-link text-white" href="{{url('entree-articles')}}">
        <i class="fas fa-fw fa-table"></i>
        <span><strong>ENTREE EN STOCK</strong></span></a>
</li>
<li class="nav-item">
    <a class="nav-link small text-white" href="{{url('retour-articles')}}">
        <i class="fas fa-fw fa-table"></i>
        <span ><strong>RETOUR AU FOURNISSEUR</strong></span></a>
</li>


<li class="nav-item">
    <a class="nav-link text-white" href="{{url('articles')}}">
        <i class="fas fa-fw fa-table"></i>
        <span><strong>ENREGISTRER UN ARTICLE</strong></span></a>
</li>
@elseif(Auth::check() && Auth::user()->role->name === 'CAISSE')

<!-- Nav Item - Charts -->
<li class="nav-item "style="font-size: 1px;" >
    <a class="nav-link text-white font-bold" href="{{url('ventes-articles')}}" >
        <i class="fas fa-fw fa-chart-area"></i>
        <span class="font-bold"><strong>ENREGISTRER UNE VENTE</strong></span></a>
</li>
<li class="nav-item"style="font-size: 1px;" >
    <a class="nav-link text-white " href="{{url('ventes-article')}}" >
        <i class="fas fa-fw fa-chart-area"></i>
        <span><strong>ANNULER UNE VENTE</strong></span></a>
</li>

<!-- Nav Item - Tables -->
{{--  <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>VENTE ACCESSOIRE</span></a>
</li>  --}}
<li class="nav-item">
    <a class="nav-link text-white" href="{{url('liste-reglement-ventes')}}">
        <i class="fas fa-fw fa-table"></i>
        <span><strong>REGLER UNE CREANCE</strong></span></a>
</li>
<li class="nav-item">
    <a class="nav-link text-white" href="{{url('depenses')}}">
        <i class="fas fa-fw fa-table"></i>
        <span><strong>ENREGISTRER UNE DEPENSE</strong> </span></a>
</li>

<hr class="sidebar-divider d-none d-md-block">
@else
  <p>Accès refusé ❌</p>


  @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    {{--  <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>  --}}

    <!-- Sidebar Message -->

</ul>
