<!-- Heading -->
<div class="sidebar-heading">
    HR Mode
</div>

{{-- ------------------------------------ Attendance Data ------------------------------------ --}}

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#attendance"
       aria-expanded="true" aria-controls="attendance">
        <i class="fas fa-fw fa-cog"></i>
        <span>Attendance Data</span>
    </a>
    <div id="attendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Device Components:</h6>
            <a class="collapse-item" href="">View Data</a>
        </div>
    </div>
</li>

{{-- ------------------------------------ Attendance Data ------------------------------------ --}}

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Developer Mode
</div>

{{-- ------------------------------------ Devices ------------------------------------ --}}

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
       aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Devices</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Device Components:</h6>
            <a class="collapse-item" href="{{ route('device.create') }}">Create Data</a>
        </div>
    </div>
</li>

{{-- ------------------------------------ Devices ------------------------------------ --}}

{{-- ------------------------------------ Devices ------------------------------------ --}}

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#employee"
       aria-expanded="true" aria-controls="employee">
        <i class="fas fa-fw fa-cog"></i>
        <span>Employee Info</span>
    </a>
    <div id="employee" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Device Components:</h6>
            <a class="collapse-item" href="{{ route('employee.index') }}">View Data</a>
        </div>
    </div>
</li>

{{-- ------------------------------------ Devices ------------------------------------ --}}
