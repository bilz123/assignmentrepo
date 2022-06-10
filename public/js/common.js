function mainAjaxCall(elem) {

    var host = window.location.host;
    var form_data = new FormData();
    //get image 
    var selected_file = document.querySelector('#upload_file');  
    if(selected_file)
    {
    var file = selected_file.files[0];
    form_data.append('file', document.querySelector('#upload_file').files[0]);
}

  //DB value     
  var value1 = $('#value1').val();
  var value2 = $('#value2').val();
  var value3 = $('#value3').val();
  var value4 = $('#value4').val();
  
  var url = $(elem).attr("data-url");
  
  var type = $(elem).attr("data-type");
  
  var action_for = $(elem).attr("data-action");
  form_data.append('name', value1);
  form_data.append('description', value2);
  form_data.append('sale_price', value3);
  form_data.append('purchase_price', value4);
  
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      'Content-Type': undefined 
    }
  });
  $.ajax({
    
    type: type,
    url: url,
    processData: false,
    contentType: false,
   //  data: { 'name' : value1, 'description' : value2 },
    data : form_data,
    
    success:function(data) {
        
        if(action_for == "ADD_CAT")
        {
           alert(data.message);
           $('#data-table').DataTable().ajax.reload();
           $('#category_modal').modal('hide');
           
        }
    
        if(action_for == "EDIT_CAT")
        {

        $('#btn_div').html('');
        var html = "";
        html += "<div class='form-group'>";
        html += "<label for='exampleInputEmail1'>Category Name</label>";
        html += "<input type='text' class='form-control' id='value1'  placeholder='Enter Category' value='"+data.data.name+"'>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<label for='exampleInputPassword1'>Description</label>" ;
        html += "<input type='text' class='form-control' id='value2' placeholder='Description' value='"+data.data.description+"'>" ;
        html += "</div>";
        html += "<div class='col-md-6'>";
        html += "<input type='file' id='upload_file' accept='image/jpeg, image/png'/>";
        html += "</div>";
        html += "</tr>";
    
        $('#heading').text("Edit Category")
        $('#modal-content').html(html);
    
        var update = 'http://'+host+'/categories/'+data.data.id;
        var html1 = "";
        html1 += "<div class='modal-footer' id='btn_div'>";
        html1 += "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
        html1 += "<button type='button' onclick ='mainAjaxCall(this)'  data-url='" + update +"'   data-type='put' data-action='UPDATE_CAT' data-for='category' class='btn btn-primary'>Save changes</button>";
        $('#btn_div').html(html1);
    
        $('#category_modal').modal('show');
        }

        if(action_for == "UPDATE")
        {
            
            alert(data.message);
        }
        
        if(action_for == "VIEW")
        {
          
          var html = "";
          html += "<div col-md-12>";
          html += "<div col-md-6>";
          html += "<span><b>Name :</b>";
          html += ""+data.data.name+"</span>";
          html += "</div>";
          html += "<div col-md-6>";
          html += "<span><b>Description :</b>";
          html += ""+data.data.description+"</span>";
          html += "</div>";
          if(data.data.image != null)
          {
          html += "<div col-md-6>";
          html += "<span><b>Image :</b>";
          html += "<img src='"+'/storage/'+data.data.image+"' />";
          html += "</div>";
          }
          html += "</div>";
          $('#heading').text("View Category")
          $('#modal-content').html(html);
          $('#category_modal').modal('show');
        }
    
        if(action_for == "DELETE")
        {
          $('#data-table').DataTable().ajax.reload();
            alert(data.message);
          
                
        }

        //product add-edit-view-delete
        if(action_for == "ADD_PRODUCT")
        {
           alert('data.message');
           $('#product-table').DataTable().ajax.reload();
           $('#product_modal').modal('hide');
           
        }

        if(action_for == "EDIT_PRODUCT")
        {
          var html = "";
        var url = window.location.href;
        var html = "";
        html += "<div class='form-group'>";
        html += "<label> Name</label>";
        html += "<input type='text' class='form-control' id='value1'  placeholder='Enter Product' value='"+data.data.name+"'>";
        html += "</div>";
        html += "<label >Sale Price</label>" ;
        html += "<input type='text' class='form-control' id='value3' placeholder='Sale Price' value='"+data.data.sale_price+"'>" ;
        html += "</div>";
        html += "<label>Purchase Price</label>" ;
        html += "<input type='text' class='form-control' id='value4' placeholder='Purchase Price' value='"+data.data.purchase_price+"'>" ;
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<label>Description</label>" ;
        html += "<input type='text' class='form-control' id='value2' placeholder='Description' value='"+data.data.description+"'>" ;
        html += "</div>";
        html += "<div class='col-md-6'>";
        html += "<input type='file' id='upload_file' accept='image/jpeg, image/png'/>";
        html += "</div>";

        var update =  'http://'+host+'/products/'+data.data.id;

        var html1 = "";
        html1 += "<div class='modal-footer' id='btn_div'>";
        html1 += "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
        html1 += "<button type='button' onclick ='mainAjaxCall(this)'  data-url='" + update +"'   data-type='PATCH' data-action='UPDATE_PRODUCT'  class='btn btn-primary'>Save changes</button>";
        $('#submitbtn').html(html1);

        $('#p_heading').text("Edit Product")

        $('#p_modal-content').html(html);
        $('#product_modal').modal('show');
    
        }

        if(action_for == "VIEW_PRODUCT")
        {
          
          var html = "";
          html += "<div col-md-12>";
          html += "<div col-md-6>";
          html += "<span><b>Name :</b>";
          html += ""+data.data.name+"</span>";
          html += "</div>";
          html += "<div col-md-6>";
          html += "<span><b>Sale Price :</b>";
          html += ""+data.data.sale_price+"</span>";
          html += "</div>";
          html += "<div col-md-6>";
          html += "<span><b>Purchase Price :</b>";
          html += ""+data.data.purchase_price+"</span>";
          html += "</div>";
          html += "<div col-md-6>";
          html += "<span><b>Description :</b>";
          html += ""+data.data.description+"</span>";
          html += "</div>";
          if(data.data.image != null)
          {
          html += "<div col-md-6>";
          html += "<span><b>Image :</b>";
          html += "<img src='"+'/storage/'+data.data.image+"' />";
          html += "</div>";
          }

          html += "</div>";
          $('#p_heading').text("View Product")
          $('#p_modal-content').html(html);
          $('#product_modal').modal('show');
        }
        if(action_for == "DELETE_PRODUCT")
        {
          $('#product-table').DataTable().ajax.reload();
            alert(data.message);
          
                
        }
     },error: function (request, status, error) {
      
      if( request.status === 422 ) {
        var errors = $.parseJSON(request.responseText);
        
        $('#nameError').text(errors.errors.name[0]).css("color", "red");;
        $('#desError').text(errors.errors.description[0]).css("color", "red");;
        
   }
      
  } 
   
});
    
    }
