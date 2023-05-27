@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Procedures</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Procedure</li>
                    <li class="breadcrumb-item active">All Procedure</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <!-- Nav tabs -->
                        <a href="{{ route('procedures.create') }}" class="btn btn-secondary">Add Procedure</a>

                      
                    </div>
                    <div class="p-2 d-flex">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card patients-list">
                <div class="header">
                    <h2>Procedures List</h2>
                    <ul class="header-dropdown">
                        
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>                                       
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>price</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($procedures as $key => $procedure)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><span class="list-name">{{ $procedure->name }}</span></td>
                                    <td>Rs.{{ $procedure->price }}</td>       
                                    <td><button type="button" class="btn btn-primary edit-data"
                                        data-id="{{ $procedure->id }}" 
                                        data-name="{{ $procedure->name }}" 
                                        data-price="{{ $procedure->price }}"
                                        >
                                        Update
                                      </button></td>                                 
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>                            
                    </div> 
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="updateForm" method="POST">
        @csrf
        @method('PUT')
            <div class="modal-body">                
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="phone">
                </div>
                
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@push('footer-scripts')
<script>
    $('.edit-data').click(function(){       
        $('#name').val($(this).data("name"));
        $('#price').val($(this).data("price"));
        var procedure_id = $(this).data('id');
        $('#updateForm').attr('action',"{{ url('procedures') }}/"+procedure_id);
        $('#updateModel').modal().show();
    });
</script>
@endpush
@endsection