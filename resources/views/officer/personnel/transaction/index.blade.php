@extends('officer.personnel.layouts.index')
@section('content')
    <div class="py-12 mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Transactions</h3>
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
        <table class="table stripe align-middle hover" id="transaction_table">
            <thead>
              
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Signature</th>
                <th>Valid ID</th>
                <th>Birth Certificate</th>
                <th>Date Uploaded</th>
                <th>Validate</th>
            </thead>
            <tbody>
                @foreach($transaction as $transaction_info)
                    @if($transaction_info->level_id == '1' && $transaction_info->status_id == '1')
                        <tr>
                            @foreach($depositor as $depositor_info)
                                @if($transaction_info->depositor_id == $depositor_info->depositor_id)
                                   
                                    <td>{{$depositor_info->firstname}}</td>
                                    <td>{{$depositor_info->lastname}}</td>
                                @endif
                            @endforeach

                            @foreach($uploaded_document as $document_info)
                                @if($transaction_info->depositor_id == $document_info->depositor_id)
                                    <td>
                                        <a href="{{ asset('/uploads/Signature/' .$document_info->Signature)}}" target="new">
                                            <img src="{{ asset('/uploads/Signature/' .$document_info->Signature)}}" width="80px" alt="Image" >
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('/uploads/Identification/' .$document_info->Identification) }}" target="new">
                                            <img src="{{ asset('/uploads/Identification/' .$document_info->Identification) }}" width="80px" alt="Image">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('/uploads/BirthCert/'.$document_info->birth_certificate) }}" target="new">
                                            <img src="{{ asset('/uploads/BirthCert/'.$document_info->birth_certificate) }}" width="80px" alt="Image">
                                        </a>
                                    </td>
                                    <td>{{$document_info->created_at->toDayDateTimeString()}}</td>
                                @endif
                            @endforeach
                                    <td><a href="#" 
                                        class="btn btn-primary approved" 
                                        data-bs-toggle="modal" 
                                        data-id="{{$transaction_info->id}}" 
                                        data-bs-target="#approve_transaction"
                                        ><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> 
                                    <a href="#" 
                                        class="btn btn-danger disapproved" 
                                        data-bs-toggle="modal" 
                                        data-id="{{$transaction_info->id}}" 
                                        data-bs-target="#denied_transaction"
                                        ><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                                    </td>
                        </tr>  
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <div class="modal fade" id="approve_transaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Approve Transaction</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form  action="/approved/application" method="POST" enctype="multipart/form-data">
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
    <div class="modal fade" id="denied_transaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Denied Transaction</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form  action="/denied/application" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="id_denied" name="id">
                    @foreach($officer as $officer_info)
                        <input type="hidden" name="officer_id" value="{{$officer_info->officer_id}}">
                    @endforeach
                    @foreach($transaction as $transaction_info)
                        <input type="hidden" name="depositor_id" value="{{$transaction_info->depositor_id}}">
                    @endforeach
                    <div class="form-group green-border-focus">
                        <label for="denied">Remarks <span>(note: This is required)</span><span class="text-danger">*</span></label>
                        <textarea 
                            class="form-control" 
                            name="remarks" 
                            id="denied" 
                            rows="3"
                            required></textarea>
                    </div>
                 </div>
                 <div class="modal-footer">
                     <button data-bs-dismiss="modal" type="button" class="btn btn-secondary">Close</button>
                     <button type="submit" class="btn btn-danger" id="submit"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
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
               "order" :[[6, "asc"]],
             
           
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

            //get the id of the transaction after approved button clicked
            $(document).on('click', '.disapproved', function(){
                var id = $(this).data('id');
                $('#id_denied').val(id)
            })
            });
    </script>
@endpush