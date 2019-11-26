@extends("layouts.default")
@section("content")
<div class="container mt-5">
 <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12 mb-4">
            <h2 class=""><b>Case Law Analysis</b></h2>
                 <hr class="m-0">
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12">
            <div class="row">
            <div class="col-md-8 "> 
                <div class="row">
             <div class="col-md-12">
 <div class="col-lg-3 col-md-4 col-xs-6 thumb pull-right mb-4">
                <a href="{{asset('images/Case Laws Analysis Sample.jpg')}}" target="_blank" data-toggle="modal" data-target="#legal" data-title="Integrated Legal Research">
                   <img src="{{asset('images/Case Laws Analysis Sample.jpg')}}"  class="zoom img-fluid "> 
                </a>
            </div>
            {{-- modal --}}
            <div class="modal modal fade mt-5" id="legal" tabindex="-1">
    <div class="modal-dialog modal-lg bg-white">
          <button type="button"  id="btn" class="close position-absolute text-white rounded-circle" data-dismiss="modal">&times;</button> 
        <!-- Modal body -->
        <div class="modal-body">
         <img src="{{asset('images/Case Laws Analysis Sample.jpg')}}"  class=" img-fluid "> 
        </div>

    </div>
  </div>
                <ul>
                    <p><li><strong>COURSE NAME &nbsp;:</strong> &nbsp;CASE LAW ANASYSIS</li></p> 
                <p><li><strong>ARTICLE WRITTING COURSE CODE&nbsp;:</strong> ADLCLA001</li></p> 
                <p><li><strong>DURATION&nbsp;:</strong> Based On The Content For Research ( Number of Judgments).</li></p> 
                <p><li><strong>ELIGIBILITY FOR RESEARCH&nbsp;:</strong> Law Students</li></p> 
                <p><li><strong>MODE OF RESEARCH &nbsp;:</strong> Online with protected login id for each Student.</li></p> 
                <p><li><strong>NATURE OF WORKSHOP  &nbsp;:</strong> Research.</li></p>
                <p>
                </ul>
                <br>
<h4><strong>INTRODUCTION</strong></h4>
<hr>
<p>
The phrase ‘Legal Research’  has now become a very common term used by the legal fraternity mainly the law students, individual lawyers and any individual working in a law company or a legal cell of a corporate. For an amateur law professional the term legal research is just confined to search a case law, on the contrary its not just refrained to searching caselaw. The law research further broadens the horizon of case law search by analyzing information available, understanding and applying of relevant law or statutes. Be it legislation, case laws or judgments  delivered  by higher courts a law practioners should be awared of the exisiting laws, the practices and the procedures, to be able to fully and efficiently cater to the interests of a client for a relevant case to be arugued in the court of law. The purpose of such research spans from constructing the arguments a lawyer needs to forward in a court of law to the documents she/he needs to study for a due diligence exercise required to be conducted prior to a transaction.
</p>
<p>Case Law Analysis is derived from the detail research, Case law research and analysis is a vital in legal profession,to aquire a skill set that begins from the very first day of law school. It’s a start of a journey of exploring, understanding and applying the law in the practical scenario.  A well-researched and articulated argument assists the Court in deciding the case, which in turn accelerates the process of justice dispensation, which is ideally the ultimate aim of the entire exercise of litigation.</p>
<p>
<h4><strong>OBJECTIVE</strong></h4>   
<hr>     
This is basic level research workshop. The main objective of this short term course is to get a law student aware of various data points in case judgments. These data points are always usefull for any research analysis of that can pivot around the judgment or the conclusion of any case. The data point can be gatherd by the research analyst and relate it with the conclusion or the out come of the judgments. Some of the standards data point that is always available. Judgment Title, Judgment Date, Citation, acts,etc  and conclusion</p>
<p>
    <h4><strong>RESEARCH CONTENT</strong></h4><hr>
        <ul type="disc">
          <li>Judgments delivered from various High courts in India and Supreme Court of India is provided for the researh. </li>
          <li>List of all the India bare acts are also provided for each students. Students study the Judgments delivered by various courts and generate the data points</li>
          <li>Indian bareacts content, Since Act and section imposed is the fulcrum of the judgments based on which the arguments are conducted the list of various act are provided to each studentws doing research on judgments and conclusion.</li>
          <li>A user-friendly web based interface is provided to each student to genrated the various pre defined data points of judgment. The interface also provides features to generate custom data point by each research that enable them to have a detail research analysis of judgments</li>
          <li>Interface to generating the case summary this can be the summary of the Analysis of the judgments that student can generate.</li>
        </ul>
</p>
<p>
    <h4><strong>WORSHOP EXIT</strong></h4>
    <hr>
    <ul type="circle">
        <li>On successful completion of the research workshop the students recives a completion certificate with grades</li>
        <li>It makes a student aware of various case and get then habitual to read and research cases. This is very helpful when the students argues.</li>
        <li>Makes a student capable of providing legal research assistance to lawyers in  a law firm Or as an assistant to senior lawyers looking for research students.</li>
        <li>Once a student is a legal researcher  that is often termed as  paralegal or legal assistant who is capable of examining a legal history and precedent, often to provide pertinent background information on a case to a lawyer or law firm.</li>
        <li>Enables one to generate the data p[oijnt needed for any research platoform.</li>
        <li>Open up an avenue for getting prestigious jobs in corporate as leagl advisors or legal consultants. </li>
    </ul>
</p>
<p>
    <h4><strong>WORKSHOP SUMMARY</strong></h4>
    <hr>
    <ul type="square">
        <li>Analysing judgments delivered by Supreme Court of India. </li>
        <li>Interns have to fill the related fields after studying the judgments given in judgment body.</li>
        <li>Targets will be provided based on your calibre and skills.</li>
        <li>The most important field will be discriptionand abstract writing in which intern have to understand under which category the case will fall.</li>
        <li>Abstract writing will comprise of brief of the case intern in working on. There are some rules which an intern have to follow in Case Law Analysis.</li>
    </ul>
</p>

</div>
</div>
</div>
@include('pages.articles_sidebar')
{{-- <div class="col-md-3 col-sm-3 col-xs-12" id="sidebarCerticate">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-12">
                   
                    <h5><b>Follow Us <i class="fa fa-thumbs-up" ></i></b></h5>
                </div>
                 <div class="col-sm-12 col-md-12 col-xl-12">
                       <ul class="list-unstyled d-flex">
                        <li class="mr-3"><a href="#" class="fa fa-facebook"></a></li>
                        <li  class="mr-3"><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-12 col-xl-12">
                    <hr class="mt-2">
                    <h5><b>Recent News <i class="fa fa-newspaper-o"></i></b></h5>
                </div>
                <div class="col-sm-12 col-md-12 col-xl-12">
                    <hr class="mt-2">
                    <h5><b>Recent Blogs </b></h5>
                </div>
            </div>
               
    
           </div> --}}
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

    
   
