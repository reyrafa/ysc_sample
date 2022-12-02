@extends('officer.admin.layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size: 25px;">MEMBERS STATISTICS REPORT</h1>
        </div>
      
        
       
    </div>
  
        <div class="row">
            <div class="col-md-2 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 45px; margin-left:10px">
                <label style="font-size: 15px;">TOTAL MEMBER : DAY</label>
                <label class="text-primary" style="font-weight:1000">{{$counter_day}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 40px;">
                <label style="font-size: 15px;">TOTAL MEMBER : WEEK</label>
                <label class="text-primary" style="font-weight:1000">{{$counter_week}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 40px;">
                <label style="font-size: 15px;">TOTAL MEMBER : MONTH</label>
                <label class="text-primary" style="font-weight:1000">{{$counter_month}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 40px;">
                <label style="font-size: 15px;">TOTAL MEMBER : YEAR</label>
                <label class="text-primary" style="font-weight:1000">{{$counter_year}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4">
                <label style="font-size: 15px;">TOTAL MEMBER : ALLTIME</label>
                <label class="text-primary" style="font-weight:1000">{{$counter_alltime}} depositors</label>
            </div>
            
          
        </div>
        <div class="row " style="display: none;">
            <div class="bg-white overflow-hidden shadow rounded px-3 py-4 col-md-7" style="margin-left: 5px;" style="display: none;">
                  
            </div>
        </div>
       

        <div class="row mt-5">

            <div class="col-md-2">
                <button class="btn btn-info"  onclick="toPdf()" >Export to Pdf</button>
            </div>

            <div class="col-md-2">
                <button class="btn btn-info" onclick="fnExportToExcel('xlsx', 'MembersReport')">Export to Excel</button>
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-4" style="align-content:flex-end">
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
                            placeholder="Search Member"/>

                        </div>
                        <button type="button" class="btn btn-success disabled">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>  
                </form>
            </div>
        </div>
        
        <div class="mt-2 bg-white overflow-hidden shadow rounded px-3 py-4">
        <div class="table-responsive">
                <table class="table hover align:middle stripe" id="dl_report_Table">
                    <thead>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Middlename</th>
                        <th>Branch </th>
                        <th>Branch Under</th>
                        <th>Date Officially Member</th>
                        <th>Age</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($official_member as $official_info)
                            @if($official_info->isAlumni == "1")
                            <tr>
                                @foreach($depositor as $depositor_info)
                                    @if($official_info->depositor_id == $depositor_info->depositor_id)
                                   
                                        <td>{{$depositor_info->firstname}}</td>
                                        <td>{{$depositor_info->lastname}}</td>
                                        <td>{{$depositor_info->middlename}}</td>
                                      
                                        
                                        @foreach($branch as $branch_info)
                                            @if($branch_info->branch_id == $depositor_info->branch_id)
                                                <td>{{$branch_info->branch_name}}</td>
                                            @endif
                                        @endforeach

                                        @foreach($branch_under as $branch_under_info)
                                            @if($branch_under_info->id == $depositor_info->branch_under_id)
                                                <td>{{$branch_under_info->branch_name}}</td>
                                            @endif
                                        @endforeach
                                       
                                        <td>{{$official_info->created_at->toDayDateTimeString()}}</td>
                                        @if(\Carbon\Carbon::parse($depositor_info->date_of_birth)->age > 18)
                                            <td class="text-danger">{{\Carbon\Carbon::parse($depositor_info->date_of_birth)->age}} years old</td>
                                            <td><a href="#" 
                                                class="btn btn-primary approved" 
                                                data-bs-toggle="modal" 
                                                data-id="{{$official_info->id}}" 
                                                data-bs-target="#alumnus"
                                                >Admit</a></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($depositor_info->date_of_birth)->age}} years old</td>
                                            <td><button href="#" class="btn btn-primary" disabled>Admit</button></td>
                                        @endif

                                    @endif
                               
                                @endforeach
                                </tr>
                            @endif

                        @endforeach 
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <div class="modal fade" id="alumnus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Graduate Youth Saver Member</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form action="/alumni/admit" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="id" name="id">
            
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
@push('script')

        <script>
           
            $(document).ready( function () {


                 //get the id of the transaction after approved button clicked
                 $(document).on('click', '.approved', function(){
                    var id = $(this).data('id');
                    $('#id').val(id)
                })




                //data table
               member = $('#dl_report_Table').DataTable({
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
                   "order" :[[2, "asc"]],
                  
                  
                });

                //search function
                $('#search').keyup(function(){
                    member.search($(this).val()).draw();
                })
                
                });


                function toPdf(){
                    var doc = new jsPDF('p', 'pt', 'letter');
                    var htmlstring = '';
                    var tempVarToCheckPageHeight = 0;
                    var pageHeight = 0;
                    pageHeight = doc.internal.pageSize.height;
                    specialElementHandlers = {
                        // element with id of "bypass" - jQuery style selector  
                        '#bypassme': function (element, renderer) {
                            // true = "handled elsewhere, bypass text extraction"  
                            return true
                        }
                    };
                    margins = {
                        top: 150,
                        bottom: 60,
                        left: 40,
                        right: 40,
                        width: 600
                    };
                    var y = 20;
                    doc.setLineWidth(2);
                    doc.text(200, y = y + 30, "Members REPORT");
                    doc.autoTable({
                        html: '#dl_report_Table',
                        startY: 70,
                        theme: 'grid',
                        
                        styles: {
                            minCellHeight: 40
                        }
                    })
                    doc.save('MembersReport.pdf');
                };
                
                function fnExportToExcel(fileExtension, filename){
                    var elt = document.getElementById('dl_report_Table');
                    var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"})
                    return XLSX.writeFile(wb, filename + "." + fileExtension || ('MembersReport.' + (fileExtension || 'xlsx')));
                }

        </script>
@endpush
