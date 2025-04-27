  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('dashboard') }}">
          <i class="bi bi-house"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-user-tie"></i><span>Clients Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('clients.create') }}">
              <i class="bi bi-circle"></i><span>Add New Client</span>
            </a>
          </li>
          <li>
            <a href="{{ route('clients.index') }}">
              <i class="bi bi-circle"></i><span>Manage Clients</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-list-check"></i></i><span>Projects Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('projects.create') }}">
              <i class="bi bi-circle"></i><span>Add Projects</span>
            </a>
          </li>
          <li>
            <a href="{{ route('projects.index') }}">
              <i class="bi bi-circle"></i><span>Manage Projects</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-bell"></i></i><span>Reminder</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('reminders.create') }}">
              <i class="bi bi-circle"></i><span>Add Reminder</span>
            </a>
          </li>
          <li>
            <a href="{{ route('reminders.index') }}">
              <i class="bi bi-circle"></i><span>Manage Reminder</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-envelope"></i><span>Interaction Log</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('interaction-logs.create') }}">
              <i class="bi bi-circle"></i><span>Add Interaction Log</span>
            </a>
          </li>
          <li>
            <a href="{{ route('interaction-logs.index') }}">
              <i class="bi bi-circle"></i><span>Manage Interaction Log</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('clients.report') }}">
          <i class="fa-solid fa-file-pdf"></i>
          <span>Clients Reports</span>
        </a>
      </li><!-- End report Nav -->

    </ul>

  </aside><!-- End Sidebar-->