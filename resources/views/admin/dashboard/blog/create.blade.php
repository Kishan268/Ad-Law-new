@extends('admin.main')
@section('content')
<section class="content">
<div class="row">
  <div class="col-md-12 col-xs-12 col-sm-12 m-auto">
    <div class="box box-primary">
      <div class="box-header with-border">
       <h3 class="" style="margin-top: 10px;" >Create Blog <a href="{{route('blog.index')}}" class="btn btn-sm btn-info pull-right">Back</a></h3>
      
    </div>
      <div class="box-body">
        <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
          @csrf
        
            <div class="row form-group">
              <div class="col-md-6">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{old('title')}}"
                 required>
                @error('title')
                  <span class="invalid-feedback d-block text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>     

              <div class="col-md-6 ">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug-target" class="form-control" placeholder="" value="{{old('slug')}}" required>
                   @error('slug')
                  <span class="invalid-feedback d-block text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                <label for="created_at">Date</label>
                <input type="text" name="created_at" value="{{old('created_at')}}" id="created_at"  class="form-control " name="dob"  autocomplete="dob" autofocus  data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d')}}">
                   @error('slug')
                  <span class="invalid-feedback d-block text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            
              <div class="col-md-6 col-xs-6 col-sm-6">
                <label for="status">Status</label>
               <select name="status" class="form-control">
                @foreach($status as $status)
                <option value="{{$status->status_id}}">{{$status->status_desc}}</option>
                @endforeach
               </select>
                  @error('status')
                  <span class="invalid-feedback d-block text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-6 col-xs-6 col-sm-6 mb-2">
                <label for="catg_code">Blog Category <span class="text-danger" >*</span></label>
                <select name="catg_code" class="form-control">
                  <option value="0" disabled selected>Select Blog Category</option>
                  @foreach($blog_catgs as $blog_catg)
                      <option value="{{$blog_catg->catg_code}}">{{$blog_catg->catg_title}}</option>
                  @endforeach   
                </select>

                @error('catg_code')
                  <span class="invalid-feedback d-block text-danger" role="alert">
                  <strong>{{ "The blog category name is required" }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="row form-group">

              <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                  <label for="body">Blog Content <span class="text-danger" >*</span></label>
                  <textarea name="body" id="summernote" rows="4" cols="50" class="form-control tinymce" placeholder="Body Content....">{{old('body')}}</textarea>
                    @error('body')
                      <span class="invalid-feedback d-block text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-6 col-md-6 col-xs-6 mb-2">
                  <label class="image_url">Image</label>
                  <input type="file" name="image_url"  >
                  <p class="help-block">Blog image upload here</p>
                   @error('image_url')
                  <span class="invalid-feedback d-block text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12 col-xs-12 col-sm-12 mt-2">
                  <input type="hidden" name="author_id" value="{{ Auth::user()->id }}">
                  <button type="submit" class="btn btn-primary btn-md">Submit</button>
                </div>
            </div>
           
         
        </form>
      </div>
    </div>
  </div>
</div>
</br></br>
</section>
<script>


   


</script>


<script>
 $(document).ready(function(){
    $(function () {
      $("#created_at").datepicker({ 
        singleDatePicker: true,
        showDropdowns: true,
      });
    });

  $('#title').blur(function(e){
    var Text = document.getElementById("title").value;
    Text = Text.toLowerCase();
    Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
    $("#slug-target").val(Text); 
  });
tinymce.init({
  /* replace textarea having class .tinymce with tinymce editor */
    selector: "textarea.tinymce",
    // theme: "modern",
    // skin: "lightgray",
    plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  preview fullpage | forecolor backcolor emoticons",

    height: 300,
  });
 

   });
</script>
@endsection