<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            UPDATE INFORMATION
        </h2>
    </x-slot> 
    <div class="container-fluid pt-2" style="font-family: 'Poppins', san-serif;">
        <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
        <x-jet-label style="font-size: 15px;" class="mt-3 ml-3 mb-3">
            <b>Instruction:</b> Input with <span class="text-danger">*</span> is required
        </x-jet-label>
		@foreach($data as $depositor)
        <form action="/update_personal_information" method="POST">
        @csrf
            <div class="row"> 
                <div class="col-sm-12 mb-2"> 
                    <h1 style="font-size:25px"><b>Edit Personal Information</b></h1>
                    <hr class="mt-2">
                </div>
                <input type="hidden" name="id" value="{{$depositor->id}}">
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Firstname <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        placeholder="Enter Firstname"
                        required
                        value="{{$depositor->firstname}}"
                        name="firstname"
                        autocomplete="firstname"
                        class="form-control mb-3 "
                    />
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Lastname <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        placeholder="Enter Lastname"
                        name="lastname"
						value="{{$depositor->lastname}}"
                        autocomplete="lastname"
                        required 
                        class="form-control mb-3 "
                    />
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Middlename <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        placeholder="Enter Middlename"
                        name="middlename"
                        value="{{$depositor->middlename}}"
                        required
                        class="form-control mb-3 "
                    />
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Suffix </x-jet-label>
                    <select
                    name="suffix"
                    id="suffix"
                    class="form-control mb-3 "
                    >
                        <option value="">suffix</option>
                        <option value="Sr" @if('Sr'==old('suffix',$depositor->suffix)) selected="selected" @endif>Sr</option>
                        <option value="Jr" @if('Jr'==old('suffix',$depositor->suffix)) selected="selected" @endif>Jr</option>
                        <option value="II" @if('II'==old('suffix',$depositor->suffix)) selected="selected" @endif>II</option>
                        <option value="III" @if('III'==old('suffix',$depositor->suffix)) selected="selected" @endif>III</option>
                        <option value="IV" @if('IV'==old('suffix',$depositor->suffix)) selected="selected" @endif>IV</option>
                        <option value="V" @if('V'==old('suffix',$depositor->suffix)) selected="selected" @endif>V</option>
                        <option value="VI" @if('VI'==old('suffix',$depositor->suffix)) selected="selected" @endif>VI</option>
                        <option value="VII" @if('VII'==old('suffix',$depositor->suffix)) selected="selected" @endif>VII</option>
                        <option value="VIII" @if('VIII'==old('suffix',$depositor->suffix)) selected="selected" @endif>VIII</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Birthdate <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="date_of_birth"
                        placeholder="Birthdate"
                        onfocus="this(type='date')"
                        value="{{$depositor->date_of_birth}}"
                        class="form-control mb-3"
                        required
                    />
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Gender <span class="text-danger">*</span></x-jet-label>
                        <select
                        name="gender"
                        id="gender"
                        class="form-control mb-3"
                        required
                        >
                            <option value="">Gender</option>
                            <option value="Male" @if('Male'==old('gender',$depositor->gender)) selected="selected" @endif>Male</option>
                            <option value="Female" @if('Female'==old('gender',$depositor->gender)) selected="selected" @endif>Female</option>
                        </select>
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Home Address <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        name="home_address" 
                        value="{{$depositor->home_address}}" 
                        required 
                        autocomplete="home_address" 
                        class="form-control mb-3"
                        type="text"      
                        placeholder="Home address"
                    />
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Contact Number <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                      name="contact_no" 
                      value="{{$depositor->contact_no}}" 
                      required
                      autocomplete="contact_no" 
                      class="form-control mb-3"
                      onKeyPress="if(this.value.length==11) return false;"
                      type="number"      
                      placeholder="Contact number*"
                  />
                </div>
                <div class="col-md-3 Branch_get">
                    <x-jet-label class="ml-2">Branch <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="branch_id"
                        id="branch_id"
                        class="form-control mb-3"
                        required
                      >
                      <option value="" disabled="true" selected="true">Select Branch</option>
                      @foreach($branch as $branch_info)
                        
                            <option value="{{$branch_info->branch_id}}"
                           @if($branch_info->branch_id == old('branch_id',$depositor->branch_id))
                           selected="selected"
                           @endif
                            >{{$branch_info->branch_name}}</option>
                 
                      @endforeach  
                    </select>
                </div>
                <input type="text" class="hidden" id="under_branch" value="{{$depositor->branch_under_id}}">
                <div class="col-md-3 id_100">
                    <x-jet-label class="ml-2">Branch Under <span class="text-danger">*</span></x-jet-label>
                    <select    
                        name="branch_under_id"
                        id="branch_under_id"
                        class="form-control mb-3 branch_name"
                        required
                      >
                      <option value="" ></option>          
                    </select>
                </div>
                <!--space-->
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                @foreach($guardian as $guardian_info)
                <div class="col-md-12 mt-2">
                    <h1 style="font-size:25px"><b>Guardian</b></h1>
                    <hr class="mt-2 mb-2">
                </div>
                <div class="col-md-3">
                    <x-jet-label class="ml-2">Firstname<span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                          name="guardian_firstname" 
                          value="{{$guardian_info->guardian_firstname}}"
                          required 
                          autocomplete="guardian_firstname" 
                          class="form-control mb-3"
                          type="text"      
                          placeholder="Firstname"
                    />
                </div>
                <div class="col-md-3">
					<x-jet-label class="ml-2">Lastname<span class="text-danger">*</span></x-jet-label>
					<x-jet-input
                      id="guardian_lastname" 
                      name="guardian_lastname" 
                      value="{{$guardian_info->guardian_lastname}}"
                      required 
                      autocomplete="guardian_lastname" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Lastname"
                  />
                </div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">Middlename<span class="text-danger">*</span></x-jet-label>
					<x-jet-input
                      id="guardian_middlename" 
                      name="guardian_middlename" 
                      value="{{$guardian_info->guardian_middlename}}"
                      required 
                      autocomplete="guardian_middlename" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Middlename"
                  />
				</div>
				<div class="col-md-3">
                    <x-jet-label class="ml-2">Suffix </x-jet-label>
                    <select
                    name="guardian_suffix"
                    id="guardian_suffix"
                    class="form-control mb-3 "
                    >
                        <option value="">suffix</option>
                        <option value="Sr"  @if('Sr'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>Sr</option>
                        <option value="Jr" @if('Jr'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>Jr</option>
                        <option value="II" @if('II'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>II</option>
                        <option value="III" @if('III'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>III</option>
                        <option value="IV" @if('IV'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>IV</option>
                        <option value="V" @if('V'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>V</option>
                        <option value="VI" @if('VI'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>VI</option>
                        <option value="VII" @if('VII'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>VII</option>
                        <option value="VIII" @if('VIII'==old('guardian_suffix',$guardian_info->guardian_suffix)) selected="selected" @endif>VIII</option>
                    </select>
                </div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">BirthDate<span class="text-danger">*</span></x-jet-label>
					<x-jet-input
                      id="guardian_date_of_birth" 
                      name="guardian_date_of_birth" 
                      value="{{$guardian_info->guardian_date_of_birth}}"
                      required 
                      autocomplete="guardian_date_of_birth" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Birthdate*"
                      onfocus="(this.type='date')"
                  />
				</div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">Gender<span class="text-danger">*</span></x-jet-label>
					<select
                  		name="guardian_gender"
                  		id="guardian_gender"
                  		class="form-control mb-3"
                 		required
                		>
                  		<option value="">Gender*</option>
                  		<option value="Male" @if('Male'==old('guardian_gender',$guardian_info->guardian_gender)) selected="selected" @endif>Male</option>
                  		<option value="Female" @if('Female'==old('guardian_gender',$guardian_info->guardian_gender)) selected="selected" @endif>Female</option>
                	</select>
				</div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">Home Address<span class="text-danger">*</span></x-jet-label>
					<x-jet-input
                      id="guardian_home_address" 
                      name="guardian_home_address" 
                      value="{{$guardian_info->guardian_home_address}}"
                      required 
                      autocomplete="guardian_home_address" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Home Address*"       
                    />
				</div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">Home Address<span class="text-danger">*</span></x-jet-label>
					<x-jet-input
                	      id="guardian_present_address" 
                	      name="guardian_present_address" 
                          value="{{$guardian_info->guardian_present_address}}"
                	      required
                	      autocomplete="guardian_present_address" 
                	      class="form-control mb-3"
                	      type="text"      
                	      placeholder="Present address*"
                	    />
				</div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">Contact No<span class="text-danger">*</span></x-jet-label>
					<x-jet-input
                	      id="guardian_contact_no" 
                	      name="guardian_contact_no" 
                          value="{{$guardian_info->guardian_contact_no}}"
                	      required 
                	      autocomplete="guardian_contact_no" 
                	      class="form-control mb-3"
                	      onKeyPress="if(this.value.length==11) return false;"
                	      type="number"      
                	      placeholder="Contact number*"
                	  />
				</div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">Relationship<span class="text-danger">*</span></x-jet-label>
					<x-jet-input
                      	id="guardian_relationship_to_depositor" 
                      	name="guardian_relationship_to_depositor" 
                      	value="{{$guardian_info->guardian_relationship_to_depositor}}"
                      	required 
                      	autocomplete="guardian_relationship_to_depositor" 
                      	class="form-control mb-3"
                      	type="text"      
                      	placeholder="Relation*"
                  />
				</div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">Civil Status<span class="text-danger">*</span></x-jet-label>
					<select
                    name="guardian_civil_status"
                    id="guardian_civil_status"
                    class="form-control mb-3 "
                    >
                        <option value="">Civil Status</option>
                        <option value="Single" @if('Single'==old('guardian_civil_status',$guardian_info->guardian_civil_status)) selected="selected" @endif>Single</option>
                        <option value="Married" @if('Married'==old('guardian_civil_status',$guardian_info->guardian_civil_status)) selected="selected" @endif>Married</option>
                    </select>
				</div>
				<div class="col-md-3">
					<x-jet-label class="ml-2">OIC member?<span class="text-danger">*</span></x-jet-label>
					<select
                	    name="guardian_oic_member"
                	    id="guardian_oic_member"
                	    class="form-control mb-3 "
                	    >
                	        <option value="">OIC member?</option>
                	        <option value="Yes" @if('Yes'==old('guardian_oic_member',$guardian_info->guardian_oic_member)) selected="selected" @endif>Yes</option>
                	        <option value="No" @if('No'==old('guardian_oic_member',$guardian_info->guardian_oic_member)) selected="selected" @endif>No</option>  
                    </select>
				</div>
                @endforeach
                <div class="col-md-3">
                    <x-jet-button type="submit">Update</x-jet-button>
                </div>
            </div>

        </form>
		@endforeach
        </div>
        </div>
    </div>
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
</x-app-layout>