@extends('officer.admin.layouts.dashboard')
@section('content')
    <div class="mt-5 ">
       <h1> Update Officer</h1>
    </div>
    <form  action="/admin/user/management/update/officer/oic/officer" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        @foreach($officer as $officer_info)
        <div class="col-md-4">
            <input type="hidden" name="id" value="{{$officer_info->id}}">
            <input type="hidden" name="relation_id" value="{{$officer_info->relation_id}}">
            <label for="">Officer Id <span class="text-danger">*</span></label>
            <input 
                type="number"
                id="offId"
                name="officer_id"
                value="{{$officer_info->officer_id}}"
                class="form-control mb-2"
                required 
            />
        </div>
        <div class="col-md-4">
            <label for="">Firstname <span class="text-danger">*</span></label>
            <input 
                type="text"
                name="firstname"
                id="firstname"
                value="{{$officer_info->firstname}}"
                class="form-control mb-2"
                required
            />
        </div>
        <div class="col-md-4">
            <label for="">Lastname <span class="text-danger">*</span></label>
            <input 
                type="text"
                name="lastname"
                id="lastname"
                value="{{$officer_info->lastname}}"
                class="form-control mb-2"
                required
            />
        </div>
        <div class="col-md-4">
            <label for="">Middlename <span class="text-danger">*</span></label>
            <input 
                type="text"
                name="middlename"
                id="middlename"
                value="{{$officer_info->middlename}}"
                class="form-control mb-2"
                required
            />
        </div>
        <div class="col-md-4">
        <label for="">Position <span class="text-danger">*</span></label>

        <select
            name="position_id"
            id="position"
            class="form-control form-select mb-3"
            required
            >
            <option value="" disabled="true" selected="true">--Select Position--</option>
             @foreach($position as $position_info)
                        @foreach($position_descript as $pos_info)
                        <option value="{{$pos_info->id}}"
                       @if($pos_info->id == old('position_id',$position_info->position_id))
                       selected="selected"
                       @endif
                        >{{$pos_info->position}}</option>
                        @endforeach
             
                  @endforeach 
            </select>
        
        </div>
        @if($officer_info->branch_id != null && $officer_info->branch_under_id != null)
        <div class="col-md-4">
            <label for="">Branch <span class="text-danger">*</span></label>
            <select 
                name="branch_id" 
                id="branch_id"
                class="form-control mb-3 form-select"
                required>
                <option value="" disabled="true" selected="true">--Select Branch--</option>
                @foreach($branch as $branch_info)       
                    <option value="{{$branch_info->branch_id}}"
                        @if($branch_info->branch_id == old('branch_id',$officer_info->branch_id))
                        selected="selected"
                        @endif
                         >{{$branch_info->branch_name}}</option>
                @endforeach  
            </select>
        </div>
       <div class="col-md-4 id_100">
            <input type="hidden" id="under_branch" value="{{$officer_info->branch_under_id}}">
            <label for="">Branch Under <span class="text-danger">*</span></label>
            <select 
                name="branch_under_id" 
                id="branch_under_id"
                class="form-control mb-3 form-select branch_name"
                required>
                <option value="" disabled="true" selected="true">--Select Branch Under--</option>
            </select>
       </div>
       @else
       <div class="col-md-4"></div>
       
       @endif
    
       <div class="col-md-4">
           @foreach($user_login as $user_info)
            <label for="">Account Status <span class="text-danger">*</span></label>
            <select 
                name="account_status" 
                id="account_status"
                class="form-control mb-3 form-select"
                required>
                <option value="" disabled="true" selected="true">--Select Status--</option>
                <option value="1" @if('1'==old('account_status',$user_info->user_status_id)) selected="selected" @endif>Enabled</option>
                <option value="2" @if('2'==old('account_status',$user_info->user_status_id)) selected="selected" @endif>Disabled</option>
            </select>
            @endforeach
       </div>
       <div class="col-md-4"></div>
       <div class="col-md-4"></div>
       <div class="col-md-3">
            <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i> Update Officer</button>   
       </div>
    @endforeach
    </div>
    </form>
      
@endsection
@push('style')
    <style>
        #search, #branch_id, #branch_under_id, #listsearch, #branch_under, #offId, #firstname, #lastname, #middlename, #branch, #branch_under, #account_status{
            box-shadow: none;
        }
    </style>

    
@endpush
@push('script')
        <script>
            $(document).ready(function(){
                  //getting the current branch under
                  var branch = $('#branch_id').val()
                var op = " "
                var div = $('#branch_id').parent().parent()
                var under_branch = $('#under_branch').val()
            
                $.ajax({
                    type: 'get',
                    url: '{!!URL::to("findBranchUnder")!!}',
                    data : {'id':branch},
                    success:function(data){
                        
                            op+='<option value="0" selected disabled>--Branch Under--</option>'
                                for(var i=0;i<data.length;i++){
                                  op+='<option value ="'+data[i].id+'">' + data[i].
                                  branch_name+'</option>'
                                  
                                }
                         
                                div.find('.branch_name').html(" ")
                            
                            div.find('.branch_name').append(op)
                            
                            $('div.id_100 select').val(under_branch).trigger("change")
                        },
                    error :function(error){
                        console.log("fails")
                        console.log(JSON.stringify(error))
                  }
                  
                })
                //getting value of branch when selected
                $('#branch_id').on('change', function(){
                    var id =this.value
                    var op = " "
                    var div = $(this).parent().parent()
                    
                   
                    $.ajax({
                        type: 'get',
                        url: '{!!URL::to("findBranchUnder")!!}',
                        data : {'id':id},
                        success:function(data){
                            
                                op+='<option value="0" selected disabled>--Branch Under--</option>'
                                    for(var i=0;i<data.length;i++){
                                      op+='<option value ="'+data[i].id+'">' + data[i].
                                      branch_name+'</option>'
                                    }
                                div.find('.branch_name').html(" ")
                                
                                div.find('.branch_name').append(op)
                            },
                        error :function(error){
                            console.log("fails")
                            console.log(JSON.stringify(error))
                      }
                      
                    })
                })
            })
        </script>
@endpush