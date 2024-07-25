<!DOCTYPE html>
<html lang="en">
<head>
	@include('system.global_includes.meta')
	@include('system.dts.includes.css')
</head>
<body>
	<div class="wrapper">
		@include('system.dts.user.layout.user_includes.user_sidebar')
		<div class="main">
			@include('system.dts.user.layout.user_includes.user_topbar')
			<main class="content">
				<div class="container-fluid p-0">
					@yield('content')
				</div>
			</main>
		</div>
	</div>
</body>

@include('system.dts.includes.js')
@include('system.global_includes.js')
@yield('js')

</html>