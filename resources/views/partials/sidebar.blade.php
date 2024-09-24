<aside class="main-sidebar sidebar-light-primary elevation-4">

	<!-- Brand Logo -->
	<a href="/" class="brand-link" style="background-color: #181C32;">
		<img src="{{ asset('images/logo.webp') }}" alt="Kaz-Library Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-bold">Kaz-Library</span>
	</a>

	<div class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			{{-- user's avatar --}}
			<div class="image">
				<img src="{{ asset('images/user-logo.jpeg') }}" class="img-circle elevation-2" alt="User Image">
			</div>
			{{-- user's name --}}
			<div class="info">
				<a href="#" class="d-block">Kazuya Mishima</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" datawidget="treeview" role="menu" data-accordion="false">

				{{-- dashboard --}}
				<li class="nav-item">
					<a href="/" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>

				{{-- roles --}}
				<li class="nav-header font-weight-bold">Peran</li>
				{{-- users --}}
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-user-friends"></i>
						<p>Pengguna</p>
					</a>
				</li>
				{{-- members --}}
				<li class="nav-item">
					<a href="{{ route('anggota') }}" class="nav-link {{ request()->routeIs('anggota') || request()->routeIs('anggota.*') ? 'active' : '' }}">
						<i class="nav-icon fas fa-users"></i>
						<p>Anggota</p>
					</a>
				</li>
				{{-- /.roles --}}

				{{-- management --}}
				<li class="nav-header font-weight-bold">Manajemen</li>
				{{-- books --}}
				<li class="nav-item">
					<a href="{{ route('buku') }}" class="nav-link {{ request()->routeIs('buku') || request()->routeIs('buku.*') ? 'active' : '' }}">
						<i class="nav-icon fas fa-book"></i>
						<p>Buku</p>
					</a>
				</li>
				{{-- category --}}
				<li class="nav-item">
					<a href="{{ route('kategori') }}" class="nav-link {{ request()->routeIs('kategori') || request()->routeIs('kategori.*') ? 'active' : '' }}">
						<i class="nav-icon fas fa-list"></i>
						<p>Kategori</p>
					</a>
				</li>
				{{-- publisher --}}
				<li class="nav-item">
					<a href="{{ route('penerbit') }}" class="nav-link {{ request()->routeIs('penerbit') || request()->routeIs('penerbit.*') ? 'active' : '' }}">
						<i class="nav-icon fas fa-print"></i>
						<p>Penerbit</p>
					</a>
				</li>
				{{-- rental --}}
				<li class="nav-item">
					<a href="{{ route('penyewaan') }}" class="nav-link {{ request()->routeIs('penyewaan') || request()->routeIs('penyewaan.*') ? 'active' : '' }}">
						<i class="nav-icon fas fa-file"></i>
						<p>Penyewaan</p>
					</a>
				</li>
				{{-- /.management --}}
					 
				{{-- settings --}}
				<li class="nav-header font-weight-bold">Pengaturan</li>
				{{-- user account --}}
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>Akun</p>
					</a>
				</li>
				{{-- app setting --}}
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>Aplikasi</p>
					</a>
				</li>
				{{-- /.settings --}}
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
