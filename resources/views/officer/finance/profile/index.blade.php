@extends('officer.finance.layouts.index')
@section('content')
<div class="mt-5">
        <h3>Profile</h3>
        <div class="row">
            <div class="col-md-3 mt-3">
                <div class="bg-white shadow rounded p-5">
                    @foreach($position as $position_info)
                        @foreach($position_descrip as $position_des)
                            @if($position_info->position_id == $position_des->id)
                                <h2 class="text-success">{{$position_des->position}}</h2>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="col-md-8">
                <div class="bg-white shadow rounded p-5">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><h2 class="text-primary">Basic Information</h2></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                @foreach($officer as $officer_info)
                                    <td>{{$officer_info->firstname}} {{$officer_info->middlename}}. {{$officer_info->lastname}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Position</td>
                                @foreach($position as $position_info)
                                    @foreach($position_descrip as $position_des)
                                        @if($position_info->position_id == $position_des->id)
                                            <td>{{$position_des->position}}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <td>ID</td>
                                @foreach($officer as $officer_info)
                                    <td>{{$officer_info->officer_id}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Branch</td>
                                    @foreach($officer as $officer_info)
                                        @if($officer_info->branch_id != null)
                                            @foreach($branch as $branch_info)
                                                @if($officer_info->branch_id == $branch_info->branch_id)
                                                    <td>{{$branch_info->branch_name}}</td>
                                                @endif
                                            @endforeach
                                        @else
                                            <td>Not Applicable</td>
                                        @endif
                                    @endforeach
                            </tr>
                            <tr>
                                <td>Branch Under</td>
                                    @foreach($officer as $officer_info)
                                        @if($officer_info->branch_under_id != null)
                                            @foreach($branch_under as $branch_under_info)
                                                @if($officer_info->branch_under_id == $branch_under_info->id)
                                                    <td>{{$branch_under_info->branch_name}}</td>
                                                @endif
                                            @endforeach
                                        @else
                                            <td>Not Applicable</td>
                                        @endif
                                    @endforeach
                            </tr>
                            <tr>
                                <td>Date Started Service</td>
                                    @foreach($officer as $officer_info)
                                        <td>{{$officer_info->created_at->toDayDateTimeString()}}</td>
                                    @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection