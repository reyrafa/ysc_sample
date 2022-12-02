@extends('officer.admin.layouts.dashboard')
@section('content')
    <div class="mt-4 row pt-4">
        <div class="col-md-10">
            <h1 style="text-transform: uppercase; font-size:20px"><b> User management</b></h1>
        </div>
        <div class="col-md-2 mb-2">
            
        </div> 
        <div class="col-md-2"></div>
        <div class="col-md-3 mb-3">
        
        </div>
        <div class="col-md-3 mb-3">
            
        </div>
        
        <div class="col-md-3 mb-3">
            <form 
                action="/" 
                method="GET"
                >
                <div class="input-group">   
                    <div class="form-outline">
                      <input 
                          type="search" 
                          id="search" 
                          name="query"
                          class="form-control" 
                          placeholder="Search Officer"/>

                    </div>
                    <button type="button" class="btn btn-success disabled">
                        <i class="fa fa-search"></i>
                    </button>
                </div>  
            </form>
        </div> 
        <div class="col-md-1 mb-3">
        <a href="/admin/user/management/add/user" class="btn btn-primary" style="width: 80px;"><i class="fa fa-pencil" aria-hidden="true"></i><span> Add</span></a>
        </div>
    </div>
    <div class="bg-white mt-3 overflow-hidden shadow rounded px-3 py-4">
    <div class="table-responsive">

            <table class="table stripe align-middle hover" id="user_table"> 
                <thead>
                    <th style="display:none">No</th>
                    <th>Company ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Branch</th>
                    <th>Branch Under</th>
                    <th>Created On</th>
                    <th>Last Update</th>
                    <th>Position</th>
                    <th>Account Status</th>
                    <th>Action</th>
                </thead>
                <tbody >
              
                @foreach($users as $users_info)
                <tr>
                    <td style="display:none">{{$users_info->id}}</td>
                    <td>{{$users_info->officer_id}}</td>
                    <td>{{$users_info->firstname}}</td>
                    <td>{{$users_info->lastname}}</td>
                    <td>{{$users_info->middlename}}</td>

                        @foreach($branch as $branch_info)
                            @if($users_info->branch_id != null)
                                @if($users_info->branch_id == $branch_info->branch_id)
                                    <td style="font-size: 15px;">{{$branch_info->branch_name}}</td>
                                @endif
                            @elseif($users_info->branch_id == null)
                             <td class="text-primary">Not Applicable</td>
                             @break
                            @endif
                        @endforeach

                        @foreach($branch_under as $branch_under_info)
                            @if($users_info->branch_under_id != null)
                                @if($users_info->branch_under_id == $branch_under_info->id)
                                    <td>{{$branch_under_info->branch_name}}</td>
                                @endif
                            @elseif($users_info->branch_under_id == null)
                            <td class="text-primary">Not Applicable</td>
                            @break
                            @endif
                        @endforeach
                    @if($users_info->created_at != null)
                        <td class="" style="font-size: 12px;">{{$users_info->created_at->toDayDateTimeString()}}</td>
                    @else
                        <td></td>
                    @endif

                    @if($users_info->updated_at != null)
                        @if($users_info->updated_at != $users_info->created_at)
                            <td class="text-primary" style="font-size: 12px;">{{$users_info->updated_at->diffForHumans(['parts' => 2])}}</td>
                        @else
                            <td></td>
                        @endif
                    @else
                        <td></td>
                    @endif

                    @foreach($position as $position_info)
                        @if($users_info->relation_id == $position_info->relation_id)
                            @foreach($position_description as $position_descript)
                                @if($position_info->position_id == $position_descript->id)
                                    @if($position_descript->position == 'admin')
                                        <td><span style="background-color: #013220; color:white; font-size:12px; padding:7px; border-radius:20px">Admin</span></td>
                                    @elseif($position_descript->position == 'personnel')
                                        <td><span style="background-color: #00bfff; color:white; padding:7px; font-size:12px; border-radius:20px">Personnel</span></td>
                                    @elseif($position_descript->position == 'finance')
                                        <td><span style="background-color: #ffff00; padding:7px; font-size:12px; border-radius:20px">Finance</span></td>
                                    @elseif($position_descript->position == 'branch')
                                        <td><span style="background-color: #f4a460; color:white; padding:7px; font-size:12px; border-radius:20px">Branch</span></td>
                                    @endif
                                @endif
                            @endforeach

                       <!-- @foreach($permission as $permission_info)
                            @if($permission_info->id == $position_info->permission_id)
                            <td>{{$permission_info->permission_description}}</td>
                            @endif
                        @endforeach-->
                        @endif
                    @endforeach
                    
                    @foreach($user_status as $status_info)
                        @if($users_info->relation_id == $status_info->id)
                        @if($status_info->scope == 'oic_officer')
                            @if($status_info->user_status_id == '1')
                                <td><span style="background-color: yellowgreen; padding:7px; font-size:12px; border-radius:20px">Enabled</span></td> 
                            @else
                                <td><span style="background-color: red; color:white; padding:7px; font-size:12px; border-radius:20px">Disabled</span></td>          
                            @endif
                        @else
                            <td></td>
                        @endif
                        @endif
                    @endforeach
                    @foreach($position as $position_descript)
                        @if($users_info->relation_id == $position_descript->relation_id)
                            @if($position_descript->position_id != '1')
                            <td><a type="button" href={{"/admin/user/management/update/officer/".$users_info->relation_id}} class="btn btn-primary update"><i class="fa fa-refresh" aria-hidden="true"></i></b></td>     
                            @else
                            <td><button type="button"  class="btn btn-primary disabled"><i class="fa fa-refresh" aria-hidden="true"></i></button></td>  
                            @endif
                        @endif
                    @endforeach
                </tr>
                @endforeach

              
                </tbody>    
            </table>
  
            </div>
    </div>
@endsection
@push('style')
    <style>
        #search, #branch, #listsearch, #branch_under, #offId, #firstname, #lastname, #middlename, #branch, #branch_under, #account_status{
            box-shadow: none;
        }
    </style>

    
@endpush
@push('script')

        <script>
           
            $(document).ready( function () {

                //data table
               dtable = $('#user_table').DataTable({
                    "language": {
                    "search": "Filter records:"
                    },
                    "className": "text-center nosort text-nowrap",
                   "lengthMenu": [5, 10, 20, 50],
                   "bLengthChange": true,
                   "columnDefs":[
                       {"className": "dt:center", "targets": "_all"}
                   ], 
                   "dom" :"lrtrip",
                   "order" :[[0, "asc"]],
                   
                  
                });

                //search function
                $('#search').keyup(function(){
                    dtable.search($(this).val()).draw();
                })
                
                } );


        </script>
@endpush