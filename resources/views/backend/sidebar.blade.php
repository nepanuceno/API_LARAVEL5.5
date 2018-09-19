<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <?php
        $URI = "/storage/foto/avatar_".Auth::user()->id.".png";
      ?>
      <img src="{{ asset($URI) }}" onerror="this.src='{{ asset('storage/foto/default.png') }}'" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ config('app.name') }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <!-- <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form> -->
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    <li class="@yield('backend')">
      <a href="/backend">
        <i class="fa fa-home"></i> <span>Home</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green">new</small>
        </span>
      </a>
    </li>
    <li class="treeview @yield('manage')">
      <a href="#">
        <i class="fa fa-database"></i> <span>Manage</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="@yield('users')"><a href="/listaUsuarios"><i class="fa fa-users"></i> Users</a></li>
        <li class="@yield('roles')"><a href="/listRoles"><i class="fa fa-cubes"></i> Funções de Usuários</a></li>
        <li class="@yield('permissions')"><a href="/listPermissions"><i class="fa  fa-unlock"></i> Permissões</a></li>
        <!-- <li><a href="#"><i class="fa fa-shopping-cart"></i> Brand</a></li> -->
      </ul>
    </li>
  </ul>
</section>