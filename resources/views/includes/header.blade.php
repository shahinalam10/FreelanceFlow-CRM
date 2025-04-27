  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
        <img src="{{asset('backendAsset')}}/assets/img/flogo.png" alt="">
        <span class="d-none d-lg-block">FreelanceFlow-CRM</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              @auth
              <img src="{{ Auth::user()->profile_photo_url ?? asset('backendAsset/assets/img/profile-img.png') }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">
                  {{ Auth::user()->name ?? 'K. Anderson' }}
              </span>
              @else
              <img src="{{ asset('backendAsset/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">Guest</span>
              @endauth
          </a><!-- End Profile Image Icon -->
      
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                  @auth
                  <h6>{{ Auth::user()->name }}</h6>
                  <span>{{ Auth::user()->email }}</span>
                  @else
                  <h6>Guest User</h6>
                  <span>guest@example.com</span>
                  @endauth
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
      
              {{-- <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                      <i class="bi bi-person"></i>
                      <span>My Profile</span>
                  </a>
              </li> --}}
              <li>
                  <hr class="dropdown-divider">
              </li>
      
              <li>
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                      <i class="bi bi-gear"></i>
                      <span>Account Settings</span>
                  </a>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
      
              <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                      <i class="bi bi-question-circle"></i>
                      <span>Need Help?</span>
                  </a>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
      
              <li>
                  @auth
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" 
                         onclick="event.preventDefault(); this.closest('form').submit();">
                          <i class="bi bi-box-arrow-right"></i>
                          <span>Sign Out</span>
                      </a>
                  </form>
                  @else
                  <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                      <i class="bi bi-box-arrow-in-right"></i>
                      <span>Sign In</span>
                  </a>
                  @endauth
              </li>
          </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->