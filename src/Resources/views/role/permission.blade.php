@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Role Permission Page',
	'content_header' => 'Role Permission Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('role_index')."'>Role</a>"
					],
			'active' => "Permission Page",
		],
	])
@section('content')
	<div class="container-fluid">
		@include('role::messages.error')
		@include('role::messages.success')
 	    <form action="{{ Route('role_permission_store') }}" method="post" role="form">
 	    	@csrf
 	    	<div class="row" style="margin-left: 15px;">
	 	        <div class="col-md-4">      
		 	    	<div class="card card-primary">
		 	    	    <div class="card-body">
	 	                  	<div class="form-group">
	 	                      	<select data-event="change" data-url="{{ Route('get_role_permission') }}" data-type="GET" data-datatype="json" data-datavalue="self" data-callback="setRolePermission"  class="form-control input_required role_id" name="role_id" onchange="" >
	 	                          	<option value="">{{__('-- Select Role --')}}</option>
	 	                          	@if(isset($roles) && count($roles) > 0)
		 	                          	@foreach($roles as $role) 
		 	                            	<option value="{{ $role->id_role ?? ''}}" {{old('role_id') == $role->id_role ? 'selected' : ''}}>{{ $role->name ?? ''}}</option>
		 	                          	@endforeach
	 	                          	@endif
	 	                      	</select>
	 	                  	</div>
	 	              	</div>
		 	        </div>
		 	    </div>
	 	    </div>
          	<div class="all_checkbox" id="all_checkbox" style="margin-left: 15px !important;margin-right: 15px !important;">
          		<div class="row" id="route_name_wrap">
                 	@foreach($routes as $route)
                   		<article id="{{ $route['wrap_group'] }}" class="route_name_select_group {{ $route['wrap_group'] }} col-xs-4 col-sm-4 col-md-4 col-lg-4">
	                       	<div class="card card-primary">
	                       		<div class="card-header">
	                       			<div class="float-left">
	                       		  		<h3 class="card-title">{{ $route['wrap_group_level'] }}</h3>
	                       		  	</div>
	                       		  	<div class="float-right">
	                       		  		<span style="padding: 5px; cursor: pointer;" class="text-right badge route_name_select_all">All</span>
	                       		  	</div>
	                       		</div>
	                           <div class="card-body">
	                               	<ul class="list-group">
	                                  	@foreach($route['routes'] as $routes)
			                                <li style="cursor: pointer;" class="list-group-item route_checkbox_group">
			                                   <span style="background-color: transparent;" class="badge">
			                                       <input style="position: unset;left: 0;opacity: 1;" class="route_checkbox mdc-checkbox__native-control {{ $route['wrap_group'] }}_item single_check_box" id="{{ $routes['route_name'] }}" name="menu_list[]" type="checkbox" value="{{ $routes['route_name'] }}">
			                                   </span>
			                                   {{ $routes['name'] }}
			                                </li>
	                                 	@endforeach
	                               	</ul>
	                           </div>
	                       </div>
                   		</article>
                 	@endforeach
                 </div>
          	</div>
          	<div class="form-group">
              	<button class="btn btn-primary btn-outline" type="submit" style="float: right;margin-right: 15px;">{{ __('Set Permission') }}</button>
          	</div>
 	    </form>
	</div>
	<style>
		.container-fluid{
			background-color: #fff;
		    padding-top: 30px;
		    padding-bottom: 45px;
		    margin-left: 10px;
		    margin-right: 10px;
		}
	</style>
@endsection
@section('prescript')
	<script src="{{ asset('media/js/macy.js') }}"></script>
	<script>
		function setRolePermission(results){
			$(".route_checkbox").attr('checked', false);
			if(! typeof results == 'undefined'){
				alert("something Went Wrong.");
	      	}else{
	      		$(".route_checkbox").each(function(index){
	      			$(".route_checkbox").attr('checked', false);
	      			$(this).prop('checked', false);
	      			if($.inArray($(this).val(), JSON.parse(results)) != -1){
	      				$(this).prop('checked', true);
	      			}
	      		});
	      	}
		}
	$(document).ready(function(){
		var macyInstance = Macy({
		  container: '#route_name_wrap',
		  columns: 3,
		  margin: 0,
		  trueOrder: false,
		});
		macyInstance.recalculate();
		macyInstance.runOnImageLoad(function () {
		  macyInstance.recalculate(true);
		}, true);
		macyInstance.remove();
		macyInstance.reInit();
	});
	</script>
@endsection
@section('script')
	<script>
	  $(document).ready(function(){
	      $(".route_checkbox_group").on("click",function(){
	          var checkBoxes = $(this).find(".route_checkbox");
	          checkBoxes.prop("checked", !checkBoxes.prop("checked"));
	      });
	      $(".route_checkbox").on("click", function(){
	          var tcheckBoxes = $(this);
	          tcheckBoxes.prop("checked", !tcheckBoxes.prop("checked"));
	      });
	      $(".route_name_select_all").on("click", function(){
	          var acheckBoxes = $(this).parents(".route_name_select_group").find(".route_checkbox");
	          acheckBoxes.prop("checked", !acheckBoxes.prop("checked"));
	      });
	  });
	</script>
@endsection