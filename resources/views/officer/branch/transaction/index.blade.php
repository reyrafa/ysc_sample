@extends('officer.branch.layouts.index')

@section('content')
    <div class="mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Transaction List</h3>
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
        <h3>Transaction</h3>
        <div class="bg-white mt-3 overflow-hidden shadow rounded px-3 py-4">
        <div class="table-responsive">
            <table class="table stripe hover align-middle" id="transaction_table">
                <thead>
                    <th>No</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Middlename</th>
                    <th>Branch</th>
                    <th>Branch Under</th>
                    <th>Validate</th>
                </thead>
                <tbody>
                    @foreach($transaction as $transaction_info)
                        @if($transaction_info->level_id == '3' && $transaction_info->status_id == '1')
                        <tr>
                            <td><button class="btn btn-primary disabled"><i class="fa fa-cogs" aria-hidden="true"></i></button></td>
                            @foreach($depositor as $depositor_info)
                                @if($depositor_info->depositor_id == $transaction_info->depositor_id)
                                    <td>{{$depositor_info->firstname}}</td>
                                    <td>{{$depositor_info->lastname}}</td>
                                    <td>{{$depositor_info->middlename}}</td>
                                    @foreach($branch as $branch_info)
                                        @if($depositor_info->branch_id == $branch_info->branch_id)
                                            <td>{{$branch_info->branch_name}}</td>
                                        @endif
                                    @endforeach
                                    @foreach($branch_under as $branch_under_info)
                                        @if($depositor_info->branch_under_id == $branch_under_info->id)
                                        <td>{{$branch_under_info->branch_name}}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <td><a href="#" 
                                    class="btn btn-primary approved" 
                                    data-bs-toggle="modal" 
                                    data-id="{{$transaction_info->id}}" 
                                    data-bs-target="#approve_transaction"
                                    ><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> 
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="modal fade" id="approve_transaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Approve Transaction</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form  action="/branch/user/approve/application" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    @foreach($officer as $officer_info)
                        <input type="hidden" name="officer_id" value="{{$officer_info->officer_id}}">
                    @endforeach
                    @foreach($transaction as $transaction_info)
                        <input type="hidden" name="depositor_id" value="{{$transaction_info->depositor_id}}">
                    @endforeach
                    <div class="form-group green-border-focus">
                        <label for="exampleFormControlTextarea4">Remarks <span>(note: This is optional)</span></label>
                        <textarea class="form-control" name="remarks" id="exampleFormControlTextarea4" rows="3"></textarea>
                    </div>
                 </div>
                 <div class="modal-footer">
                     <button data-bs-dismiss="modal" type="button" class="btn btn-secondary">Close</button>
                     <button type="submit" class="btn btn-primary" id="submit"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                 </div>

                 </form>
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
                  "bLengthChange":false,
              
                });
    
                //search function
                $('#search').keyup(function(){
                   transaction_table.search($(this).val()).draw();
                })

                //get the id of the transaction after approved button clicked
                $(document).on('click', '.approved', function(){
                    var id = $(this).data('id');
                    $('#id').val(id)
                })

                
         })
    </script>
@endpush