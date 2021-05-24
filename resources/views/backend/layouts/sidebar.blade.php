@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
    

<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ (!empty(Auth::user()->image))?url('/upload/user_images/'.Auth::user()->image):url('/upload/default/default.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if (Auth::user()->role=='Admin')
        <li class="nav-item has-treeview {{ ($prefix=='/users')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              User management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('users.view') }}" class="nav-link {{ ($route=='users.view')?'active':'' }} ">
                <i class="fa fa-users"></i>
                <p>User</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        <li class="nav-item has-treeview {{ ($prefix=='/profiles')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Profile management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('profiles.view') }}" class="nav-link {{ ($route=='profiles.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('profiles.password.view') }}" class="nav-link {{ ($route=='profiles.password.view')?'active':'' }}">
                <i class="fa fa-unlock-alt nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/suppliers')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Manage Suppliers
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('suppliers.view') }}" class="nav-link {{ ($route=='suppliers.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>View Suppliers</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/customers')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
                Customer Management
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('customers.view') }}" class="nav-link {{ ($route=='customers.view') ? 'active' : '' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>view customer</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/units')? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cogs"></i>
            <p>
              Manage Units
              <i class="fa fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('units.view') }}" class="nav-link {{ ($route=='units.view')?'active':'' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>View units</p>
              </a>
            </li>
          </ul>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>