$(document).on('click','#btn-add',function(e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/category_save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#addEmployeeModal').modal('hide');
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
$(document).on('click','.update',function(e) {
    var id=$(this).attr("data-id");
    var name=$(this).attr("data-name");
    $('#id_u').val(id);
    $('#name_u').val(name);

});

$(document).on('click','#update',function(e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "backend/category_save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#editEmployeeModal').modal('hide');
                    location.reload();
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
$(document).on("click", ".delete", function() {
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
});
$(document).on("click", "#delete", function() {
    $.ajax({
        url: "backend/category_save.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#id_d").val()
        },
        success: function(dataResult){
                $('#deleteEmployeeModal').modal('hide');
                location.reload();
        }
    });
});
// status
$(document).on('click','.status_checks',function(){
    var status = ($(this).hasClass("btn-success")) ? '0' : '1';
    var msg = (status=='0')? 'Deactivate' : 'Activate';
    // if(confirm("Are you sure to "+ msg)){
      var current_element = $(this);
      url = "backend/category_save.php";
      $.ajax({
        type:"POST",
        url: url,
        data: {id:$(current_element).attr('data'),status:status},
        success: function(data)
        {   
          location.reload();
        }
      });
    // }      
  });


//   Product
$(document).ready(function(){
    $('#add_button').click(function(){
        $('#product_form')[0].reset();
        $('.modal-title').text("Add User");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#user_uploaded_image').html('');
    });

    $(document).on('submit', '#product_form', function(event){
        event.preventDefault();
        var name = $('#name').val();
        var cat_id = $('#cat_id').val();
        var extension = $('#image').val().split('.').pop().toLowerCase();
        if(extension != '')
        {
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
            {
                alert("Invalid Image File");
                $('#image').val('');
                return false;
            }
        }   
        if(name != '' && cat_id != '')
        {
            $.ajax({
                url:"backend/product_save.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    alert(data);
                    // $('#product_form')[0].reset();
                    // $('#userModal').modal('hide');
                    // dataTable.ajax.reload();
                }
            });
        }
        else
        {
            alert("Both Fields are Required");
        }
    });
});

