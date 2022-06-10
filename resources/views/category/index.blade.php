
@extends('layouts.app')
@section('content')
    <div>
        <button type="button" class="btn btn-primary mb-2" onclick = "modalOpenFun(this)"   data-val="ADD_CATEGORY" data-toggle="modal">
            Add
           </button>
    <div>
        <div class="col-md-12">
        <table id="data-table" class="display data-table">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             
               
            </tbody>
        </table>


        <div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="heading"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="modal-content">
                 
                    
                </div>
                <div class="modal-footer" id="btn_div">
                 
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>

        
       
    @endsection

    @push('page-scripts')
    <script>
    var table = $('#data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('category-list') }}",
    columns: [
        
        {data: 'name', name: 'name'},
        {data: 'description', name: 'description'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
  
});

        </script>

    @endpush
    