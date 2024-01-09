@auth
<nav class="navbar navbar-expand-xl  navbar-light" id="page-container">
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
				<a class="dropdown-toggle nav-link {{ Request::is('employ') || 
					Request::is('employ/eximindex') || 
					Request::is('resignterm/listajuresign') || 
					Request::is('resignterm/listajuresign/external') || 
					Request::is('resignterm')|| 
					Request::is('dokar')|| 
					Request::is('sp') ? 'active' : '' }}" data-toggle="dropdown" aria-expanded="false">Employees</a>
					<div class="dropdown-menu dropdown-menu-start ">
						@if (Auth::user()->hasRole('admin'))
						@can('employ.index')
						<a href="/employ" class="dropdown-item {{ Request::is('employ') ? 'active' : '' }}">Internal Employees</a>
						@endcan
						@can('employ.index_external')
						<a href="/employexternal" class="dropdown-item {{ Request::is('employexternal') ? 'active' : '' }}">Eksternal Employees</a>
						@endcan
						@can('resignterm.listajuresign')
						<a href="/resignterm/listajuresign" class="dropdown-item {{ Request::is('resignterm/listajuresign') ? 'active' : '' }}">Resign Internal</a>
						@endcan
						@can('resignterm.listajuresign_external')
						<a href="/resignterm/listajuresign/external" class="dropdown-item {{ Request::is('/resignterm/listajuresign/external') ? 'active' : '' }}">Resign External</a>
						@endcan
						@can('dokar.index')
						<a href="/dokar" class="dropdown-item {{ Request::is('dokar') ? 'active' : '' }}">Dokumen Karyawan</a>
						@endcan
						@can('sp.index')
						<a href="/sp" class="dropdown-item {{ Request::is('sp') ? 'active' : '' }}">List SP</a>
						@endcan
						@endif
						@can('resignterm.index')
						<a href="/resignterm" class="dropdown-item {{ Request::is('resignterm') ? 'active' : '' }}">Request Resign</a>
						@endcan
						<!--@can('employ.eximindex')
							<a href="/employ/eximindex" class="dropdown-item {{ Request::is('/employ/eximindex') ? 'active' : '' }}">Export-Import</a>
						@endcan -->
						@if (!(Auth::user()->getkaryawan))
						<!--ga ada menu / handle navbar admin-->
						@elseif(Auth::user()->getkaryawan->jabatan->kode == '1')
							@can('employ.subordinate')
							<a href="/employ/subordinate/" class="dropdown-item">Subordinate</a>
							@endcan
						@endif

						@can('timeoffops.index') 
							@if(in_array(Auth::user()->id, [1582, 1642, 2436])) 
								<a href="/timeoffops" class="dropdown-item">Time off Oprasional</a> 
							@endif 
						@endcan

					</div>
				</li>
				@endcan
				@if (Auth::user()->hasRole('admin'))
				@can('presensi')
				<li class="nav-item dropdown">
					<a class="dropdown-toggle nav-link {{ Request::is('presensi') ? 'active' : ''}} 
					{{ Request::is('timeoff') ? 'active' : ''}} 
					{{ Request::is('presensi/external') ? 'active' : ''}} 
					{{ Request::is('shift') ? 'active' : ''}} 
					{{ Request::is('calendar') ? 'active' : ''}} 
					{{ Request::is('ovtime') ? 'active' : ''}} 
					{{ Request::is('reqattend_admin') ? 'active' : ''}} " 
					data-toggle="dropdown" aria-expanded="false">Times Management</i></a>
					<div class="dropdown-menu dropdown-menu-right">
						@can('presensi')
						<a href="/presensi" class="dropdown-item {{ Request::is('/presensi') ? 'active' : '' }}">Internal Attendance</a>
						@endcan
						@can('presensi.index_external')
						<a href="/presensi/external" class="dropdown-item {{ Request::is('/presensi/external') ? 'active' : '' }}">External Attendance</a>
						@endcan
						@can('users.index')
						<a href="/timeoff" class="dropdown-item {{ Request::is('/timeoff') ? 'active' : '' }}">Internal Time Off</a>
						@endcan
						@can('ovtime.index')
						<a href="/ovtime" class="dropdown-item {{ Request::is('/ovtime') ? 'active' : '' }}">OverTime</a>
						@endcan
						@can('shift.index')
						<a href="/shift" class="dropdown-item {{ Request::is('/shift') ? 'active' : '' }}">Scheduler</a>
						@endcan
						@can('calender.index')
						<a href="/calendar" class="dropdown-item {{ Request::is('/calendar') ? 'active' : '' }}">Calendar</a>
						@endcan
						@can('cuti.bulkcutikar')
						<a href="/cuti/bulkcutikar" class="dropdown-item {{ Request::is('/calendar') ? 'active' : '' }}">Bulkcuti</a>
						@endcan

						@can('reqattend.index_admin')
						<a href="/reqattend_admin" class="dropdown-item {{ Request::is('/reqattend_admin') ? 'active' : '' }}">Aprroval</a>
						@endcan
					</div>
				</li>
				@endcan
			@endif
			@if (Auth::user()->hasRole('admin'))
				@can('loker.index')
					<li class="nav-item dropdown">
						<a class="dropdown-toggle nav-link {{ Request::is('loker') ? 'active' : ''}} 
							{{ Request::is('loker/create') ? 'active' : ''}} 
							{{ Request::is('loker/create/detail/{id}') ? 'active' : ''}}
							{{ Request::is('pelamar') ? 'active' : '' }}" 
							href="/payroll/index" data-toggle="dropdown" aria-expanded="false">
							Hiring
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							@can('payroll.index')
							<a href="/loker" class="dropdown-item {{ Request::is('loker') ? 'active' : '' }}">Vacancies</a>
							<a class="dropdown-item {{ Request::is('pelamar') ? 'active' : '' }}" href="/pelamar">Applicant</a>
							@endcan
						</div>
					</li>
				@endcan
			@endif
			@if (Auth::user()->hasRole('admin'))
				@can('param.index')
				<li class="nav-item dropdown">
					<a class="dropdown-toggle nav-link {{ Request::is('param.index') ? 'active' : ''}} 
					{{ Request::is('payroll/index') ? 'active' : ''}} 
					{{ Request::is('jabatan') ? 'active' : ''}} 
					{{ Request::is('param') ? 'active' : ''}} 
					{{ Request::is('cabang') ? 'active' : ''}} 
					{{ Request::is('posisijob') ? 'active' : ''}} 
					{{ Request::is('param') ? 'active' : ''}} 
					{{ Request::is('pasal') ? 'active' : ''}} 
					{{ Request::is('perusahaan') ? 'active' : ''}} 
					{{ Request::is('parcab') ? 'active' : ''}} " 
					data-toggle="dropdown" aria-expanded="false">Setting Parameter</i></a>
					<div class="dropdown-menu dropdown-menu-right">
						@can('param.index')
							<a href="/param" class="dropdown-item {{ Request::is('/param') ? 'active' : '' }}">Param Presensi</a>
						@endcan
						@can('payroll.index')
							<a href="/payroll/index" class="dropdown-item {{ Request::is('/payroll/index') ? 'active' : '' }}">Param Payroll</a>
						@endcan
						@can('jabatan.index')
						<a href="/jabatan" class="dropdown-item">Param Job level</a>
						@endcan
						@can('posisijob.index')
						<a href="/posisijob" class="dropdown-item">Param Job Position</a>
						@endcan
						@can('jabatan.index')
						<a href="/parcab" class="dropdown-item">Param Approved</a>
						@endcan
						@can('paroff.index')
						<a href="/paroff" class="dropdown-item">Param Time Off</a>
						@endcan
						@can('parjeniskar.index')
						<a href="/parjeniskar" class="dropdown-item">Param jenis karyawan</a>
						@endcan
						@can('pasal.index')
						<a href="/pasal" class="dropdown-item">Param Pasal Pelanggaran</a>
						@endcan
						@can('parperiode.index')
						<a href="/parperiode" class="dropdown-item">Param Periode</a>
						@endcan
						@can('pasal.index')
						<a href="/pasal" class="dropdown-item {{ Request::is('pasal') ? 'active' : '' }}">Param SP</a>
						@endcan
						@can('parcom.index')
						<a href="/parcom" class="dropdown-item">Param Component</a>
						@endcan
						@can('perusahaan.index')
						<a href="/perusahaan" class="dropdown-item">Param Bussiness Company </a>
						@endcan
						@can('cabang.index')
						<a href="/cabang" class="dropdown-item">Param Branch</a>
						@endcan
					</div>
				</li>
				@endcan
			@endif
			@if (Auth::user()->hasRole('admin'))
				@can('settings.index')
					<li class="nav-item">
						<a class="nav-link {{ Request::is('settings') ? 'active' : '' }}" href="/settings">Setting Parameter</a>
					</li>
				@endcan 
			@endif
			@can('announcement.index')
				<li class="nav-item">
					<a class="nav-link {{ Request::is('announcement') ? 'active' : '' }}" href="/announcement">Announcement</a>
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
					{{ Request::is('perusahaan') ? 'active' : '' }}"
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
						@can('jabatan.index')
						<a href="/parcab" class="dropdown-item">Param Approved</a>
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

	
	<!-- <div class="navbar-right">
		<ul class="navbar-nav">
			<li class="nav-item active mt-2 me-3">
				<div id = "clock" onload="currentTime()" style="color:#1572A1; font-size:14px; font-weight:600; font-family: 'Nunito Sans', sans-serif;"></div>
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
					<a href="/myinfo" class="dropdown-item">My Info</a>
					<div class="dropdown-divider"></div>
					<a href="/logout" class="dropdown-item">Log Out</a>
				</div>
			</li>
    	</ul>
	</div> -->

	<div class="navbar-right">
		<ul class="navbar-nav">
			<li class="nav-item active mt-2 me-3">
				<!-- <div id = "clock" onload="currentTime()" style="color:#1572A1; font-size:14px; font-weight:600; font-family: 'Nunito Sans', sans-serif;"></div> -->
				<a href="javascript:;" data-toggle="dropdown">
					<img class="rounded-circle" src="{{ url('assets/bootstrap/img/person.png')}}" alt="" /> 
				</a>
				<div class="dropdown-menu dropdown-menu-right logout">
					@if (Auth::user()->hasRole('admin'))
					<a class="{{ Request::is('/dash') ? 'active' : '' }} dropdown-item" href="/dash">Profile</a>
					<div class="dropdown-divider"></div>
					@endif
					<a href="/myinfo" class="dropdown-item">My Info</a>
					<div class="dropdown-divider"></div>
					<a href="/logout" class="dropdown-item">Log Out</a>
				</div>
			</li>
    	</ul>
	</div>
	
</nav>


@endauth
@include('layouts.partials.scripts')
