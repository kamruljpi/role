@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Role Page',
	'content_header' => 'Role Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('role_index')."'>Role</a>"
					],
			'active' => "Role Page",
		],
	])
@section('content')
	<div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">

		    	@if(isset($data->id_role) && !empty($data->id_role))
		    		<form role="form" action="{{Route('role_edit_action',$data->id_role)}}" method="post">
		    		<input type="hidden" name="id_role" value="{{ isset($data->id_role) ? $data->id_role : 0 }}" id="id_role">
		    	@else
		    		<form role="form" action="{{ Route('role_create_action') }}" method="post">
				@endif

				@csrf
			      <div class="card-body">
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			          	<label for="name">Role Name</label>
			          	<input type="text" class="form-control" name="name" id="name" placeholder="Role name" value="{{ (isset($data->name) && !empty($data->name)) ? $data->name : old('name') }}">
			          	@if($errors->has('name'))
	                    	<span class="help-block">
		          	            <strong>
		          	            	{{ $errors->first('name') }}
		          	            </strong>
	                    	</span>
	                  	@endif
			        </div>
			        <div class="form-group">
			          <label for="is_active">Status</label>
			          <select name="is_active" class="form-control">
			          	<option value="1" {{ (isset($data->is_active) && ($data->is_active == 1)) ? 'selected' : '' }}>Active</option>
			          	<option value="0" {{ (isset($data->is_active) && ($data->is_active == 0)) ? 'selected' : '' }}>Inactive</option>
			          </select>
			        </div>
			      </div>
			      <div class="card-footer">
			        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
			      </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
@endsection
@section('script')	
@endsection