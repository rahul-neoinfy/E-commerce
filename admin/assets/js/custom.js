
$(document).ready(function(){

    $('.delete_product_btn').click(function(e){
        e.preventDefault();

        var id=$(this).val();
        alert(id);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover   this product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
             $.ajax({
                method: 'POST',
                url: 'code.php',
                data: {
                    
                    'product_id':id,
                    'delete_product_btn':true
                },
                success: function(response){
                    if(response==200){
                        swal("Product deleted!", "Your product has been deleted!", "success");
                         
                    }
                    else if(response==500){
                        swal("Error!", "Something went wrong!", "error");
                    }
                   
                    location.reload();
                    },
             })
            } else {
              swal("Your imaginary file is safe!");
            }
          });
    })

});