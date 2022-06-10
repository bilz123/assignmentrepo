function modalOpenFun(elem)
{
    var value = $(elem).attr("data-val");
    //var url ="{{ config('config.url') }}";
    var url = window.location.href;
    var host = window.location.host;
    
    var html = "";
   
    //html += "<form id='preview_form'>";
    html += "<div class='form-group'>";
    html += "<label for='exampleInputEmail1'>Category Name</label>";
    html += "<input type='text' class='form-control' id='value1'  placeholder='Enter Category' value=''>";
    html += "<span id='nameError'></span>";
    html += "</div>";
    html += "<div class='form-group'>";
    html += "<label for='exampleInputPassword1'>Description</label>" ;
    html += "<input type='text' class='form-control' id='value2' placeholder='Description' value=''>" ;
    html += "<span id='desError'></span>";
    html += "</div>";
    html += "<div class='col-md-6'>";
    html += "<input type='file' id='upload_file' accept='image/jpeg, image/png'/>";
    html += "</div>";
    //html += "</form>";
    var add = url;
    var html1 = "";
    html1 += "<div class='modal-footer' id='btn_div'>";
    html1 += "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
    html1 += "<button type='button' onclick ='mainAjaxCall(this)'  data-url='" + add +"'   data-type='post' data-action='ADD_CAT' data-for='category' class='btn btn-primary'>Save changes</button>";
    $('#btn_div').html(html1);

    $('#heading').text("Add Category")

    $('#modal-content').html(html);
    $('#category_modal').modal('show');
   

}


function productModal(elem)
{
    var url = '{{ url("all-categories") }}';
    var host = window.location.host;
    $.ajax({

        type: 'get',
        url: '/all-categories',
        processData: false,
        contentType: false,
        
        success:function(data) {
            console.log(data.data);
    var html = "";
    var url = window.location.href;
    var html = "";
    html += "<div class='form-group'>";
    html += "<label> Name</label>";
    html += "<input type='text' class='form-control' id='value1'  placeholder='Enter Product' value=''>";
    html += "</div>";
    // html += "<label >Sale Price</label>" ;
    // $.each(data,function(index,value){
    // html += "<input type='text' class='form-control' id='value3' placeholder='Sale Price' value='"+value+"'>" ;
    // });
    // html += "</div>";

    html += "<label >Sale Price</label>" ;
    html += "<input type='text' class='form-control' id='value3' placeholder='Sale Price' value=''>" ;
    html += "</div>";
    html += "<label>Purchase Price</label>" ;
    html += "<input type='text' class='form-control' id='value4' placeholder='Purchase Price' value=''>" ;
    html += "</div>";
    html += "<div class='form-group'>";
    html += "<label>Description</label>" ;
    html += "<input type='text' class='form-control' id='value2' placeholder='Description' value=''>" ;
    html += "</div>";
    html += "<div class='col-md-6'>";
    html += "<input type='file' id='upload_file' accept='image/jpeg, image/png'/>";
    html += "</div>";
    var add = url;
    var html1 = "";
    html1 += "<div class='modal-footer' id='btn_div'>";
    html1 += "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
    html1 += "<button type='button' onclick ='mainAjaxCall(this)'  data-url='" + url +"'   data-type='post' data-action='ADD_PRODUCT' ' class='btn btn-primary'>Save changes</button>";
    $('#submitbtn').html(html1);

    $('#p_heading').text("Add Product")

    $('#p_modal-content').html(html);
    $('#product_modal').modal('show');

        }

});

}



