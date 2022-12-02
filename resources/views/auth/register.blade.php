
<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
     
      <script>  
      $(document).ready(function(){


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
                        console.log(data.length)
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

        //validating the user Id -- should be unique
        //$('#user_id').keyup(function(){
        // var variable = this.value
        //  $.ajax({
        //    type: 'get',
        //    url: '{!!URL::to("validateUserId")!!}',
        //    data: {'id':variable},
        //    success: function(data){
        //      //console.log("success")
        //      //console.log(data)
        //      if(data.length >= 1){
        //        $('#submit').attr('disabled', 'disabled')
        //       $('#CustomerIdError').show()
        //      }
        //      else{
        //        $('#CustomerIdError').hide()
        //        $('#submit').removeAttr('disabled')
        //      }
        //    },
        //    error: function(error){
        //      console.log("fails");
        //      console.log(JSON.stringify(error))
        //    }
        //  })
        //})

        //validating the retype user id
        $('#reuser_id').keyup(function(){
          var userID = $('#user_id').val()
          var reuserID =$('#reuser_id').val()
          if(userID != reuserID ){
            $('#submit').attr('disabled', 'disabled')
            $('#reCustomerIdError').show()
          }
          else{
            $('#reCustomerIdError').hide()
            $('#submit').removeAttr('disabled')
          }
        })

        //validating the email -- should be unique  
        $('#email').keyup(function(){
         var variable = this.value
          $.ajax({
            type: 'get',
            url: '{!!URL::to("validateUserEmail")!!}',
            data: {'id':variable},
            success: function(data){
              console.log("success")
              console.log(data)
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

        //validating password
        $('#password').keyup(function(){
          var password = this.value
         
          if(password.length < 8){
            $('#submit').attr('disabled', 'disabled')
            $('#passwordError').show()
          }
          else{
            $('#passwordError').hide()
            $('#submit').removeAttr('disabled')
          }
        })

        //validating retype password
        $('#password_confirmation').keyup(function(){
          var password = $('#password').val()
          var repassword = $('#password_confirmation').val()      
          if(password != repassword){
            $('#submit').attr('disabled', 'disabled')
            $('#repasswordError').show()
          }
          else{
            $('#repasswordError').hide()
            $('#submit').removeAttr('disabled')
          }
        })
    
        //manually inserting the ID
       var id = parseInt($('#get_id').val()) + 1
      $('#user_id').val(id) 

      //know if policy and terms is check
        $('#submit').attr('disabled', 'disabled')
        $('#terms').on('click', function(){
          if($(this).is(':checked')){
            $('#termsError').hide()
            $('#submit').removeAttr('disabled')
          }
          else{
            $('#termsError').show()
            $('#submit').attr('disabled', 'disabled')
          }
        })

      })

      //displaying signature image
      var loadFile = function(event) {
	   
      var image_signature = document.getElementById('signature')
      // Check if any file is selected.
      if (image_signature.files.length > 0) {
       
            for (const i = 0; i <= image_signature.files.length - 1; i++) {
  
                const fsize = image_signature.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 4096) {
                  $('#signature').val('')
                    $('#signatureError').show()
                    $('#submit').attr('disabled', 'disabled')
                   
                } 
                 else {
                  $('#signatureError').hide()
                  var image = document.getElementById('output');
	                image.src = URL.createObjectURL(event.target.files[0]);
                  $('#submit').removeAttr('disabled')
                }
            }
        }
      };

      //displaying ID image
       var loadFile_ID = function(event){
        
        var image_ID = document.getElementById('ID')
        // Check if any file is selected.
        if (image_ID.files.length > 0) {
    
              for (const i = 0; i <= image_ID.files.length - 1; i++) {
              
                  const fsize = image_ID.files.item(i).size;
                  const file = Math.round((fsize / 1024));
                  // The size of the file.
                  if (file >= 4096) {
                    $('#ID').val('')
                      $('#IDError').show()
                      $('#submit').attr('disabled', 'disabled')

                  } 
                   else {
                    $('#IDError').hide()
                    var image = document.getElementById('output_Id');
	                  image.src = URL.createObjectURL(event.target.files[0]);
                    $('#submit').removeAttr('disabled')
                  }
              }
          }
         }

       //displaying birth cert image
       var loadFile_Birth_Cert = function(event){
     
        var image_birth_cert = document.getElementById('birth_certificate')
        // Check if any file is selected.
        if (image_birth_cert.files.length > 0) {
    
              for (const i = 0; i <= image_birth_cert.files.length - 1; i++) {
              
                  const fsize = image_birth_cert.files.item(i).size;
                  const file = Math.round((fsize / 1024));
                  // The size of the file.
                  if (file >= 4096) {
                    $('#birth_certificate').val('')
                      $('#birthError').show()
                      $('#submit').attr('disabled', 'disabled')

                  } 
                   else {
                    $('#birthError').hide()
                    var image = document.getElementById('output_birth_cert');
	                  image.src = URL.createObjectURL(event.target.files[0]);
                    $('#submit').removeAttr('disabled')
                  }
              }
          }
       }
      
     </script>

   
</head>
<style>
    body{
        font-family: 'Poppins', 'san-serif';
        background-image: linear-gradient(to bottom right, #ffff4d,#fe783b);
        background-repeat: no-repeat; 
        background-attachment: fixed;
       
    }
    .center{
        margin-right: 100px;
        margin-left: 100px;
        text-align: center;
    }
    input{
        width: 300px;
        margin-left: 10px;
    }
    #youth_title{
      font-size: 30px;
    }
    .head-title{
      font-size: 20px;
    }
    form{
    margin-right: 100px;
    margin-left: 100px;
    margin-top: 20px;
    }
   .file_upload{
     color: white;
     border-radius: 5px;
     padding: 20px;
     cursor: pointer;
   }
    
</style>
<body>
       <div class="container-fluid pt-4">
        <center>
          <h5 id="youth_title"><b>Youth Savers Club Application</b></h5>
        </center>
        <x-jet-validation-errors class="mb-4" />
        <form
          action="{{ route('register') }}"
          method="POST"
          enctype="multipart/form-data"
        >
        @csrf
        
            <!--BODY-->
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <h5 class="head-title">Personal information</h5>
                    <hr class="mt-2">
                </div>
                <div class="col-md-4">
                  <x-jet-input 
                      id="firstname" 
                      name="firstname" 
                      :value="old('firstname')" 
                      required autofocus 
                      autocomplete="firstname" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="First name*"
                    />
                </div>
                <div class="col-md-4">
                  <x-jet-input
                      id="lastname" 
                      name="lastname" 
                      :value="old('lastname')" 
                      required autofocus 
                      autocomplete="lastname" 
                      class="form-control mb-3"
                      type="text"
                      placeholder="Last name*"
                    />
                </div>
                <div class="col-sm-3">
                  <x-jet-input
                      id="middlename" 
                      name="middlename" 
                      :value="old('middlename')" 
                      required autofocus 
                      autocomplete="middlename" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Middle name*"
                    />
                </div>
                <div class="col-sm-1">

                    <select
                    name="suffix"
                    id="suffix"
                    class="form-control mb-3 "
                   
                    >
                        <option value="">suffix</option>
                        <option value="Sr" @if(old('suffix')=="Sr"){{'selected'}} @endif>Sr</option>
                        <option value="Jr" @if(old('suffix')=="Jr"){{'selected'}} @endif>Jr</option>
                        <option value="II" @if(old('suffix')=="II"){{'selected'}} @endif>II</option>
                        <option value="III" @if(old('suffix')=="III"){{'selected'}} @endif>III</option>
                        <option value="IV" @if(old('suffix')=="IV"){{'selected'}} @endif>IV</option>
                        <option value="V" @if(old('suffix')=="V"){{'selected'}} @endif>V</option>
                        <option value="VI" @if(old('suffix')=="VI"){{'selected'}} @endif>VI</option>
                        <option value="VII" @if(old('suffix')=="VII"){{'selected'}} @endif>VII</option>
                        <option value="VIII" @if(old('suffix')=="VIII"){{'selected'}} @endif>VIII</option>
                    </select>
                </div>

                <div class="col-md-4">
                  <x-jet-input
                      id="date_of_birth" 
                      name="date_of_birth" 
                      :value="old('date_of_birth')" 
                      required autofocus 
                      autocomplete="date_of_birth" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Birthdate*"
                      onfocus="(this.type='date')"
                  />
                </div>
                <div class="col-md-4">
                  <select
                  name="gender"
                  id="gender"
                  class="form-control mb-3"
                  required
                >
                  <option value="">Gender*</option>
                  <option value="Male" @if(old('gender')=="Male"){{'selected'}} @endif>Male</option>
                  <option value="Female" @if(old('gender')=="Female"){{'selected'}} @endif>Female</option>
                </select>
                </div>
                <div class="col-md-4">
                    <x-jet-input
                      id="home_address" 
                      name="home_address" 
                      :value="old('home_address')" 
                      required autofocus 
                      autocomplete="home_address" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Home address*"
                    />
                </div>
                <div class="col-md-4">
                  <x-jet-input
                      id="contact_no" 
                      name="contact_no" 
                      :value="old('contact_no')" 
                      required autofocus 
                      autocomplete="contact_no" 
                      class="form-control mb-3"
                      onKeyPress="if(this.value.length==11) return false;"
                      type="number"      
                      placeholder="Contact number*"
                  />
                </div>
                <div class="col-md-4">
                  <h5 class="fs-13 ml-2">Branch*</h5>
                  <select
                    
                    name="branch_id"
                    id="branch_id"
                    class="form-control mb-3"

                    required
                    
                  >
                  <option value="" disabled="true" selected="true">--Select Branch--</option>
                  <?php use Illuminate\Support\Facades\DB;
                    
                    $id = DB::table('branchs')->pluck('branch_id','branch_name');
                    foreach ($id as $branch=>$id) {
                       echo "<option value=$id {{ old('branch_id')==$id? 'selected':''}}>$branch</option>"; }
                       ?>
                     <!-- echo "ID: ", $id;
                      echo " Name: ", $branch,"<br>";} -->
                </select>
                </div>
        
                <div class="col-md-4">
                  <h5 class="fs-13 ml-2">Branch Under* </h5>
                  <select
                    
                    name="branch_under_id"
                    id="branch_under_id"
                    class="form-control mb-3 branch_name"
                    required autofocus
                  >
                  <option value="" ></option>          
                </select>

                </div>
                <div class="col-sm-12 mb-3">
                  <h5 class="fs-15 fc-black head-title">Guardian Information</h5>
                  <hr class="mt-2">
                 </div>
                 <div class="col-md-4">
                    <x-jet-input
                      id="guardian_firstname" 
                      name="guardian_firstname" 
                      :value="old('guardian_firstname')" 
                      required autofocus 
                      autocomplete="guardian_firstname" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="First name*"

                />
                </div>
                <div class="col-md-4">
                  <x-jet-input
                      id="guardian_lastname" 
                      name="guardian_lastname" 
                      :value="old('guardian_lastname')" 
                      required autofocus 
                      autocomplete="guardian_lastname" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Last name*"
                  />
                </div>
                <div class="col-sm-3">
                  <x-jet-input
                      id="guardian_middlename" 
                      name="guardian_middlename" 
                      :value="old('guardian_middlename')" 
                      required autofocus 
                      autocomplete="guardian_middlename" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Middle name*"
                  />
                </div>
                <div class="col-sm-1">
                    <select
                    name="guardian_suffix"
                    id="guardian_suffix"
                    class="form-control mb-3 "
                    >
                        <option value="">suffix</option>
                        <option value="Sr">Sr</option>
                        <option value="Jr">Jr</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="VI">VI</option>
                        <option value="VII">VII</option>
                        <option value="VIII">VIII</option>
                    </select>
                </div>
            
                <div class="col-md-4">
                  <x-jet-input
                      id="guardian_date_of_birth" 
                      name="guardian_date_of_birth" 
                      :value="old('guardian_date_of_birth')" 
                      required autofocus 
                      autocomplete="guardian_date_of_birth" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Birthdate*"
                      onfocus="(this.type='date')"
                  />
                </div>
                <div class="col-md-4">
                  <select
                  name="guardian_gender"
                  id="guardian_gender"
                  class="form-control mb-3"
                 
                  required
                >
                  <option value="">Gender*</option>
                  <option value="Male" @if(old('guardian_gender')=="Male"){{'selected'}} @endif>Male</option>
                  <option value="Female" @if(old('guardian_gender')=="Female"){{'selected'}} @endif>Female</option>
                </select>
                </div>
                <div class="col-md-4">
                  <x-jet-input
                      id="guardian_home_address" 
                      name="guardian_home_address" 
                      :value="old('guardian_home_address')" 
                      required autofocus 
                      autocomplete="guardian_home_address" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Home Address*"       
                    />
                </div>
                <div class="col-md-4">
                  <x-jet-input
                      id="guardian_present_address" 
                      name="guardian_present_address" 
                      :value="old('guardian_present_address')" 
                      required autofocus 
                      autocomplete="guardian_present_address" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Present address*"
                    />
                </div>
                <div class="col-md-4">
                  <x-jet-input
                      id="guardian_contact_no" 
                      name="guardian_contact_no" 
                      :value="old('guardian_contact_no')" 
                      required autofocus 
                      autocomplete="guardian_contact_no" 
                      class="form-control mb-3"
                      onKeyPress="if(this.value.length==11) return false;"
                      type="number"      
                      placeholder="Contact number*"
                  />
                </div>
                <div class="col-md-4">
                  <x-jet-input
                      id="guardian_relationship_to_depositor" 
                      name="guardian_relationship_to_depositor" 
                      :value="old('guardian_relationship_to_depositor')" 
                      required autofocus 
                      autocomplete="guardian_relationship_to_depositor" 
                      class="form-control mb-3"
                      type="text"      
                      placeholder="Relation*"
                  />
                </div>
                <div class="col-sm-4">
                    <select
                    name="guardian_civil_status"
                    id="guardian_civil_status"
                    class="form-control mb-3 "
                    >
                        <option value="">Civil Status*</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        
                       
                    </select>
                </div>
                <div class="col-sm-4">
                    <select
                    name="guardian_oic_member"
                    id="guardian_oic_member"
                    class="form-control mb-3 "
                    >
                        <option value="">OIC member?*</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                        
                       
                    </select>
                </div>

                <div class="col-sm-12 mb-3 mt-3">
                    <h5 class="fs-15 fc-black head-title">Upload Documents</h5>
                    <hr class="mt-2">
                </div>
                <div class="col-md-4 mb-3">
                <h5 class="fs-13 ml-2">Signature* </h5>
                <p><img src="" id="output" width="500" alt=""></p>
                  <x-jet-input
                    id="signature"  
                    type="file" 
                    name="signature" 
                    :value="old('signature')" 
                    onchange="loadFile(event)"
                    required
                    accept=".png, .jpg, .jpeg"
                    class="form-control mt-2 mb-3 file_upload"
                  
                  />
                 <!-- <x-jet-label for="signature" id="file_upload">Upload Signature*</x-jet-label>-->
                  <x-jet-label>Please upload a *.png , *.jpg or *.jpeg image format, accepts least than 4mb</x-jet-label>
                  <span
                    style="color: red; font-size: 10px"
                    id="signatureError"
                    class="ml-2 hidden"
                    >Opps, image exceeds 4mb
                  </span>
                  

                </div>
                <div class="col-md-4 mb-3">
                <h5 class="fs-13 ml-2">Valid ID* </h5>
                  <p><img src="" id="output_Id" width="500" alt=""></p>
                  <x-jet-input
                      id="ID"  
                      type="file" 
                      name="Identification" 
                      accept=".png, .jpg, .jpeg"
                      required
                      onchange="loadFile_ID(event)"
                      class="form-control mt-2 mb-3 file_upload"
                    
                    />
                   <!-- <x-jet-label for="ID" id="file_upload" >Upload Valid ID*</x-jet-label>-->
                    <x-jet-label>Please upload a *.png , *.jpg or *.jpeg image format, accepts least than 4mb</x-jet-label>
                    <span
                    style="color: red; font-size: 10px"
                    id="IDError"
                    class="ml-2 hidden"
                    >Opps, image exceeds 4mb
                  </span>
                </div>
                <div class="col-md-4 mb-3">
                <h5 class="fs-13 ml-2">Birth Certificate* </h5>
                <p><img src="" id="output_birth_cert" width="500" alt=""></p>
                  <x-jet-input
                      id="birth_certificate"  
                      type="file" 
                      name="birth_certificate" 
                      :value="old('birth_certificate')" 
                      onchange="loadFile_Birth_Cert(event)"
                      accept=".png, .jpg, .jpeg"
                      required
                      class="form-control mt-2 mb-3 file_upload"
   
                    />
                  <!--  <x-jet-label for="birth_certificate" id="file_upload" >Upload Birth Certificate*</x-jet-label>-->
                    <x-jet-label>Please upload a *.png , *.jpg or *.jpeg image format, accepts least than 4mb</x-jet-label>
                    <span
                    style="color: red; font-size: 10px"
                    id="birthError"
                    class="ml-2 hidden"
                    >Opps, image exceeds 4mb
                  </span>
                </div>
                
                <div class="col-sm-12 mb-3 mt-2">
                  <h5 class="fs-15 fc-black head-title">Login credentials</h5>
                  <hr class="mt-2">
                 </div>
                 <div class="col-md-4 mb-3">
                  <x-jet-input
                    id="user_id"  
                    type="hidden" 
                    name="user_id" 
                    :value="old('user_id')" 
                    required
                    class="form-control"
                    placeholder="Customer Id*"
                  />
                  <?php       
                    $id = DB::table('users')->latest('created_at')->pluck('id')->first();
                      if($id != null){
                    
                        echo "<input type='hidden' id='get_id' value='$id'/>"; }
               
                      else{
                        echo "<input type='hidden' id='get_id' value='0'/>";
                      }
                       ?>
                     
                    <span
                    style="color: red; font-size: 10px; "
                    id="CustomerIdError"
                    class="ml-2 hidden"
                    >Customer ID already used!
                  </span>
                 </div>
                 <div class="col-md-4 mb-3">
                  <x-jet-input
                    id="reuser_id"  
                    type="hidden" 
                    name="reuser_id" 
                    :value="old('reuser_id')" 
                    required
                    class="form-control"
                    placeholder="Retype Customer Id*"
                  />
                    <span
                    style="color: red; font-size: 10px"
                    id="reCustomerIdError"
                    class="ml-2 hidden"
                    >Whoops, these don't match!
                  </span>
                 </div>

                 <div class="col-md-4"><!--SPACE--></div>

                 <div class="col-md-4 mb-3">
                  <x-jet-input
                    id="email"  
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required
                    class="form-control signup-input2"
                    placeholder="Email Address*"
                  />
                    <span
                    style="color: red; font-size: 10px"
                    id="emailError"
                    class="ml-2 hidden"
                    >Email address already used!
                  </span>
                 </div>
                 <div class="col-md-4 mb-3">
                  <x-jet-input
                    id="reemail"  
                    type="reemail" 
                    name="reemail" 
                    :value="old('email')" 
                    required
                    class="form-control signup-input2"
                    placeholder="Retype Email Address"
                  />
                  <span
                    style="color: red; font-size: 10px"
                    id="reemailError"
                    class="ml-2 hidden"
                    >Whoops, these don't match!
                  </span>
                 </div>
                 <div class="col-md-4"><!--SPACE--></div>
                 <div class="col-md-4 mb-3">
                    <x-jet-input
                    id="password"  
                    name="password" 
                    autocomplete="new-password"          
                    type="password" 
                    required 
                    class="form-control "                
                    placeholder="Password"
                  />
                  <span
                    style="color: red; font-size: 10px"
                    id="passwordError"
                    class="ml-2 hidden"
                    >Password should be atleast 8 characters
                  </span>
                 </div>
                 <div class="col-md-4 mb-3">
                    <x-jet-input
                    id="password_confirmation"  
                    name="password_confirmation" 
                    autocomplete="new-password"          
                    type="password" 
                    required 
                    class="form-control "                
                    placeholder="Retype Password"
                  />
                  <span
                    style="color: red; font-size: 10px"
                    id="repasswordError"
                    class="ml-2 hidden"
                    >Whoops, these don't match
                  </span>
                 </div>
                 <div class="col-md-4"><!--SPACE--></div>
                 <div class="col-md-4">
                 <input type="hidden" name="scope" id="scope" value="depositor">
                 <input type="hidden" name="user_status_id" id="user_status_id" value="1">
                 <input type="hidden"name="status_id"  value="1"  id="status_id"/>
                  <input type="hidden" value="1" name="level_id" id="level_id"/>
                  @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4 mb-3">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required autofocus/>
                          <div class="row">
                          
                        
                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="/terms" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="/policy" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                            <span
                              style="color: red; font-size: 10px"
                              id="termsError"
                              class="ml-2 hidden"
                              >Please check the terms and policy
                            </span>
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
                
                  <x-jet-button id="submit" type="submit" class="mb-5">{{ __('Register') }}</x-jet-button>
                  <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                  </a>
                 </div>
            </div>
            </form>
          @include('officer.admin.includes.footer')
      </div>
 
       <!--bootstrap bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     
     <!--Popper and Bootstrap JS --> 
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     <script>
      $(document).ready(function(){

      })
     </script>
   
   

</body>
</html>


<!--none-->
  <x-guest-layout>
        
    <x-jet-authentication-card>
      
       <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            
            <div>
                <x-jet-label for="firstname" value="{{ __('FirstName') }}" />
                <x-jet-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
