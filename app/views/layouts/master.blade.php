<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/application.css') }}
		{{ HTML::style('js/jquery-2.0.3.min.js') }}
		{{ HTML::style('js/application.js') }}
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/application.css" />
		
		<script src="js/jquery-2.0.3.min.js" type="text/javascript"></script>
		<script src="js/application.js" type="text/javascript"></script>
	</head>
		
	<body>
		
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="http://10.231.87.225:81/new_vote_test/test2/public/">Laravel Vote App</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="http://10.231.87.225:81/new_vote_test/test2/public/school_select">投票結果</a></li>
					</ul>
					<ul class="nav navbar-nav">
					@if (Session::has('builder_name'))
						<li class="active"><a href="http://10.231.87.225:81/new_vote_test/test2/public/manage">管理畫面</a></li>
						<li class="active"><a href="http://10.231.87.225:81/new_vote_test/test2/public/logout/openid">管理者登出</a></li>
					@else
						<li class="active"><a href="http://10.231.87.225:81/new_vote_test/test2/public/login/openid">管理者登入</a></li>
					@endif
					</ul>
				</div>

			</div>
		</div>
		
		
		<div class="container">
			@yield('content')
		</div>
		
	</body>
</html>