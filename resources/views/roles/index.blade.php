@extends('layouts.master')
@section('css')
     <!--Internal Notify -->
     <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@section('title')
     User permissions - Mora Soft for Legal Department
@stop


@endsection
@section('page-header')
<!--breadcrumb -->
<div class="breadcrumb-header justify-content-between">
     <div class="my-auto">
         <div class="d-flex">
             <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                 User permissions</span>
         </div>
     </div>
</div>
<!--breadcrumb -->
@endsection
@section('content')


@if (session()->has('Add'))
     <script>
         window.onload = function() {
             notif({
                 msg: "Permission added successfully",
                 type: "success"
             });
         }

     </script>
@endif

@if (session()->has('edit'))
     <script>
         window.onload = function() {
             notif({
                 msg: "The credentials were updated successfully",
                 type: "success"
             });
         }

     </script>
@endif

@if (session()->has('delete'))
     <script>
         window.onload = function() {
             notif({
                 msg: "The permission was deleted successfully",
                 type: "error"
             });
         }

     </script>
@endif

<!--row -->
<div class="row row-sm">
     <div class="col-xl-12">
         <div class="card">
             <div class="card-header pb-0">
                 <div class="d-flex justify-content-between">
                     <div class="col-lg-12 margin-tb">
                         <div class="pull-right">
                             {{-- @can('Add validity') --}}
                                 <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">Add</a>
                             {{-- @endcan --}}
                         </div>
                     </div>
                     <br>
                 </div>

             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table mg-b-0 text-md-nowrap table-hover">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Name</th>
                                 <th>Operations</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($roles as $key => $role)
                                 <tr>
                                     <td>{{ ++$i }}</td>
                                     <td>{{ $role->name }}</td>
                                     <td>
                                         {{-- @can('View validity') --}}
                                             <a class="btn btn-success btn-sm"
                                                 href="{{ route('roles.show', $role->id) }}">Show</a>
                                         {{-- @endcan--}}

                                         {{-- @can('Modify validity') --}}
                                             <a class="btn btn-primary btn-sm"
                                                 href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                         {{-- @endcan--}}

                                         @if ($role->name !== 'owner')
                                             {{-- @can('Delete validity') --}}
                                                 {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                 $role->id], 'style' => 'display:inline']) !!}
                                                 {!! Form::submit('delete', ['class' => 'btn btn-danger btn-sm'])!!}
                                                 {!! Form::close()!!}
                                             {{-- @endcan--}}
                                         @endif


                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
     <!--/div-->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
