@extends("layouts.default")
@section("content")
<div class="container mt-5">
 <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12 mb-4">
            <h2 class=""><b>Integrated Law Research</b></h2>
                 <hr class="m-0">
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12">
            <div class="row">
            <div class="col-md-8 "> 
                <div class="row">
             <div class="col-md-12">
 <div class="col-lg-3 col-md-4 col-xs-6 thumb pull-right mb-4">
                <a href="{{asset('images/Integrated Legal Research Sample.jpg')}}" target="_blank" data-toggle="modal" data-target="#legal" data-title="Integrated Legal Research" id="legal_rese">
                   <img src="{{asset('images/Integrated Legal Research Sample.jpg')}}"  class="zoom img-fluid "> 
                </a>
            </div>
            {{-- modal --}}
            <div class="modal modal fade mt-5" id="legal" tabindex="-1">
    <div class="modal-dialog modal-lg bg-white">
          <button type="button"  id="btn"class="close position-absolute text-white rounded-circle" data-dismiss="modal">&times;</button>
        <!-- Modal body -->
        <div class="modal-body">
         <img src="{{asset('images/Integrated Legal Research Sample.jpg')}}"  class=" img-fluid "> 
        </div>
    </div>
  </div>
                <ul>
                    <p><li><strong>COURSE NAME &nbsp;: </strong>&nbsp;INTEGRATED LAW RESEARCH</li></p> 
                <p><li><strong>ARTICLE WRITTING COURSE CODE&nbsp;:</strong> ADLCLA003</li></p> 
                <p><li><strong>DURATION&nbsp;:</strong> FLEXIBLE.</li></p> 
                <p><li><strong>ELIGIBILITY FOR RESEARCH&nbsp;:</strong> On completion of <b>course code ADLCLA001 & ADLCLA001</b>.</li></p> 
                <p><li><strong>MODE OF RESEARCH &nbsp;:</strong> Online with protected login id for each Student.</li></p> 
                <p><li><strong>NATURE OF WORKSHOP  &nbsp;:</strong> Research , Law Content Writing, Drafting</li></p>
                <p>
                </ul>
                <br>
<h4><strong>INTRODUCTION</strong></h4>
<hr>
<p>Refer Introduction of course <b><i>code ADLCLA001 & ADLCLA001</i></b>.
One of the most mandatory skills that should fit in the professional profile of the lawyer is the capibility of legal drafting. 
</p>
<p>
<h4><strong>OBJECTIVE</strong></h4>   
<hr> 
<p><i>Objectives of course <b><i>ADLCLA001</i></b> and ADLCLA002 is further expanded in the current course.</i></p>
<p>    
This workshop enables you to learn the basic and the critical rules and principles of drafting legal documents  as this course is designed by law researchers and experianced legal drafting lawyers and paralegals. To enable the law profession to understand the tecnicalities required for legal drafting.
</p>
<p>The goal is to enable the law student to understand of the subject as its completely practice-oriented. Aside from comprehensively covering the best practices for drafting legal documents in general, the course will also focus more closely on contracts, notices, and pleadings.</p>
<p>
    <ul type="disc">
        <li>The general rules and principles of drafting legal documents</li>
        <li>The major provisions under the Indian Contracts Act, 1872</li>
        <li>Learn how to structure a commercial contract.</li>
        <li>Analysing issues in contracts and negotiating terms of the contract.</li>
        <li>Learn how to draft notices and pleadings.</li>
        <li>How to edit and review documents you have drafted.</li>
    </ul>
</p>
    <h4><strong>RESEARCH CONTENT</strong></h4><hr>
        <ul type="square">
          <li>Sample Formats of Documents for Legal Drafting</li>
          <li>Topics for articles Writing</li>
          <li>Suggested sites to explore the research and knowledge</li>
        </ul>
</p>
<p>
    <h4><strong>WORSHOP EXIT</strong></h4>
    <hr>
    <ul type="circle">
        <li>All openings as mention in ADLCLA001 & ADLCLA002</li>
        <li>Professonal Legal drafting</li>
        <li>Opens job opening at various law companies and legal cell of corporate house</li>
        <li>Free lance  Lega article writter</li>
        <li>Enhances the law related technical skills.</li>
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

    
   
