@extends('layouts.app')
@section('content')
<div>
    
        <button type="button"  onclick = "productModal(this)"   data-val="ADD_PRODUCT" class="btn btn-primary mb-2" data-toggle="modal">
           Add
          </button>     
    <div>
<div class="col-md-12">
    <table id="product-table" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Sale Price</th>
                <th>Purchase Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
    </table>

    
        <div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="p_heading"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="p_modal-content">
                  ...
                </div>
                <div class="modal-footer" id="submitbtn">
                  
                </div>
              </div>
            </div>
          </div>
       </div>
      </div>
       @endsection
       @push('page-scripts')
       <script>
      var table = $('#product-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('products-list') }}",
      columns: [
          
          {data: 'name', name: 'name'},
          {data: 'sale_price', name: 'sale_price'},
          {data: 'purchase_price', name: 'purchase_price'},
          {data: 'description', name: 'description'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    
  });
       </script>
       @endpush
      

