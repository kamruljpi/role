@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Roles',
	'content_header' => 'Roles',
	'breadcrumb' => [
			'items' => "<a href='".Url('admin/')."'>Home</a>",
			'active' => "Role",
		],
	])
@section('content')
  @include('role::messages.error')
  @include('role::messages.success')
	<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        	<div class="row">
	        	<div class="col-md-10">
              <a href="{{Route('role_permission')}}" class="btn btn-success">Role Permission</a>  
            </div>
	        	<div class="col-md-2">
	        		<div class="text-right">	        			
	        			<a href="{{Route('role_create')}}">{{__("Create")}}</a>
	        		</div>
	        	</div>
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            	@if(isset($details))
            		@php($i = 1)
            		@foreach($details as $key => $value)
            			<tr>
            			  <td>{{$i++}}</td>
            			  <td>{!! $value->name !!}</td>
            			  <td>{!! $value->is_active !!}</td>
            			  <td>
            			  	<a href="{{route('role_create_edit',$value->id_role)}}" class="btn btn-success">{{__('edit')}}</a>

                      <a href="#" class="btn btn-danger"
                         onclick="event.preventDefault();
                                       document.getElementById('delete-form').submit();">
                          {{ __('Delete') }}
                      </a>

                      <form id="delete-form" action="{{route('role_distroy',$value->id_role)}}" method="POST" style="display: none;">
                          @method('delete')
                      </form>
            			  </td>
            			</tr>
            		@endforeach
            	@endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection

@section('script')
	<script>
	  $(function () {
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	    });
	  });
	</script>
@endsection