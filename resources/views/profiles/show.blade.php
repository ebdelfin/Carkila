@extends('layouts.app')

@section('template_title')
	{{ $user->name }}'s Profile
@endsection
@section('template_linked_css')
	<link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/post.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/hero.css') }}" />
@endsection

@section('template_fastload_css')

	#map-canvas{
		min-height: 300px;
		height: 100%;
		width: 100%;
	}

@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">

						{{ trans('profile.showProfileTitle',['username' => $user->name]) }}

					</div>
					<div class="panel-body">

    					<img src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" class="user-avatar">

						<dl class="user-info">

							<dt>
								{{ trans('profile.showProfileUsername') }}
							</dt>
							<dd>
								{{ $user->name }}
							</dd>

							<dt>
								{{ trans('profile.showProfileFirstName') }}
							</dt>
							<dd>
								{{ $user->first_name }}
							</dd>

							@if ($user->last_name)
								<dt>
									{{ trans('profile.showProfileLastName') }}
								</dt>
								<dd>
									{{ $user->last_name }}
								</dd>
							@endif

							<dt>
								{{ trans('profile.showProfileEmail') }}
							</dt>
							<dd>
								{{ $user->email }}
							</dd>

							@if ($user->profile)



								@if ($user->profile->location)
									<dt>
										{{ trans('profile.showProfileLocation') }}
									</dt>
									<dd>
										{{ $user->profile->location }} <br />

										@if(config('settings.googleMapsAPIStatus'))
											Latitude: <span id="latitude"></span> / Longitude: <span id="longitude"></span> <br />

											<div id="map-canvas"></div>
										@endif
									</dd>
								@endif

								@if ($user->profile->bio)
									<dt>
										{{ trans('profile.showProfileBio') }}
									</dt>
									<dd>
										{{ $user->profile->bio }}
									</dd>
								@endif

								@if ($user->profile->twitter_username)
									<dt>
										{{ trans('profile.showProfileTwitterUsername') }}
									</dt>
									<dd>
										{!! HTML::link('https://twitter.com/'.$user->profile->twitter_username, $user->profile->twitter_username, array('class' => 'twitter-link', 'target' => '_blank')) !!}
									</dd>
								@endif

								@if ($user->profile->github_username)
									<dt>
										{{ trans('profile.showProfileGitHubUsername') }}
									</dt>
									<dd>
										{!! HTML::link('https://github.com/'.$user->profile->github_username, $user->profile->github_username, array('class' => 'github-link', 'target' => '_blank')) !!}
									</dd>
								@endif
							@endif

						</dl>


						@if ($user->profile)
							@if (Auth::user()->id == $user->id)

								{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-cog', trans('titles.editProfile'), array('class' => 'btn btn-small btn-info btn-block')) !!}

							@endif
						@else

							<p>{{ trans('profile.noProfileYet') }}</p>
							{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-plus ', trans('titles.createProfile'), array('class' => 'btn btn-small btn-info btn-block')) !!}

						@endif


					</div>

				</div>

				<div class="panel">

					<div class="container">
						<h6>User's average rating</h6>
						<div class="rating" style="pointer-events: none;">
							<input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $rating }}" data-size="xs">
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="container">
						<h5>Comments</h5>
						<hr>

						<div class="comments">
							@foreach ($comments as $comment)
								<div class="comment"><div class="comment-avatar"><img src="{{ $comment->user->profile->avatar }}"></div>
									<div class="comment-box">
										<div class="rating">
											<input class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $comment->post->averageRatingForUser($comment->user_id) }}" data-size="xs">
										</div>
										<div class="comment-text">{{ $comment->body }}</div>
										<div class="comment-footer">
											<div class="comment-info">
												<span class="comment-author"><em>{{ $comment->user->name }}</em></span>
												<span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
											</div>

										</div>
									</div>
								</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
			</div>

		</div>

	</div>


@endsection

@section('footer_scripts')
	<script src="{{ asset('js/rating/star-rating.min.js') }}"></script>

	<script type="text/javascript">
        $(document).ready(function(){
            $(".menu").on("click", function(){
                var dataMenu = $(this).data("menu");
                var contentItem = $(".content .item[data-item="+ dataMenu +"]");
                if (!$(this).hasClass("active") && !contentItem.hasClass("active")) {
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    contentItem.siblings().removeClass("active");
                    contentItem.addClass("active");
                }
            });
        });
	</script>
	@if(config('settings.googleMapsAPIStatus'))
		@include('scripts.google-maps-geocode-and-map')
	@endif

@endsection
