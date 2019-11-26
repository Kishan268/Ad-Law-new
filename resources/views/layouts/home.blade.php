@include('layouts.topbar')
 @include("layouts.header_slider")
    	<div id="main" class="pt-4" >
    		<section id="main-quick-menu" class="text-center quick-menu border-bottom">
    			<div class="container">
    				<div class="row ">

    					<div class="col-sm-4 col-xs-12  border-right find"> 
    						<a href="{{url('/lawyer_lawfirm')}}" class="media text-left non-underline-link" style="text-decoration: none"> 
    							<span> 
    								<img class="media-object" src="images/lawyers-law firm1.png" alt="Image"> </span> 
    								<span class="media-body text-dark pl-2">
    									<h4 class="media-heading font-weight-bold">Lawyers / Law Firms</h4>
    									<p class="text-capitalize font-weight-normal">Feature  lawyers / Lawfirms</p>
    								</span>  
    							</a> 
    						</div>

    						<div class="col-sm-4 col-xs-12 border-right find"> 
    							<a href=""  class="media text-left" style="text-decoration: none"> 
    								<span> 
    									{{-- <img class="media-object" src="images/law_company.png" alt="Image">  --}}
                                        <img class="media-object" src="images/Guest1.png" alt="Image"> 
    								</span> 
    								<span class="media-body text-dark pl-2">
    									<h4 class="media-heading font-weight-bold">Users / Guest </h4>
    									<p class="text-capitalize font-weight-normal">Feature Users / Guest</p>
    								</span> 
    							</a> 
    						</div>

    						<div class="col-sm-4 col-xs-12"> 
    							<a href=""  class="media text-left" style="text-decoration: none"> 
    								<span>   
    									{{-- <img class="media-object" src="images/law_collage.png" alt="Image">  --}}
                                        <img class="media-object" src="images/Law-School1.png" alt="Image"> 
    								</span> 
    								<span class="media-body text-dark pl-2">
    									<h4 class="media-heading font-weight-bold">Law Schools</h4>
    									<p class="text-capitalize font-weight-normal">Feature  Law schools</p>
    								</span> 
    							</a> 
    						</div>
    					</div>		
    				</div>
    			</section>
    		</div> 
{{-- @include('pages.find_lawyer_by') --}}
{{-- @include('pages.find_research_platform') --}}
@include('pages.features')
{{-- @include('pages.research_program') --}}
{{-- @include('pages.recent_articles') --}}
@include('layouts.footer')
