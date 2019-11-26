@extends(Auth::user()->user_catg_id=='4' ? 'lawschools.layouts.main' : 'lawfirm.layouts.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Create Team <a href="{{route('teams.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('teams.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-6">
									<label for="name">Team Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="name" value="{{old('name')}}">  
									@error('name')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror  
	                                @if($message = Session::get('error'))
										<span class="text-danger">
											 <strong>{{ $message }}</strong>
										</span>
									@endif    
								</div>	
								<div class="col-md-6">
									<label for="users">members <span class="text-danger">*</span></label>
									<select name="users[]" class="form-control select2" multiple="multiple" >
										<option value="{{Auth::user()->id}}" {{ (collect(old('team_id'))->contains(Auth::user()->id)) ? 'selected':'selected' }} locked="locked">{{Auth::user()->name}}</option>
										@foreach($users as $user)
											<option value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
									</select>
									@error('users')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror  
								</div>
							</div>									
							<div class="row ">
								<div class="col-md-12 ">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script >
		$(document).ready(function(){
			$('.select2').select2({
	tags: true,
	placeholder: 'Select an option',
	templateSelection : function (tag, container){
			// here we are finding option element of tag and
	// if it has property 'locked' we will add class 'locked-tag' 
	// to be able to style element in select
		var $option = $('.select2 option[value="'+tag.id+'"]');
	if ($option.attr('locked')){
	   $(container).addClass('locked-tag');
	   tag.locked = true; 
	}
		return tag.text;
	},
})
.on('select2:unselecting', function(e){
		// before removing tag we check option element of tag and 
  // if it has property 'locked' we will create error to prevent all select2 functionality
   if ($(e.params.args.data.element).attr('locked')) {
       e.preventDefault();
    }
 });
		});
	</script>
@endsection
