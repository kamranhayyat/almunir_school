 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
      <div class="sidebar-brand-icon">
        <img style="height:60px;" src="{{URL::asset('/images/logo-dark.png')}}" alt="Logo">
      </div>
      <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Almunir Schools</span>
      </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Modules
    </div>

    @if( isset(auth()->user()->user_type) && auth()->user()->user_type == 1)
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Students</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Student Module:</h6>
          <a class="collapse-item" href={{ route('show-students') }}>Students</a>
          <a class="collapse-item" href={{ route('import-students') }}>Import Students</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Lesson Plan</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Lesson Module:</h6>
          <a class="collapse-item" href="{{ route('students-lesson-plan') }}">Lesson Plan</a>
          <a class="collapse-item" href="{{ route('students-lesson-plan-upload') }}">Upload Lesson Plan</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Study Material</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Study Module:</h6>
          <a class="collapse-item" href="{{ route('students-study-material') }}">Study Material</a>
          <a class="collapse-item" href="{{ route('students-study-material-upload-pdf') }}">Upload Study Material</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Complaints</span>
      </a>
      <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Complaints Module:</h6>
          <a class="collapse-item" href="{{ route('students-complaints') }}">Complaints</a>
          <a class="collapse-item" href="{{ route('students-complaints-upload') }}">Upload Complaints</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Notification</span>
      </a>
      <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Notification Module:</h6>
          <a class="collapse-item" href="{{ route('student-notification-create') }}">Add Noticeboard</a>
          <a class="collapse-item" href="{{ route('create-events') }}">Add Event</a>
          <a class="collapse-item" href="{{ route('show-events') }}">Show Events</a>
          <a class="collapse-item" href="{{ route('add-namaz-timings') }}">Add Namaz Timings</a>
          <a class="collapse-item" href="{{ route('view-namaz-timings') }}">View Namaz Timings</a>
        </div>
      </div>
    </li>
    @endif

    @if( isset(auth()->user()->user_type) && auth()->user()->user_type == 2)
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesStd" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Students</span>
      </a>
      <div id="collapsePagesStd" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Students Module:</h6>
          <a class="collapse-item" href="{{ route('show-childrens') }}">Show Students</a>
        </div>
      </div>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesLesson" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Lesson Plan</span>
      </a>
      <div id="collapsePagesLesson" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Lessons Module:</h6>
          <a class="collapse-item" href="{{ route('show-childrens-lesson-plan') }}">Lesson Plan</a>
        </div>
      </div>
    </li> --}}

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesMaterial" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Study Material</span>
      </a>
      <div id="collapsePagesMaterial" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Material Module:</h6>
          <a class="collapse-item" href="{{ route('show-childrens-study-material') }}">Study Material</a>
        </div>
      </div>
    </li> --}}

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEvents" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Events</span>
      </a>
      <div id="collapsePagesEvents" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Events Module:</h6>
          <a class="collapse-item" href="{{ route('show-events') }}">Show Events</a>
        </div>
      </div>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->