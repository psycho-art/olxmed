<header class="main-header">
    <!-- Logo -->
    <a href="./index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ADM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ auth()->user()->name }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  {{ auth()->user()->name }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('user.profile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <form action='{{ route('user.logout') }}' method='post'>
                    @csrf
                   <input name="remember" id="remember" type="submit" value="Sign out" class="btn btn-default btn-flat">
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>  