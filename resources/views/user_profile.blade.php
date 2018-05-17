@extends('layouts.app')

@section('title')
	Profile
@endsection

@section('content')
<div class="container main-container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Profile</h2>
		</div>
		<div class="panel-body">
			<div class="usr1" id="usr1">
				<div class="row">
					<div class="col-xs-12 col-md-4 col-lg-3">
						<div class="userProfileInfo">
							<div class="image text-center">
								<img src="{{ $user['avatar_url'] }}" alt="#" class="img-responsive img-circle">
							</div>
							<div class="box">
								<div class="name text-center"><strong>{{ $user['name'] }}</strong></div>
								<div class="info">
									<span>Followers&nbsp;: {{$user['followers']}}</span>
									<span>Following&nbsp;: {{$user['following']}}</span>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-md-8 col-lg-9">
						<div class="box usr-data-box">
							<ul class="nav nav-tabs userProfileTabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab-item-1" aria-controls="tab-item-1" role="tab" data-toggle="tab" aria-expanded="false">Followers</a></li>
								{{-- <li role="presentation" class=""><a href="#tab-item-2" aria-controls="tab-item-2" role="tab" data-toggle="tab" aria-expanded="true">Followers</a></li> --}}
							</ul>

							<div class="tab-content">
								<div role="tabpanel" class="tb-pane tab-pane fade active in" id="tab-item-1">
									<div id="user_followers">
									
									</div>
									<div class="text-center" id="show_more">
										<a href="#" title="#" class="btn btn-primary showMore" id="load_more_btn"><i class="fa fa-refresh"></i> Show more</a>
									</div>
									<div id="page_loader">
										<i aria-hidden="true" class="fa fa-spinner fa-pulse" style=""></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="page_count" value="0">
<input type="hidden" id="followers_url" value="{{ $user['followers_url'] }}">
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
			loadMore();
			$("#page_count").val( 0 );
			$("#load_more_btn").click(function(){
				loadMore();
			});

			function loadMore(){
				var base_url = '{{url('')}}'+'/profile?profile_url=';
				var next_page_count = parseInt($("#page_count").val()) + 1;
				var next_url = $("#followers_url").val() + "?page=" + next_page_count
				var html_code = '';

				$.ajax({
						url: "{{$user['followers_url']}}?page=" + next_page_count,
						type: 'GET',
						success: function(data){ 
									$("#load_more_btn").val(next_page_count);
									console.log('data');
									console.log(status);
									for (var i = 0; i < data.length; i++) {
										html_code += '<section class="search-result-item">';
										html_code += '<a class="image-link" href="#"><img class="image" src="' + data[i].avatar_url + '"></a>';
										html_code += '<div class="search-result-item-body"><div class="row"><div class="col-sm-9">';
										html_code += '<h4 class="search-result-item-heading"><a href="' + base_url+data[i].url + '">' + data[i].login + '</a></h4>';
										html_code += '</div><div class="col-sm-3 text-align-center">';
										html_code += '<a class="btn btn-primary btn-info btn-sm" target="_blank" href="' + base_url+data[i].url + '">View Profile</a>';
										html_code += '</div></div></div></section>';
									}
									
									$("#user_followers").append(html_code);
									
									if ( 29 < data.length) {
										$('#show_more').show();
									}else{
										$('#show_more').hide();
									}
									if ( 0 < data.length){
										$("#page_count").val( parseInt($("#page_count").val()) + 1 );
										$('#page_loader').hide();
									}

									if (data.length == 0 && next_page_count == 1){
										$('#page_loader').hide();
										$("#user_followers").html("There is no Follower");	
									} 
						},
						error: function(data) {
									$('#page_loader').hide();
									$("#user_followers").html("API Limit Exceeded");	
						}
				});

			}
    });
</script>

@endsection