
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })

    function addUpdate(event){
        event.preventDefault();
        var formData=$('#addUpdateForm').serialize();
        $.ajax({
            type:'POST',
            url:"/add-update-employee",
            data:formData,
            success:function(res){
                if(res.status===200){
                    $('#addEmployeeModal').modal('hide');
                    location.reload();
                }
                if(res.status===400)
                {
                    printErrorMsg(res.errors);
                }
            },
        });
    }

    $("body #editEmployee").click(function(){
        let employeeId=$(this).attr("data-id");
        $.ajax({
            type:"get",
            url:"edit-employee/"+employeeId,
            success:function(res){
                if(res.status===200){
                    $("#employeeId").val(res.data.id);
                    $("#firstname").val(res.data.firstname);
                    $("#lastname").val(res.data.lastname);
                    $("#email").val(res.data.email);
                    $("#phone").val(res.data.phone);
                    $("#password").removeAttr("required");
                }
                else{
                    alert("data not found");
                }
            }
        });
    });

    $("body #deleteEmployee").click(function(){
        let employeeId=$(this).attr("data-id");
        if(confirm('Are you sure want to delete !')){
            $.ajax({
                type:"DELETE",
                url:"delete-employee/"+employeeId,
                success:function(res){
                    $("#table_row_"+employeeId).remove();
                }
            });
        };
    });

    function printErrorMsg(errors){
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( errors, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

    function clearData(){
        $("#employeeId").val(null);
        $("#firstname").val(null);
        $("#lastname").val(null);
        $("#email").val(null);
        $("#phone").val(null);
        $("#password").attr("required");
    }