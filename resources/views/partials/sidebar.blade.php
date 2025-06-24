<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #181C32">

	<!-- Brand Logo -->
	<a href="/" class="brand-link" style="background-color: #181C32;">
		<img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'E-Library') }} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-bold">{{ config('app.name', 'E-Library') }}</span>
	</a>

	<div class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			{{-- user's avatar --}}
			<div class="image my-auto">
				<img src="{{ Auth::user()->profile_photo ? asset('storage/'.Auth::user()->profile_photo) : asset('images/sample-user-photo.jpeg') }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px">
			</div>
			{{-- user's name --}}
			<div class="info">
				<a href="#" class="d-block">
					{{ Auth::user()->name }} <br>
					<small>{{ Auth::user()->email }}</small>
				</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="sidebar-menu nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				{{-- dashboard --}}
				<li class="nav-item">
					<a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>

				{{-- roles --}}
				<li class="nav-header font-weight-bold">Peran</li>
				{{-- users --}}
				@if(Auth::user()->role === 'admin')
				<li class="nav-item">
					<a href="{{ route('user') }}" class="nav-link {{ request()->routeIs('user') || request()->routeIs('user.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-user-friends"></i>
						<p>Pengguna</p>
					</a>
				</li>
				@endif
				{{-- members --}}
				<li class="nav-item">
					<a href="{{ route('anggota') }}" class="nav-link {{ request()->routeIs('anggota') || request()->routeIs('anggota.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-users"></i>
						<p>Anggota</p>
					</a>
				</li>
				{{-- /.roles --}}

				{{-- management --}}
				<li class="nav-header font-weight-bold">Manajemen</li>
				{{-- books --}}
				<li class="nav-item">
					<a href="{{ route('buku') }}" class="nav-link {{ request()->routeIs('buku') || request()->routeIs('buku.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-book"></i>
						<p>Buku</p>
					</a>
				</li>
				{{-- category --}}
				<li class="nav-item">
					<a href="{{ route('kategori') }}" class="nav-link {{ request()->routeIs('kategori') || request()->routeIs('kategori.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-list"></i>
						<p>Kategori</p>
					</a>
				</li>
				{{-- publisher --}}
				<li class="nav-item">
					<a href="{{ route('penerbit') }}" class="nav-link {{ request()->routeIs('penerbit') || request()->routeIs('penerbit.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-print"></i>
						<p>Penerbit</p>
					</a>
				</li>
				{{-- rental --}}
				<li class="nav-item">
					<a href="{{ route('penyewaan') }}" class="nav-link {{ request()->routeIs('penyewaan') || request()->routeIs('penyewaan.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-file"></i>
						<p>Penyewaan</p>
					</a>
				</li>
				{{-- /.management --}}
					 
				{{-- settings --}}
				<li class="nav-header font-weight-bold">Pengaturan</li>
				{{-- user account --}}
				<li class="nav-item">
					@php
					$userId = Auth::user()->id;
					@endphp
					<a href="{{ route('akun', $userId) }}" class="nav-link {{ request()->routeIs('akun') || request()->routeIs('akun.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>Akun</p>
					</a>
				</li>
				{{-- app setting --}}
				@if(Auth::user()->role === 'admin')
				<li class="nav-item">
					<a href="{{ route('aplikasi') }}" class="nav-link {{ request()->routeIs('aplikasi') || request()->routeIs('aplikasi.*') ? 'bg-danger' : '' }}">
						<i class="nav-icon fas fa-cog"></i>
						<p>Aplikasi</p>
					</a>
				</li>
				@endif
				{{-- /.settings --}}
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
