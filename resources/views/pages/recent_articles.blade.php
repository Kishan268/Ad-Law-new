<div class="footer-why  bg-white  mt-4 ">
    <div class="container-fluid ">
      <h2 class="text-center">Blogs And News</h2>

      <div class="row border-top mt-5">
        <div class="col-sm-6 ">
            <div class="item-post">
                <div class="row item-heading ">
                    <div class="col-md-12" style="border-right: 3px solid #dee2e6;">              

                        <div class="item-icon d-inline">
                          @foreach($blogs as $blog)
                            <div class="widget-content popular-posts mt-3 ml-4">
                                <ul class="list-unstyled">
                                  <li>
                                  <div class="d-flex">
                                      <div class="item-thumbnail">
                                      @if($blog->image_url !='')
                                      <a href="{{ url('/display_blogs/'.$blog->slug) }}"><img alt="" border="0" src=" {{ asset('/storage/app/public/blogs/'.$blog->image_url) }}" class=" rounded blog_img"></a>
                                      @else
                                       <a href="{{ url('/display_blogs/'.$blog->slug) }}"> <img alt="" border="0" src=" {{ asset('/storage/app/public/blogs/blog_default.png') }}" class=" rounded blog_img"></a>
                                      @endif


                                      </div>
                                      <div class="item-title ml-2">
                                      <a href="{{ url('/display_blogs/'.$blog->slug) }}">{{$blog->title}}</a>
                                    
                                      <p class="text-muted mt-2"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                                         {{date('M d, Y', strtotime($blog->created_at))}}
                                      </p>
                                      </div>
                                  </div>
                                  <div style="clear: both;"></div>
                                  </li>
                                </ul>
                          </div>
                          @endforeach
                          <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>  
        <div class="col-sm-6 ">
            <div class="item-post">
                <div class="row item-heading">
                    <div class="col-md-12" style="border-right: 3px solid #dee2e6;">
                        <div class="item-icon d-inline">
                        @foreach($blogs1 as $blog1)
                            <div class="widget-content popular-posts mt-3 ml-4">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="d-inline-flex">
                                            <div class="item-thumbnail">
                                                @if($blog1->image_url !='')
                                                <img alt="" border="0" src=" {{ asset('/storage/app/public/blogs/'.$blog1->image_url) }}" class=" rounded blog_img">
                                                @else
                                                <img alt="" border="0" src=" {{ asset('/storage/app/public/blogs/blog_default.png') }}" class=" rounded blog_img">
                                                @endif
                                            </div>
                                            <div class="item-title ml-2">
                                                <a href="{{ url('/display_blogs/'.$blog1->slug) }}">{{$blog1->title}}</a>
                                                <p class="text-muted mt-2"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp; {{date('M d, Y', strtotime($blog->created_at))}}</p>
                                            </div>
                                        </div>
                                    
                                    </li>

                                </ul>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
         <div class="col-md-12 mb-2">
            <a href="{{url('/more_articles')}}" class="btn btn-outline-secondary more-link-new pull-right ">View All</a>
            <br> <br> 
        </div>
      </div>
    </div>
</div>
