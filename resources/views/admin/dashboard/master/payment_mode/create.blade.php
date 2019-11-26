@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Create Payment Mode <a href="{{route('payment_mode.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('payment_mode.store')}}" method="post" >
						@csrf 
							<div class="row form-group">							
								<div class="col-md-6">
									<label for="">Payment Mode Name <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" name="name" required="" placeholder="Enter Payment Mode Name" value="{{old('name')}}">
									@error('name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
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
