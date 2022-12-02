@extends('officer.admin.layouts.dashboard')
@section('content')
    <div class="py-12 mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded p-5" style="text-align: center;">
            <h1>Welcome Admin</h1>
            </div>
        </div>
        
        
        
    </div>
    <div class="container mt-5 pt-2">
    <div class="row">
        <div class="col-md-9">
            <h1 style="font-size: 25px;">TOTAL MEMBERS STAT REPORT PER BRANCH</h1>
        </div>
        <div class="col-md-3">
            <a href="/admin/user/report" class="btn btn-primary">Go To Report page</a>
        </div>
        
       
    </div>
  
        <div class="row">
            <div class="col-md-2 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 15px;">
                <label style="font-size: 15px;">CDO BRANCH : </label>
                <label class="text-primary" style="font-weight:1000">{{$cdo}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 15px;">
                <label style="font-size: 15px;">MISAMIS ORIENTAL BRANCH : </label>
                <label class="text-primary" style="font-weight:1000">{{$misor}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 15px;">
                <label style="font-size: 15px;">BUKIDNON BRANCH : </label>
                <label class="text-primary" style="font-weight:1000">{{$buk}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 15px;">
                <label style="font-size: 15px;">CARAGA BRANCH : </label>
                <label class="text-primary" style="font-weight:1000">{{$car}} depositors</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow rounded px-3 py-4" style="margin-right: 15px;">
                <label style="font-size: 15px;">BOHOL BRANCH : </label>
                <label class="text-primary" style="font-weight:1000">{{$bohol}} depositors</label>
            </div>
            
          
        </div>
    </div>
@endsection