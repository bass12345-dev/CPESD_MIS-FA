<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>


	
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <?php 
							if (session('user_type') == 'admin' || session('is_oic') == 'yes') {
								echo "<li class='nav-item '>
							<a href='".url("/dts/admin/dashboard")."' class='btn btn-danger'>Admin Panel</a>
						</li>";
							}


							 if(session('is_receiver') == 'yes') {

								echo '<li class="nav-item ">
							<a href="'.url("/dts/receiver/dashboard").'" class="btn btn-success">Final Receiver\'s Panel  <span class="badge bg-danger to_receive">0</span></a>
						</li>';
							}
						 ?>
            @include('system.dts.includes.logout')
        </ul>
    </div>
</nav>