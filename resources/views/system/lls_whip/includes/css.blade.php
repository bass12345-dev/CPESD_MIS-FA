<!-- Google Fonts
		============================================ -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
<!-- Bootstrap CSS
		============================================ -->
<link rel="stylesheet" href="{{asset('lls_assets/css/bootstrap.min.css')}}">
<!-- Bootstrap CSS
		============================================ -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- owl.carousel CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css')}}">
<!-- meanmenu CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('assets/css/meanmenu/meanmenu.min.css')}}">
<!-- animate CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}">
<!-- normalize CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('assets/css/normalize.css')}} ">
<!-- mCustomScrollbar CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('assets/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">

<!-- notika icon CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('assets/css/notika-icon.css') }}">
<!-- wave CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('assets/css/wave/waves.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select/bootstrap-select.css')}}">
<!-- main CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('lls_assets/css/main.css')}}">
<!-- style CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('lls_assets/css/lls.css')}}">
<!-- responsive CSS
		============================================ -->
<link rel="stylesheet" href="{{ asset('lls_assets/css/responsive.css')}} ">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('lls_assets/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.2/jquery.typeahead.css"  />

<style>
	.form-ic-cmp label{
		top: 7px;
		position: relative;
	}

	.first_col_lls {
		content: '';
		border-right: 1px solid red;
	}
	
	.top-logo { height: 100px; width: 100px; }

	table th {
		color: #fff !important;
		background-color: #222e3C;
		
	}
	.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #FFF;
    border-bottom-color: #FF3D00;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    } 

	.notika-bg-success {
		background-color: green;
	}
	.notika-bg-danger {
		background-color: red;
	}

	.header_title_container {
		margin-bottom: 40px; 
		text-align:center; 
		background-color: #222E3C; 
		color: #fff; 
		padding: 20px;
	}
	.header-typeahead {
		text-align:center; 
		font-size: 15px;
		background-color: #222E3C;
		color: #fff;
		padding: 10px;

	}

	.actions {
		display: flex;
		flex-direction: row;
		gap: 4px;
	}

	.twitter-typeahead{
width:100%;
}

.twitter-typeahead .tt-input,
.twitter-typeahead .tt-hint {
  margin-bottom: 0;
}

.tt-menu {
  min-width: 160px;
  margin-top: 2px;
  padding: 5px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0,0,0,.2);
  *border-right-width: 2px;
  *border-bottom-width: 2px;
  -webkit-border-radius: 6px;
     -moz-border-radius: 6px;
          border-radius: 6px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
  -webkit-background-clip: padding-box;
     -moz-background-clip: padding;
          background-clip: padding-box;
  width:100%;        
}

.tt-suggestion {
  display: block;
  padding: 3px 20px;
}

.tt-suggestion.tt-cursor {
  color: #fff;
  background-color: #0081c2;
  background-image: -moz-linear-gradient(top, #0088cc, #0077b3);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0077b3));
  background-image: -webkit-linear-gradient(top, #0088cc, #0077b3);
  background-image: -o-linear-gradient(top, #0088cc, #0077b3);
  background-image: linear-gradient(to bottom, #0088cc, #0077b3);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0077b3', GradientType=0)
}

.tt-suggestion.tt-cursor a {
  color: #fff;
}

.tt-suggestion p {
  margin: 0;
}

.mb-5 {
	margin-bottom: 10px;
}
</style>

