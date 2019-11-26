@extends(Auth::user()->user_catg_id=='4' ? 'lawschools.layouts.main' : 'lawfirm.layouts.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h4>Manage Teams</h4>
				<button class="btn btn-md btn-primary" id="teamBtn">Teams</button>
				<button class="btn btn-md btn-default" id="membBtn">Users</button>
			</div>	
			<div class="box-body" id="mainDiv">
				@include('teams.show')
			</div>
		</div>
	</div>
</div>

</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('.myTable').DataTable();

	});
	$('#teamBtn').on('click',function(e){
		e.preventDefault();

 		$.ajax({
			type:'GET',
			url: '{{route('teams.show', Auth::user()->id)}}',
			success:function(data){
				$('#mainDiv').empty().html(data);
			}
		});
		$('#teamBtn').addClass('btn-primary');
		$('#membBtn').removeClass('btn-primary');

	});
	$('#membBtn').on('click',function(e){
		e.preventDefault();
		$.ajax({
			type:'get',
			url: '{{route('users.show', Auth::user()->id)}}',
			success:function(data){
		
				$('#mainDiv').empty().html(data);
			}
		});
		$('#membBtn').addClass('btn-primary');
		$('#teamBtn').removeClass('btn-primary');
	});



</script>
@endsection