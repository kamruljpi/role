@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Role Edit Page',
	'content_header' => 'Role Edit Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('role_index')."'>Role</a>"
					],
			'active' => "Edit Page",
		],
	])
@section('content')
	<div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">
			    <form role="form" action="{{Route('role_create_update',$data->id_role)}}" method="post">
			    	@csrf
			      <div class="card-body">
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			          	<label for="name">Role Name</label>
			          	<input type="text" class="form-control" name="name" id="name" placeholder="Role name" value="{{$data->name ?? old('name')}}">
			          	@if($errors->has('name'))
	                    	<span class="help-block">
		          	            <strong>
		          	            	{{ $errors->first('name') }}
		          	            </strong>
	                    	</span>
	                  	@endif
			        </div>
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			          <label for="is_active">Status</label>
			          <select name="is_active" class="form-control">
			          	<option value="1" {{$data->is_active == 1 ? 'selected' : ''}}>Active</option>
			          	<option value="0" {{$data->is_active == 0 ? 'selected' : ''}}>Inactive</option>
			          </select>
			        </div>
			      </div>
			      <div class="card-footer">
			        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
			      </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
@endsection
@section('script')	
@endsection