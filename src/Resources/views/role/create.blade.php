@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Role Create Page',
	'content_header' => 'Role Create Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('role_index')."'>Role</a>"
					],
			'active' => "Create Page",
		],
	])
@section('content')
	<div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">
			    <form role="form" action="{{Route('role_create_store')}}" method="post">
			    	@csrf
			      <div class="card-body">
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			          	<label for="name">Role Name</label>
			          	<input type="text" class="form-control" name="name" id="name" placeholder="Role name">
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
			          	<option value="1">Active</option>
			          	<option value="0">Inactive</option>
			          </select>
			        </div>
			      </div>
			      <div class="card-footer">
			        <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
			      </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
@endsection
@section('script')	
@endsection