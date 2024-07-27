
<script src="{{asset('lls_assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
<script src="{{asset('lls_assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- bootstrap JS
		============================================ -->
<script src="{{asset('lls_assets/js/bootstrap.min.js')}}"></script>
<!-- wow JS
		============================================ -->
<script src="{{asset('lls_assets/js/wow.min.js')}}"></script>
<!-- price-slider JS
		============================================ -->
<script src="{{asset('lls_assets/js/jquery-price-slider.js')}}"></script>
<!-- owl.carousel JS
		============================================ -->
<script src="{{asset('lls_assets/js/owl.carousel.min.js')}}"></script>
<!-- scrollUp JS
		============================================ -->
<script src="{{asset('lls_assets/js/jquery.scrollUp.min.js')}}"></script>
<!-- meanmenu JS
		============================================ -->
<script src="{{asset('lls_assets/js/meanmenu/jquery.meanmenu.js')}}"></script>
<!-- counterup JS
		============================================ -->
<script src="{{asset('lls_assets/js/counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('lls_assets/js/counterup/waypoints.min.js')}}"></script>
<script src="{{asset('lls_assets/js/counterup/counterup-active.js')}}"></script>
<!-- mCustomScrollbar JS
		============================================ -->
<script src="{{asset('lls_assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<!-- sparkline JS
		============================================ -->
<script src="{{asset('lls_assets/js/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('lls_assets/js/sparkline/sparkline-active.js')}}"></script>
<!-- sparkline JS
		============================================ -->
<script src="{{asset('lls_assets/js/flot/jquery.flot.js')}}"></script>
<script src="{{asset('lls_assets/js/flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('lls_assets/js/flot/curvedLines.js')}}"></script>
<script src="{{asset('lls_assets/js/flot/flot-active.js')}}"></script>
<!-- knob JS
		============================================ -->
<script src="{{asset('lls_assets/js/knob/jquery.knob.js')}}"></script>
<script src="{{asset('lls_assets/js/knob/jquery.appear.js')}}"></script>
<script src="{{asset('lls_assets/js/knob/knob-active.js')}}"></script>
<!--  wave JS
		============================================ -->
<script src="{{asset('lls_assets/js/wave/waves.min.js')}}"></script>
<script src="{{asset('lls_assets/js/wave/wave-active.js')}}"></script>
<!--  todo JS
		============================================ -->
<script src="{{asset('lls_assets/js/todo/jquery.todo.js')}}"></script>
<script src="{{ asset('assets/css/bootstrap-select/bootstrap-select.js')}}"></script>
<!-- plugins JS
		============================================ -->
<script src="{{asset('lls_assets/js/plugins.js')}}"></script>
<!--  Chat JS
		============================================ -->
<script src="{{asset('lls_assets/js/moment.min.js')}}"></script>

<!-- main JS
		============================================ -->
<script src="{{asset('lls_assets/js/main.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="{{asset('assets/js/datatables.js')}}"></script>
<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" ></script>

<script>
function toast_message_success(message){
	Toastify({
	text: message,
	close: true,
	style: {
    background: "#222E3C",
  	},
	offset: { // horizontal axis - can be a number or a string indicating unity. eg: '2em'
		y: 250 // vertical axis - can be a number or a string indicating unity. eg: '2em'
	},
  	position: "center", // `left`, `center` or `right`
	}).showToast();
}

function toast_message_error(message){
	Toastify({
	text: message,
	close: true,
	style: {
    background: "#dc3545",
  	},
	offset: { // horizontal axis - can be a number or a string indicating unity. eg: '2em'
		y: 250 // vertical axis - can be a number or a string indicating unity. eg: '2em'
	},
  	position: "center", // `left`, `center` or `right`
	}).showToast();
}



function _insertAjax(url,form,table){
		form.find('span[class=error]').remove();
		$.ajax({
			url : base_url + url,
			method : 'POST',
			data : form.serialize(),
			dataType: 'json',
			headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        	},
			success :function(data){
				if(data.response){
						toast_message_success(data.message);
						form[0].reset();
						
						if(table != null) {
							table.ajax.reload();
						}
            	}else {
					toast_message_error(data.message);
				}

				form.find('button').prop('disabled',false);
				form.find('button').text('Submit');
			},
			error:function(err){
				if (err.status == 422) { // when status code is 422, it's a validation issue
					form.find('button').prop('disabled',false);
					form.find('button').text('Submit');
					// $('.submit-loader').addClass('d-none');
					// // display errors on each form field
					$.each(err.responseJSON.errors, function(i, error) {
						var el = form.find('[name="' + i + '"]');
						el.after($('<span style="color: red;" class="error">' + error[0] +
							'</span>'));

					});
            	}
			}
			

		});
	}
</script>