
<script type="text/javascript">//This script use for error massage validation on modal
   jQuery('.alert-danger').hide();
    jQuery('.alert-success').hide();
    jQuery('.alert-warning').hide();
    $('#err').hide();
    $(".modal-body form").submit(function(e) {
    e.preventDefault(); // stop the standard form submission
    $.ajax({
        url: this.action,
        type: this.method,
        data: $(this).serialize(),
        success: function(data) {
            if(data.success){
                $('#successMessage').html('<span>'+data.success+'</span>');
                $('input[type=text]').val("");
                $('#success').delay(1000).show().fadeOut('slow');
                jQuery('.alert-danger').hide();
            }else if(data.errors){
                jQuery('.alert-danger').html('');
                jQuery.each(data.errors, function(key, value){
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').append('<li style="list-style-type:none;">'+value+'</li>');
                });
            } else {
                jQuery('.alert-danger').hide();
                $('#open').hide();
                $('#myModal').modal('hide');
               // window.location.reload();
            }
        }
    });
});
</script>




{{--Error Form Style--}}
<style>
    .error{
        color:red;
    }
</style>
{{--Js script--}}
<script>
//    $.validator.setDefaults({
//        submitHandler: function() {
//            alert("submitted!");
//        }
//    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();
        // validate signup form on keyup and submit
        $(".checkValidation").validate({
            rules: {
                //permission
                name:"required",
                guard_name:"required",
                //financial year
                financial_year_name:"required",
                start_date:"required",
                end_date:"required",
                //Budget
                financial_year_id:"required",
                soe_type_id:"required",
                budget_type_id:"required",
                adp_amount:"digits",
                revised_amount:"digits",
                //Fiac
                farmer_name:"required",
                mobile_no:"required",
                fiac_date:"required",
                crops_id:"required",
                area_of_land:"required",
               // problem:"required",
               // solution:"required",
               // solution_by:"required",
                //email template
                email_type_id:"required",
                email_subject:"required",
                //email_body:"required",
                //lender fund
                lander_id:"required",
                installment_id:"required",
                fund_receive_dt:"required",
                amount:{
                    required:true,
                    digits:true
                },
                //CIG
                village:"required",
                cig_name:"required",
                region_id:"required",
                district_id:"required",
                union_id:"required",
                cig_type:"required",
                //technology unit cost
                unit_cost:"required",
                upazilla_type:"required",
                activity_type:"required",
//                Ecode Technology
                economic_code_id:"required",
                technology_id:"required",
                //users
                username:"required",
                email:"required",
                //cig grading
                latter_grade:"required",
                marks_from:"required",
                marks_to:"required",
                //cost center type
                cost_center_type_name:"required",
//                Cost Center
                cost_center_name:"required",
                cost_center_type:"required",
//                Economic Code
                pr_economic_code_id : "required",
                economic_code : "required",
                economic_code_desc : "required",
//                Technologies
                technology_desc_en : "required",
                    //Lookup Group
                group_name: "required",
                user_define_sl: "required",
                //Lookup Group Data
                group_data_name: "required",
                group_data_abbr: "required",
                user_define_id: "required",
                //union
                upazilla_id: "required",
                union_name: "required",
                //crops
                crops_varietie_id: "required",
                crops_name:{
                    required:true,

                },
                //crops varietie
                varietie_name: "required",
                //crops problem
                problem_title: "required",
                //banks
                bank_name: "required",
                //bank branch
                branch_id: "required",
                bank_id: "required",
                account_no:"required",
                bank_branch_name: "required",
                branch_email: "required",
                branch_phone: "required",
                org_name: "required",
                org_address: "required",
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email_address: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true
//                    number: true,
//                    minlength: 11,
//                    maxlength: 11,
                },
                website: {
                    required:true,
                    url:true
                },
                fax: "required",
                active_status: "required"
            },
            messages: {
                //permission
                name:"This field is required",
                guard_name:"This field is required",
                //financial year
                financial_year_name:"This field is required",
                start_date:"This field is required",
                end_date:"This field is required",
                //Budget
                financial_year_id:"This field is required",
                soe_type_id:"This field is required",
                budget_type_id:"This field is required",
                adp_amount:"This field is required digit",
                revised_amount:"This field is required digit",
                //Fiaac
                farmer_name:"This field is required",
                mobile_no:"This field is required",
                fiac_date:"This field is required",
                crops_id:"This field is required",
                area_of_land:"This field is required",
//                problem:"This field is required",
//                solution:"This field is required",
//                solution_by:"This field is required",
                //email template
                email_type_id:"This field is required",
                email_subject:"This field is required",
               // email_body:"This field is required",
                //leander fund
                lander_id:"This field is required",
                installment_id:"This field is required",
                fund_receive_dt:"This field is required",
                amount:{
                    required:"This field is required",
                    digits:"This field is required digits"
                },
                //CIG
                village:"This field is required",
                cig_name:"This field is required",
                region_id:"This field is required",
                district_id:"This field is required",
                union_id:"This field is required",
                cig_type:"This field is required",
                //Technology Unit Cost
                unit_cost:"This field is required",
                upazilla_type:"This field is required",
                activity_type:"This field is required",
//                Ecode Technology
                economic_code_id:"This field is required",
                technology_id:"This field is required",
                //users
                username:"This field is required",
                email:"This field is required",
                //cig grading
                latter_grade:"This field is required",
                marks_from:"This field is required",
                marks_to:"This field is required",
                //cost center type
                cost_center_type_name:"This field is required",
//                Cost Center
                cost_center_name:"Please Enter Name",
                cost_center_type:"Please Enter Type",
//                Economic Code
                pr_economic_code_id : "This field is required",
                economic_code : "This field is required",
                economic_code_desc : "This field is required",
//                Technologies
                technology_desc_en : "This field is required",
                //Lookup Group
                group_name: "This field is required",
                user_define_sl: "This field is required",
                //Lookup Group Data
                group_data_name: "This field is required",
                group_data_abbr: "This field is required",
                user_define_id: "This field is required",
                //union
                upazilla_id: "This field is required",
                union_name: "This field is required",
                //crops
                crops_varietie_id: "This field is required",
                crops_name:{
                    required:"This field is required",
                    unique:"This Name is already Exists"
                },
                //crops varietie
                varietie_name: "This field is required",
                //crops problem

                problem_title: "Please enter crops problem title",
                //bank
                bank_name: "This field is required",
                //bank branch
                branch_id: "This field is required",
                bank_id: "This field is required",
                account_no: "This field is required",
                bank_branch_name: "This field is required",
                branch_email: "This field is required",
                branch_phone: "This field is required",
                org_name: "Please enter name",
                org_address: "Please enter address",

                problem_title: "This field is required",
                org_name: "This field is required",
                org_address: "This field is required",

                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email_address: {
                    required : "This field is required",
                    email : "Please enter valid email"
                },
                phone: {
                    required: "This field is required",
                    minlength: 'Please 11 digit number',
                    maxlength: 'Please 11 digit number',
                    number: 'Please valid Phone Number'
                },
                website: {
                    required: "This field is required",
                    url:'Please enter valid url'
                },
                fax: "This field is required",
                active_status: "This field is required",
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if (firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });
</script>
