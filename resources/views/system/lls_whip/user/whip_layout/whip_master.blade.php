<!DOCTYPE html>
<html lang="en">
<head>
	@include('system.global_includes.meta')
	@include('system.lls_Whip.includes.css')
</head>
<body>
	@include('system.lls_whip.user.whip_layout.includes.header_top_area')
	@include('system.lls_whip.user.whip_layout.includes.main_menu')
	@include('system.lls_whip.user.whip_layout.includes.mobile_menu')
	<main class="content">
		@yield('content')
	</main>
</body>
@include('system.global_includes.js')
@include('system.lls_whip.includes.js')
@include('system.global_includes.custom_js.datatable_settings')
@include('system.global_includes.custom_js.toast_message')
@include('system.global_includes.custom_js._ajax')
@yield('js')
</html>