@extends('officer.admin.layouts.dashboard')
@section('content')
    <div class="mt-5">
        <form method="POST" action="/admin/user/management/add/oic/user">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h3 class="" style="text-align: center;">ADD OIC OFFICER</h3>
                    <p style="font-size:15px">Instruction : Input with <span class="text-danger">*</span> is required</p>
                </div>
                <div class="col-md-12">
                    <h4>Personal Information</h4>
                    <hr>
                </div>
                <div class="col-md-3 mb-2"> 
                    <label for="">Company ID <span class="text-danger">*</span></label>  
                    <input 
                        type="number" 
                        name="officer_id" 
                        id="oicId"
                        class="form-control"
                        required autofocus 
                        />
                        <span
                            style="color: red; font-size: 10px; display:none"
                            id="oicIdError"
                            class="ml-2"
                        >Opps, This Id is already taken
                        </span>
                </div>
                <div class="col-md-3 mb-2"> 
                    <label for="">First Name <span class="text-danger">*</span></label>  
                    <input 
                        type="text" 
                        id="fname"
                        name="firstname" 
                        class="form-control"
                        required autofocus 
                        />
                </div>
                <div class="col-md-3 mb-2"> 
                    <label for="">Last Name <span class="text-danger">*</span></label>  
                    <input 
                        type="text" 
                        name="lastname" 
                        id="lname"
                        class="form-control"
                        required autofocus 
                        />
                </div>
                <div class="col-md-3 mb-2"> 
                    <label for="">Middle Name <span class="text-danger">*</span></label>  
                    <input 
                        type="text" 
                        name="middlename" 
                        id="mname"
                        class="form-control"
                        required autofocus 
                        />
                </div>
                <div class="col-md-3 mb-2 brancher" style="display: none;">
                    <label for="">Branch <span class="text-danger">*</span></label>
                    <select 
                        name="branch_id" 
                        id="branch"
                        class="form-control form-select"
                         autofocus>
                        <option value="" disabled="true" selected="true">--Select Branch--</option>
                        <?php use Illuminate\Support\Facades\DB;
                            $id = DB::table('branchs')->pluck('branch_id', 'branch_name');
                            foreach($id as $branch=>$id){
                                echo "<option value=$id {{ old('branch_id')==$id? 'selected':''}}>$branch</option>"; 
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 mb-2 brancher" style="display: none;">
                    <label for="">Branch Under <span class="text-danger">*</span></label>
                    <select 
                        name="branch_under_id" 
                        id="branch_under" 
                        class="form-control form-select"
                         autofocus>
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-12 mt-4">
                    <h4>Position</h4>
                    <hr>
                </div>
                <input type="hidden" value="1" name="org_id">
                <div class="col-md-3 mb-2">
                    <label for="">Position <span class="text-danger">*</span></label>
                    <select 
                        name="position_id" 
                        id="position"
                        class="form-control form-select"
                        required autofocus>
                        <option value="" disabled="true" selected="true">--Select Position--</option>
                        <?php 
                           $position = DB::table('position_descriptions')->pluck('id', 'position');
                           foreach($position as $position_id=>$position){
                               echo "<option value=$position {{old(position_id) == $position? 'selected' : ''}}>$position_id</option>";
                           }
                        ?>
                    </select>
                </div>
                <div class="col-md-3"></div>
                <input type="hidden" id="user_id" name="user_id">
                <?php       
                    $id = DB::table('users')->latest('created_at')->pluck('id')->first();
                      if($id != null){
                    
                        echo "<input type='hidden' id='get_id' value='$id'/>"; }
               
                      else{
                        echo "<input type='hidden' id='get_id' value='0'/>";
                      }
                       ?>
                <div class="col-md-12 mt-4">
                    <h4>Login Credential</h4>
                    <hr>
                </div>
                <div class="col-md-3 mb-2"> 
                    <label for="">Email Address <span class="text-danger">*</span></label>  
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="form-control"
                        required autofocus 
                        />
                        <span
                            style="color: red; font-size: 10px; display:none"
                            id="emailError"
                            class="ml-2"
                        >Opps, This email is already taken
                        </span>
                </div>
                <div class="col-md-3 mb-2"> 
                    <label for="">Retype Email Address <span class="text-danger">*</span></label>  
                    <input 
                        type="reemail" 
                        name="reemail" 
                        id="reemail"
                        class="form-control"
                        required autofocus 
                        />
                        <span
                            style="color: red; font-size: 10px; display:none"
                            id="reemailError"
                            class="ml-2"
                        >Opps, This doesn't match
                        </span>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3 mb-2"> 
                    <label for="">Password <span class="text-danger">*</span></label>  
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-control"
                        required autofocus 
                        />
                        <span
                            style="color: red; font-size: 10px; display:none"
                            id="passwordError"
                            class="ml-2"
                        >Please add atleast 8 character password
                        </span>
                </div>
                <div class="col-md-3 mb-2"> 
                    <label for="">Retype Password <span class="text-danger">*</span></label>  
                    <input 
                        type="password" 
                        name="repassword" 
                        id="repassword"
                        class="form-control"
                        required autofocus 
                        />
                        <span
                            style="color: red; font-size: 10px; display:none"
                            id="repasswordError"
                            class="ml-2"
                        >Opps, This doesn't match
                        </span>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3 mt-2">
                    <button type="submit" id="submit" class="btn btn-primary form-control">Add Officer</button>
                </div>
            </div>
        </form>
    </div>
    @push('style')
        <style>
            #fname, #lname, #oicId, #branch, #mname, #branch_under, #org, #position, #permission, #email, #reemail, #password, #repassword{
                box-shadow: none;
            }
        </style>
    @endpush
    @push('script')
        <script>
            $(document).ready(function(){
                //getting the branch under to select
                $('#branch').on("change", function(){
                    var id = this.value
                    var op = " "
                    var div = $(this).parent().parent()
                    $.ajax({
                        type: 'get',
                        url: '{!!URL::to("findBranchUnder")!!}',
                        data: {'id': id},
                        success: function(data){
                                op+='<option value="0" selected disabled>--Branch Under--</option>'
                                for(var i=0;i<data.length;i++){
                                    op+='<option value ="'+data[i].id+'">' + data[i].
                                    branch_name+'</option>'
                                }
                                    div.find('#branch_under').html(" ")

                                    div.find('#branch_under').append(op)

                        },
                        error: function(error){
                            console.log("fails")
                            console.log(JSON.stringify(error))
                        }

                    })
                })

                //validating the Id Number 
                $('#oicId').keyup(function(){
                    var variable = this.value
                    $.ajax({
                        type: 'get',
                        url: '{!!URL::to("validate_officer_id")!!}',
                        data: {'id':variable},
                        success: function(data){
                          if(data.length >= 1){
                            $('#submit').attr('disabled', 'disabled')
                           $('#oicIdError').show()
                          }
                          else{
                            $('#oicIdError').hide()
                            $('#submit').removeAttr('disabled')
                          }
                        },
                        error: function(error){
                          console.log("fails");
                          console.log(JSON.stringify(error))
                        }
                                })
                })

                //validating the email address
                $('#email').keyup(function(){
                    var id = this.value
                    console.log(id)
                     $.ajax({
                       type: 'get',
                       url: '{!!URL::to("validateUserEmail")!!}',
                       data: {'id':id},
                       success: function(data){
                         console.log(data);
                         if(data.length >= 1){
                           $('#submit').attr('disabled', 'disabled')
                          $('#emailError').show()
                         }
                         else{
                           $('#emailError').hide()
                           $('#submit').removeAttr('disabled')
                         }
                       },
                       error: function(error){
                         console.log("fails");
                         console.log(JSON.stringify(error))
                       }
                     })
                    })

                    //validating the retype email
                    $('#reemail').keyup(function(){
                      var userEmail = $('#email').val()
                      var reuserEmail =$('#reemail').val()
                      if(userEmail != reuserEmail ){
                        $('#submit').attr('disabled', 'disabled')
                        $('#reemailError').show()
                      }
                      else{
                        $('#reemailError').hide()
                        $('#submit').removeAttr('disabled')
                      }
                    })

                    //validating the password
                    $('#password').keyup(function(){
                        var password = $('#password').val()
                        if(password.length <= 8){
                            $('#passwordError').show()
                            $('#submit').attr('disabled' , 'disabled')
                        }
                        else{
                            $('#passwordError').hide()
                            $('#submit').removeAttr('disabled')
                        }
                    })

                    //validating the the repassword must be equal to password
                    $('#repassword').keyup(function(){
                        var password = $('#password').val()
                        var repassword = $('#repassword').val()
                        if(repassword != password){
                            $('#repasswordError').show()
                            $('#submit').attr('disabled', 'disabled')

                        }
                        else{
                            $('#repasswordError').hide()
                            $('#submit').removeAttr('disabled')
                        }
                    })

                    //manually inserting the ID
                        var id = parseInt($('#get_id').val()) + 1
                        $('#user_id').val(id) 
                        if($('#user_id').val() == null){
                            $('#submit').attr('disabled' , 'disabled')
                        }
                        else{
                            $('#submit').removeAttr('disabled')
                        }

                        //show or hide branch on change of position
                        $('#position').on('change', function(){
                            position = this.value
                            if(position == 4){
                                $('.brancher').css('display', 'block')
                            }
                            else{
                                $('.brancher').css('display', 'none')
                            }
                           
                        })
        })
        </script>
    @endpush
@endsection