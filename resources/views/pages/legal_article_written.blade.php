@extends("layouts.default")
@section("content")
<div class="container mt-5">
 <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12 mb-4">
            <h2 class=""><b>Case Law Analysis & Legal Article Written</b></h2>
                 <hr class="m-0">
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12">
            <div class="row">
            <div class="col-md-8 "> 
                <div class="row">
             <div class="col-md-12">
 <div class="col-lg-3 col-md-4 col-xs-6 thumb pull-right mb-4">
                <a href="{{asset('images/Case Laws Analysis & Legal Article Writing  Sample.jpg')}}" target="_blank" data-toggle="modal" data-target="#legal" data-title="Integrated Legal Research">
                   <img src="{{asset('images/Case Laws Analysis & Legal Article Writing  Sample.jpg')}}"  class="zoom img-fluid "> 
                </a>
            </div>
            {{-- modal --}}
            <div class="modal modal fade mt-5" id="legal" tabindex="-1">
    <div class="modal-dialog modal-lg bg-white">
          <h4 class="modal-title" id="legal-title"></h4>
          <button type="button" id="btn" class="close position-absolute text-white rounded-circle" data-dismiss="modal">&times;</button>
        <!-- Modal body -->
        <div class="modal-body">
         <img src="{{asset('images/Case Laws Analysis & Legal Article Writing  Sample.jpg')}}"  class=" img-fluid "> 
        </div>
    </div>
  </div>
                <ul>
                    <p><li><strong>COURSE NAME &nbsp;: </strong>&nbsp;CASE LAW ANASYSIS & LEGAL ARTICLE WRITTING</li></p> 
                <p><li><strong>ARTICLE WRITTING COURSE CODE&nbsp;:</strong> ADLCLA002</li></p> 
                <p><li><strong>DURATION&nbsp;:</strong> Based On The Content For Research ( Number of Judgments).</li></p> 
                <p><li><strong>ELIGIBILITY FOR RESEARCH&nbsp;:</strong> On completion of <b>course code ADLCLA001</b>.</li></p> 
                <p><li><strong>MODE OF RESEARCH &nbsp;:</strong> Online with protected login id for each Student.</li></p> 
                <p><li><strong>NATURE OF WORKSHOP  &nbsp;:</strong> Research.</li></p>
                <p>
                </ul>
                <br>
<h4><strong>INTRODUCTION</strong></h4>
<hr>
<p>This is an extention of the course code ADLCLA001. Article Writing, will comprise of writing an article relating to law field. Article writing is an art of blogging and can vary from person to person . Articles riting also caters to exploring the content for the relavant topic to generate an authentic content in the article. The content of the article shoul have information quality that enable a netizen to be curious in reading the complete articles. CASE LAW ANASYSIS & LEGAL ARTICLE WRITING is more like a workshop thatb can be on hold your hand and guide the lawyers in generating a infrmation rich quality content.
</p>
<p>
<h4><strong>OBJECTIVE</strong></h4>   
<hr>     
Objectives of course <strong>ADLCLA001</strong> is further expanded in the current course.  Topics are provided to each student which mainly relevant to the legal structure. The article writing in the workshop content enables the student to research and explore the later information that can be consolidated into an article. This enables the student to be aware of the various law realted topics that can be current topics . This is the research topic to enhance the knowledge base of the law students.
</p>
<p>
    <h4><strong>RESEARCH CONTENT</strong></h4><hr>
        <ul type="disc">
          <li>ALL CONTENT OF <b>ADLCLA001</b></li>
          <li>Topics for articles Writing</li>
          <li>Suggested sites to explore the research and knowledge</li>
        </ul>
</p>
<p>
    <h4><strong>WORSHOP EXIT</strong></h4>
    <hr>
    <ul type="circle">
        <li>All openings as mention in ADLCLA001</li>
        <li>Professonal Content or article writes</li>
        <li>Opens job opening at various law publication houses</li>
        <li>Free lance  Lega article writter</li>
        <li>Enhances the writing skill.</li>
    </ul>
</p>
<p>
    <h4><strong>WORKSHOP SUMMARY</strong></h4>
    <hr>
    <ul type="square">
        <li>Analysing judgments delivered by Supreme Court of India. </li>
        <li>Have to submit given Articles in a tenure.</li>
        <li>Targets will be provided based on your calibre and skills.</li>
        <li>Guidance will be provided for Article Writing.</li>
    </ul>
</p>

</div>
</div>
</div>
@include('pages.articles_sidebar')
</div>
</div>
 </div>
</div>
<br><br>
<style type="text/css">
    .zoom:hover {
  transform: scale(1.2); 
}
.zoom {
  transition: transform .1s; /* Animation */
}
#btn{
    background: #111;
   z-index: 904;
    opacity: 1;
    width: 22px;
    top: -14px;
    right: -9px;
}
</style>

@endsection

    
   
