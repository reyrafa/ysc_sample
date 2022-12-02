@extends('officer.finance.layouts.index')
@section('content')
    <div class="mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>RECIEPTS</h3>
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
            <table class="table stripe hover align-middle" id="transaction_table">
                <thead>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Middlename</th>
                    <th>Receipt</th>
                    <th>Date Uploaded</th>
                </thead>
                <tbody>
                    @foreach($transaction as $transaction_info)
                        @if($transaction_info->level_id == '2')
                            <tr>
                                @foreach($depositor as $depositor_info)
                                    @if($transaction_info->depositor_id == $depositor_info->depositor_id)
                                        <td>{{$depositor_info->firstname}}</td>
                                        <td>{{$depositor_info->lastname}}</td>
                                        <td>{{$depositor_info->middlename}}</td>
                                    @endif
                                @endforeach
                                <td>
                                    <a href="{{ asset('/uploads/Receipt/'.$transaction_info->uploaded_receipt) }}" target="new">
                                        <img src="{{ asset('/uploads/Receipt/'.$transaction_info->uploaded_receipt) }}" width="80px" alt="Image">
                                    </a>
                                </td>
                                <td>{{$transaction_info->created_at->toDayDateTimeString()}}</td>
                            </tr>
                        @endif
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
                transaction_table = $('#transaction_table').DataTable({
                   "language": {
                   "search": "Filter records:",
                   "emptyTable": "There is no application for this day"
                   },
                   "className": "text-center nosort text-nowrap",
                  "lengthMenu": [4, 10, 20, 50],
                  "bLengthChange": true,
                  "columnDefs":[
                      {"className": "dt:center", "targets": "_all"}
                  ], 
                  "dom" :"lrtrip",
                  "order" :[[0, "asc"]],
               
              
                });
    
                //search function
                $('#search').keyup(function(){
                   transaction_table.search($(this).val()).draw();
                })

                
         })
    </script>
@endpush