  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/images.jpeg') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('dist/img/images.jpeg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HEADPHONES STORE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2.jpg') }}" class="img-circle elevation-2" alt="User Image">
          <div class="info">
        </div>
          <a href="{{ route('home') }}" class="d-block">KOMAL THANKI</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview menu-close category-menu">
            <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    Category
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                  <a href="{{ route('category.index2') }}" class="nav-link list-category">
                    <i class="fas fa-align-justify"></i>
                    <p>List</p>
                </a>

                </li>
                <li class="nav-item">
                  <a href="{{ route('category.add') }}" class="nav-link">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <p>Add</p>
                  </a>
                </li>
                </ul>


          <li class="nav-item has-treeview menu-close colour-menu">
            <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fa fa-palette"></i>
                <p>
                    Colour
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                  <a href="{{ route('colour.index') }}" class="nav-link list-colour">
                    <i class="fas fa-align-justify"></i>
                     <p>List</p>
                </a>

                </li>
                <li class="nav-item">
                  <a href="{{ route('colour.add') }}" class="nav-link">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <p>Add</p>
                  </a>
                </li>
                </ul>

                <li class="nav-item has-treeview menu-close product-menu">
                <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fa fa-headphones"></i>
                <p>
                    Product
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                  <a href="{{ route('product.index') }}" class="nav-link list-product">
                    <i class="fas fa-align-justify"></i>
                    <p>List</p>
                </a>

                </li>
                <li class="nav-item">
                  <a href="{{ route('product.add') }}" class="nav-link">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <p>Add</p>
                  </a>
                </li>
                </ul>
        </li>

        <li class="nav-item menu-close">
            <a href="{{ url('/admin/vieworder') }}" class="nav-link">
             <i class="nav-icon fab fa-first-order"></i>
              <p>
                Orders
              </p>
            </a>

          </li>

          <li class="nav-item menu-close">
            <a href="{{ url('/admin/users') }}" class="nav-link">
             <i class="nav-icon fa fa-user"></i>
              <p>
                Users
              </p>
            </a>

          </li>

        <li class="nav-item has-treeview menu-open product-menu">
            <a class="nav-link fa fa-arrow-circle-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
