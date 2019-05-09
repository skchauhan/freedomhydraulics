<!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="{{ url('admin') }}" class="d-block">Dashboard</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         <li class="nav-item">
          <a href="{{ url('/admin/users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>Users</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ url('/admin/news') }}" class="nav-link {{ request()->is('admin/news*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              News
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/admin/news/create') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Add New News</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/news') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>All News</p>
              </a>
            </li>   
            <li class="nav-item">
              <a href="{{ url('/admin/news-category') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Category</p>
              </a>
            </li>   
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ url('/admin/pages') }}" class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-book"></i>
            <p>Pages</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('/admin/slider') }}" class="nav-link {{ request()->is('admin/slider*') ? 'active' : '' }}">
            <i class="nav-icon far fa-images"></i>
            <p>Slider</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('/admin/nav-menu') }}" class="nav-link {{ request()->is('admin/nav-menu*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bars"></i>
            <p>Nav Menu</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ url('/admin/product') }}" class="nav-link {{ request()->is('admin/product*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-edit"></i>
            <p>
              Products
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/admin/products/create') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Add New Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/products') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>All Products</p>
              </a>
            </li>   
            <li class="nav-item">
              <a href="{{ url('/admin/product-category') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Category</p>
              </a>
            </li>  
            <li class="nav-item">
              <a href="{{ url('/admin/product-tab') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Tab</p>
              </a>
            </li>   
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ url('/admin/dealer') }}" class="nav-link {{ request()->is('admin/dealer*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>
              Dealer
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/admin/dealer/create') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Add New Dealer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/dealer') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>All Dealers</p>
              </a>
            </li>   
            <li class="nav-item">
              <a href="{{ url('/admin/dealer-category') }}" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Category</p>
              </a>
            </li>  
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ url('/admin/manage-repair-sheets') }}" class="nav-link {{ request()->is('admin/manage-repair-sheets*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-language"></i>
            <p>Manage Repair Sheets</p>
          </a>
        </li>  

        <li class="nav-item">
          <a href="{{ url('/admin/languages') }}" class="nav-link {{ request()->is('admin/languages*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-language"></i>
            <p>Language</p>
          </a>
        </li>     

        <li class="nav-item">
          <a href="{{ url('/admin/general-settings') }}" class="nav-link {{ request()->is('admin/general-settings*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings</p>
          </a>
        </li>     
     
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>