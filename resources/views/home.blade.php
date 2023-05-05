@extends('master')
@section('content')
<body class="nav-md" id="app">
	<div class="container body" >
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a  class="site_title"><i class="fa fa-diamond"></i> <span>Application CRM!</span></a>
					</div>
					<div class="clearfix"></div>
					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="{{asset('assets/build/images/img.jpg')}}" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>APP CRM</span>
						</div>
					</div>
					<!-- /menu profile quick info -->
					<br />
					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>Menu</h3>			
							<ul class="nav side-menu">
							<li><router-link to="/home"><a>
								<i class="fa fa-home"></i> Accueil </a></router-link></li>
							<?php if(Auth::user()->role == '1'){?>
							<li><router-link to="/invite"><a>
								<i class="fa fa-envelope"></i> Inviter un employé </a></router-link></li>
							<li><router-link to="/companies"><a>
								<i class="fa fa-building"></i> Sociétés </a></router-link></li>
							<li><router-link to="/employees"><a>
								<i class="fa fa-folder"></i> Invitations </a></router-link></li>
							<li><router-link to="/admins"><a>
								<i class="fa fa-group"></i> Administrateurs </a></router-link></li>
							<li><router-link to="/logs"><a>
								<i class="fa fa-history"></i> Historiques </a></router-link></li>
							<?php }else{?>
							<li><router-link to="/myprofil"><a>
								<i class="fa fa-user"></i> Modifier Profil </a></router-link></li>		
							<li><router-link to="/company"><a>
								<i class="fa fa-building"></i> Société </a></router-link></li>
							<li><router-link to="/colleagues"><a>
								<i class="fa fa-folder"></i> Employées </a></router-link></li>
							<?php }?>
							<li>
							<a class="dropdown-item"  href="{{ route('logout') }}"
								onclick="event.preventDefault(); remove();
												document.getElementById('logout-form').submit();">
								<i class="fa fa-power-off"></i> Se Déconnecter 
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
							</li>	
							</ul>
						</div>
					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" >
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="{{asset('assets/build/images/pic.jpg')}}" alt="">{{Auth::user()->name}}
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
								    <router-link class="dropdown-item" to="/myprofil"> Profile</a></router-link>
									<a class="dropdown-item"  href="{{ route('logout') }}"
										onclick="event.preventDefault(); remove();
														document.getElementById('logout-form').submit();">
										<i class="fa fa-sign-out pull-right"></i> Se Déconnecter 
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">       
				<div class="">
					<div class="clearfix"></div>
	       		<router-view></router-view>
				</div>
			</div>
      
			<!-- /page content -->
		</div>
	</div>
<script>
	const remove = () => {
		localStorage.removeItem('token');
		window.location.replace('/login');
	}
</script>
    @vite('resources/js/app.js')
@endsection