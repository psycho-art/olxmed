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
        <li class="{{ Request::segment(2) == 'banners' ? 'active' : '' }}">
          <a href="{{ route('admin.banner.index') }}">
            <i class="fa fa-link"></i>
            <span>Banner</span>
          </a>
        </li>
        <li class="treeview {{ Request::segment(2) == 'blog' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-link"></i>
            <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::segment(2) == 'blog' && Request::segment(3) != 'category') ? 'active' : '' }}"><a href="{{ route('admin.blog.index') }}"><i class="fa fa-circle-o"></i>Blog</a></li>
            <li class="{{ (Request::segment(2) == 'blog' && Request::segment(3) == 'category') ? 'active' : '' }}"><a href="{{ route('admin.blog.category.index') }}"><i class="fa fa-circle-o"></i>Category</a></li>
          </ul>
        </li>
        <li class="treeview {{ Request::segment(2) == 'product' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-link"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (Request::segment(2) == 'product' && Request::segment(3) != 'category') ? 'active' : '' }}"><a href="{{ route('admin.product.index') }}"><i class="fa fa-circle-o"></i>Products</a></li>
            <li class="{{ Request::segment(3) == 'category' ? 'active' : '' }}"><a href="{{ route('admin.product.category.index') }}"><i class="fa fa-circle-o"></i>Category</a></li>
          </ul>
        </li>
        <li class="{{ Request::segment(2) == 'page' ? 'active' : '' }}">
          <a href="{{ route('admin.pages') }}">
            <i class="fa fa-link"></i>
            <span>Page</span>
          </a>
        </li>
        <li class="{{ Request::segment(2) == 'preferences' ? 'active' : '' }}">
          <a href="{{ route('admin.preferences') }}">
            <i class="fa fa-link"></i>
            <span>Preferences</span>
          </a>
        </li>
        <li class="treeview {{ Request::segment(2) == 'seo' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-link"></i>
            <span>SEO</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::segment(3) == 'home' ? 'active' : '' }}"><a href="{{ route('admin.seo', ['name' => 'home']) }}"><i class="fa fa-circle-o"></i>Home</a></li>
            <li class="{{ Request::segment(3) == 'blog' ? 'active' : '' }}"><a href="{{ route('admin.seo', ['name' => 'blog']) }}"><i class="fa fa-circle-o"></i>Blog</a></li>
            <li class="{{ Request::segment(3) == 'login-register' ? 'active' : '' }}"><a href="{{ route('admin.seo', ['name' => 'login-register']) }}"><i class="fa fa-circle-o"></i>Login/Register</a></li>
          </ul>
        </li>
        <li class="{{ Request::segment(2) == 'service' ? 'active' : '' }}">
          <a href="{{ route('admin.service.index') }}">
            <i class="fa fa-link"></i>
            <span>Services</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>