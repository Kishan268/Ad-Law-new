@extends(Auth::user()->user_catg_id == 2 ? 'lawfirm.layouts.main' : (Auth::user()->user_catg_id == 3 ? 'lawfirm.layouts.main' : 'admin.main'))
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Create User 
						@role(['lawyer','lawcompany'])
							<a href="{{route('teams.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
						@endrole
						@role('admin')
							<a href="{{route('users.index')}}" class="btn btn-sm btn-primary pull-right">Back</a>
						@endrole
						</h3>
					</div>
					<div class="box-body">
						<form action="{{route('users.store')}}" method="post">
							@csrf
							@role('admin')
							<div class="row form-group">
								<div class="col-md-6">
									<label for="user_catg_id">Select User Type <span class="text-danger">*</span></label>
									 <select name="user_catg_id" class="form-control" id="user_catg_id"  >
		                                <option value="0">Select User Type</option>
			                                @foreach($roles as $role)
			                                    <option value="{{ $role->id}}" {{old('user_catg_id')== $role->id ? 'selected' : ''}}>{{ $role->display_name}}</option>
			                                @endforeach
		                               </select>

		                                @error('user_catg_id')
		                                    <span class="text-danger">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
								</div>	
							</div>
							@endrole
							<div class="row form-group">
								<div class="col-md-6">
									<label for="name">Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="name" value="{{old('name')}}">  
									@error('name')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror      
								</div>	
								<div class="col-md-6">
									<label for="email">Email Address <span class="text-danger">*</span></label>
									<input type="text" name="email" class="form-control" value="{{old('email')}}">
									@error('email')
	                                    <span class="text-danger">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
							</div>	
							<div class="row form-group">	
								<div class="col-md-6">
									<label for="mobile">Mobile Number <span class="text-danger">*</span></label>
									<input type="text" class="form-control timepicker" name="mobile" value="{{old('mobile')}}"> 
									@error('mobile')
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
@endsection