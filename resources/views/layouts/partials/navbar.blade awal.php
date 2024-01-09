@auth
<nav class="navbar navbar-expand-xl navbar-light" id="page-container">
	<div class="navbar-header me-3">
		<a class="navbar-brand" href="/"><img src="{!! url('assets/bootstrap/img/anyargroup.png')!!}" alt="logo"></a>
	</div>
	<button class="navbar-toggler ms-auto me-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			@can('home.index')		
				<li class="nav-item ">
					<a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Dashboard</a>
				</li>
			@endcan
			@can('employ.index')
				<li class="nav-item dropdown">
				<a class="dropdown-toggle nav-link {{ Request::is('employ') || Request::is('employ/eximindex') || Request::is('resignterm/listajuresign') || Request::is('resignterm') || Request::is('pasal') || Request::is('sp') ? 'active' : '' }}" data-toggle="dropdown" aria-expanded="false">Employees</a>
					<div class="dropdown-menu dropdown-menu-start ">
						@if (Auth::user()->hasRole('admin'))
						@can('employ.index')
						<a href="/employ" class="dropdown-item {{ Request::is('employ') ? 'active' : '' }}">Internal Employees</a>
						@endcan
						@can('employ.index_external')
						<a href="/employexternal" class="dropdown-item {{ Request::is('employexternal') ? 'active' : '' }}">Eksternal Employees</a>
						@endcan


						<!-- @can('resignterm.listajuresign')
						<a href="/resignterm/listajuresign" class="dropdown-item {{ Request::is('resignterm/listajuresign') ? 'active' : '' }}">List Resign</a>
						@endcan
						@can('pasal.index')
						<a href="/pasal" class="dropdown-item {{ Request::is('pasal') ? 'active' : '' }}">List of violation articles</a>
						@endcan
						@can('sp.index')
						<a href="/sp" class="dropdown-item {{ Request::is('sp') ? 'active' : '' }}">List SP</a>
						@endcan
						@endif
						@can('resignterm.index')
						<a href="/resignterm" class="dropdown-item {{ Request::is('resignterm') ? 'active' : '' }}">Request Resign</a>
						@endcan
						@can('employ.eximindex')
							<a href="/employ/eximindex" class="dropdown-item {{ Request::is('/employ/eximindex') ? 'active' : '' }}">Export-Import</a>
						@endcan -->
						@if (!(Auth::user()->getkaryawan))
						<!--ga ada menu / handle navbar admin-->
						@elseif(Auth::user()->getkaryawan->jabatan->kode == '1')
							@can('employ.subordinate')
							<a href="/employ/subordinate/" class="dropdown-item">Subordinate</a>
							@endcan
						@endif

					</div>
				</li>
				@endcan
				@if (Auth::user()->hasRole('admin'))
				@can('presensi')
				<li class="nav-item dropdown">
					<a class="dropdown-toggle nav-link {{ Request::is('presensi') ? 'active' : ''}} 
					{{ Request::is('timeoff') ? 'active' : ''}} 
					{{ Request::is('shift') ? 'active' : ''}} 
					{{ Request::is('param') ? 'active' : ''}} 
					{{ Request::is('reqattendance') ? 'active' : ''}} " 
					data-toggle="dropdown" aria-expanded="false">Times Management</i></a>
					<div class="dropdown-menu dropdown-menu-right">
						@can('presensi')
						<a href="/presensi" class="dropdown-item {{ Request::is('/presensi') ? 'active' : '' }}">List Attendance</a>
						@endcan
						@can('users.index')
						<a href="/timeoff" class="dropdown-item {{ Request::is('/timeoff') ? 'active' : '' }}">List Time Off</a>
						@endcan
						@can('shift.index')
						<a href="/shift" class="dropdown-item {{ Request::is('/shift') ? 'active' : '' }}">Shift</a>
						@endcan
						@can('param.index')
						<a href="/param" class="dropdown-item {{ Request::is('/param') ? 'active' : '' }}">Param Presensi</a>
						@endcan
						@can('reqattend.index')
						<a href="/reqattendance" class="dropdown-item {{ Request::is('/reqattendance') ? 'active' : '' }}">Req Attendance</a>
						@endcan
					</div>
				</li>
				@endcan
			@endif
			@can('announcement.index')
				<li class="nav-item">
					<a class="nav-link {{ Request::is('announcement') ? 'active' : '' }}" href="/announcement">Announcement</a>
				</li>
			@endcan 
			@can('pelamar.index')
				<li class="nav-item">
					<a class="nav-link {{ Request::is('pelamar') ? 'active' : '' }}" href="/pelamar">Applicant</a>
				</li>
			@endcan
			
		
			@if (Auth::user()->hasRole('admin'))
				@can('payroll.index')
					<li class="nav-item dropdown">
						<a class="dropdown-toggle nav-link {{ Request::is('/payroll/index') ? 'active' : ''}}" href="/payroll/index" data-toggle="dropdown" aria-expanded="false">Payroll</a>
						<div class="dropdown-menu dropdown-menu-right">
							@can('payroll.index')
							<a href="/payroll/index" class="dropdown-item {{ Request::is('/payroll/index') ? 'active' : '' }}">Param Payroll</a>
							@endcan
						</div>
					</li>
				@endcan
			@endif
			@can('loker.index')
			<li class="nav-item">
				<a class="nav-link 
				{{ Request::is('loker') ? 'active' : ''}} 
				{{ Request::is('loker/create') ? 'active' : ''}} 
				{{ Request::is('loker/create/detail/{id}') ? 'active' : ''}}"
				href="/loker">Vacancies</a>
			</li>
			@endcan
			@can('employ.myinfo')
			<li class="nav-item">
				<a class="nav-link {{ Request::is('employ.myinfo') ? 'active' : '' }}" href="/myinfo">My Info</a>
			</li>
			@endcan
			@can('employ.listemploy')
			<li class="nav-item">
				<a class="nav-link {{ Request::is('employ') ? 'active' : '' }}" href="/listemploy">Employees</a>
			</li>
			@endcan
			@can('perusahaan.company')
			<li class="nav-item">
				<a class="nav-link {{ Request::is('perusahaan') ? 'active' : '' }}" href="/company">Company</a>
			</li>
			@endcan

			@if  (Auth::user()->hasRole('admin')) 
				<!-- Manage -->
				<li class="nav-item dropdown">
					<a class="dropdown-toggle nav-link
					{{ Request::is('permissions') ? 'active' : '' }}
					{{ Request::is('permissions/create') ? 'active' : '' }}
					{{ Request::is('roles') ? 'active' : '' }}
					{{ Request::is('roles/create') ? 'active' : '' }}
					{{ Request::is('users') ? 'active' : '' }}
					{{ Request::is('users/create') ? 'active' : '' }}
					{{ Request::is('posisijob') ? 'active' : '' }}
					{{ Request::is('posisijob/create') ? 'active' : '' }}
					{{ Request::is('cabang') ? 'active' : '' }}
					{{ Request::is('jabatan') ? 'active' : '' }}
					{{ Request::is('cabang/create') ? 'active' : '' }}
					{{ Request::is('perusahaan') ? 'active' : '' }}
					data-toggle="dropdown">Manage</a>
					<div class="dropdown-menu dropdown-menu-right">
						@can('perusahaan.index')
						<a href="/perusahaan" class="dropdown-item">Bussiness Company </a>
						@endcan
						@can('cabang.index')
						<a href="/cabang" class="dropdown-item">Branch</a>
						@endcan
						@can('posisijob.index')
						<a href="/posisijob" class="dropdown-item">Position Job</a>
						@endcan
						@can('jabatan.index')
						<a href="/jabatan" class="dropdown-item">Jabatan</a>
						@endcan
						<div class="dropdown-divider"></div>
						<h6 class="dropdown-header">Auth</h6>
						@can('permissions.index')
						<a href="/permissions" class="dropdown-item">Auth Permissions</a>
						@endcan
						@can('roles.index')
						<a href="/roles" class="dropdown-item">Auth Group</a>
						@endcan
						@can('users.index')
						<a href="/users" class="dropdown-item">Auth User</a>
						@endcan
					</div>
				</li>
				@endif
		</ul>

	</div>

	
	<div class="navbar-right">
		<ul class="navbar-nav">
			<li class="nav-item active mt-2 me-3">
				<div id = "clock" onload="currentTime()" style="color:#1572A1; font-size:14px; font-weight:600; font-family: 'Nunito Sans', sans-serif;"></div>
			</li>
			<li class="nav-item mt-1 me-3">
				<a href="javascript:;" data-toggle="dropdown" class="f-s-14 text-dark"><i class="fa fa-bell"></i></a>
				<ul class="dropdown-menu media-list dropdown-menu-right">
					<div class="dropdown-header">NOTIFICATIONS</div>
					<div class="dropdown-footer text-center">
						<a class="text-decoration-none text-dark" href="javascript:;">View more</a>
					</div>
				</ul>
			</li>
			<li class="nav-item navbar-user">
				<a href="javascript:;" data-toggle="dropdown">
					<img class="rounded-circle" src="{{ url('assets/bootstrap/img/person.png')}}" alt="" /> 
				</a>
				<div class="dropdown-menu dropdown-menu-right logout">
					@if (Auth::user()->hasRole('admin'))
					<a class="{{ Request::is('/dash') ? 'active' : '' }} dropdown-item" href="/dash">Profile</a>
					<div class="dropdown-divider"></div>
					@endif
					<a href="/logout" class="dropdown-item">Log Out</a>
				</div>
			</li>
    	</ul>
	</div>
	
</nav>


@endauth
@include('layouts.partials.scripts')
