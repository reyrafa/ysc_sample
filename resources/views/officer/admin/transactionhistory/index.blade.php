@extends('officer.admin.layouts.dashboard')
@section('content')
    <div class="py-12 mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Transaction History</h3>
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <div class="input-group">   
                    <div class="form-outline">
                        <input 
                            type="search" 
                            id="search" 
                            class="form-control" 
                            placeholder="Search Transaction"/>
                    </div>
                    <button type="button" class="btn btn-success disabled">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-white mt-3 overflow-hidden shadow rounded px-3 py-4">
        <div class="table-responsive">
            <table class="table align-middle stripe hover" id="transaction_history">
                <thead>
  
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Middlename</th>
                    <th>Validated By</th>
                    <th>Status</th>
                    <th>Level</th>
                    <th>Date Of Transaction</th>
                </thead>
                <tbody>
                    @foreach($history_of_transaction as $transaction_info)
                    <tr>
                        
                        @foreach($depositor as $depositor_info)
                            @if($transaction_info->depositor_id == $depositor_info->depositor_id)
                            <td>{{$depositor_info->firstname}}</td>
                            <td>{{$depositor_info->lastname}}</td>
                            <td>{{$depositor_info->middlename}}</td>
                            @endif
                        @endforeach
                            <td>{{$transaction_info->officer_id}}</td>

                            @foreach($status_of_transaction as $status_info)
                                @if($status_info->status_of_transaction_id == $transaction_info->status_id)
                                    <td>{{$status_info->status_of_transaction_name}}</td>
                                @endif
                            @endforeach

                            @foreach($level_of_transaction as $level_info)
                                @if($transaction_info->level_id == $level_info->level_of_transaction_id)
                                    <td>{{$level_info->level_description}}</td>
                                @endif
                            @endforeach
                            <td>{{$transaction_info->created_at->toDayDateTimeString()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    
@endsection
@push('style')
    <style>
        #search{
            box-shadow: none;
        }
    </style>
@endpush
@push('script')

        <script>
           
            $(document).ready( function () {

                //data table
               historytable = $('#transaction_history').DataTable({
                    "language": {
                    "search": "Filter records:"
                    },
                    "className": "text-center nosort text-nowrap",
                   "lengthMenu": [4, 10, 20, 50],
                   "bLengthChange": true,
                   "columnDefs":[
                       {"className": "dt:center", "targets": "_all"}
                   ], 
                   "dom" :"lrtrip",
                   "order" :[[6, "asc"]],
                  
                  
                });

                //search function
                $('#search').keyup(function(){
                    historytable.search($(this).val()).draw();
                })
                
                });


        </script>
@endpush