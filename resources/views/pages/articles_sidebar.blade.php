
<div class="col-md-4 col-sm-4  border mt-2" style="background: #ffffff">
	@php 
	  $all_articles = \App\Blog::paginate(5);
	@endphp
	<div class="row">
		<div class="col-md-12">
			<h4>Popular Post</h4>
			<hr>
		</div>
		<div class="col-md-12">
			
			@foreach($all_articles as $articles)
			
				<ul class="list-unstyled">
					<li>
						<div class="d-flex">
							<div class="item-thumbnail">
								<div class="img-hover-zoom">
								@if($articles->image_url != ''){{-- <a href=""> --}}
									<!--Zoom effect-->

									<img alt="" border="0" height="72" src=" {{ asset('/storage/app/public/blogs/'.$articles->image_url) }}" width="72" >
								@else								
									<img alt="" border="0" height="72" src="{{asset('/storage/app/public/blogs/blog_default.png')}}" width="72" >
								
								@endif
								</div>
								{{-- 	</a> --}}
							</div>
							<div class="item-title ml-2">
								<a href="{{ url('/display_blogs/'.$articles->slug) }}">{{$articles->title}}</a>
								<p class="text-muted mt-2"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;@php
								$date= date('M-d-Y', strtotime($articles->created_at));
								echo  str_replace('-', ',' ,$date);
							@endphp</p>
							</div>
						</div>
						<div style="clear: both;"></div>
					</li>
				<hr>
				</ul>
	
			@endforeach


		</div>

	</div>
	<div class="row">
		<div class="col-md-12" data-version="1" id="Label1">
			<h4>Our Categories	</h4>
			<hr class="border">
			<div class="widget-content list-label-widget-content">
				<ul class="list-unstyled">
					<li>
						<i class="fa fa-tag" aria-hidden="true"></i>
						<a dir="ltr" href="">Legal</a>
						<span class="pull-right">(15)</span>
					</li>
					<li>
						<i class="fa fa-tag" aria-hidden="true"></i>	
						<a dir="ltr" href="">Student laws Works</a>
						<span class="pull-right">(15)</span>
					</li>
					<li>
						<i class="fa fa-tag" aria-hidden="true"></i>
						<a dir="ltr" href="">Law Design</a>
						<span class="pull-right">(15)</span>
					</li>
					<li>
						<i class="fa fa-tag" aria-hidden="true"></i>
						<a dir="ltr" href="">News</a>
						<span class="pull-right">(15)</span>
					</li>
					<li>
						<i class="fa fa-tag" aria-hidden="true"></i>
						<a dir="ltr" href="">Video Tuts</a>
						<span class="pull-right">(15)</span>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h4 class="">Our Newsletter!</h4>
			<hr >
			<div class="card">
				<div class="card-header">					
					<form role="Form" method="GET" action="" accept-charset="UTF-8">				
						<div class="input-group">
							<input class="form-control" type="text" name="search" placeholder="Sign up for our newsletter..." required/>
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button">Sign up</button>
							</div>
						</div>					
					</form>
						
				</div>
			</div>
		</div>
		<div class="col-md-12 mt-2">
			<h4 class="text-center">Social Media!</h4>
			<hr class="border">
			<div class="text-center">
				<a href=""><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-facebook-square fa-2x ml-3" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-twitter fa-2x ml-3" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-linkedin fa-2x ml-3" aria-hidden="true"></i></a>
			</div>
			<br>
		</div>
	</div>
		
</div>
	<!-- End Searchy blog-->