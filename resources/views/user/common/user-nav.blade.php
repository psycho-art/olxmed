<aside class="main-sidebar">
    <!-- sidebars -->
    <section class="sidebar">
    
      <!-- sidebar menu -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="{{ Request::segment(2) == 'product' ? 'active' : '' }}">
          <a href="{{ route('user.product.index') }}">
            <i class="fa fa-link"></i>    
            <span>Product</span>
          </a>
        </li>
        {{-- <li class="treeview {{ Request::segment(2) == 'product' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-shopping-bag"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::segment(2) == 'product' && Request::segment(3) != 'category') ? 'active' : '' }}"><a href="{{ route('admin.product.index') }}"><i class="fa fa-circle-o"></i>Products</a></li>
            <li class="{{ Request::segment(3) == 'category' ? 'active' : '' }}"><a href="{{ route('admin.product.category.index') }}"><i class="fa fa-circle-o"></i>Category</a></li>
          </ul>
        </li> --}}
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>