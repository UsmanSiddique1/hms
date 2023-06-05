@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Beds</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Beds</li>
                    <li class="breadcrumb-item active">All Bed</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <!-- Nav tabs -->
                        <a href="{{ route('beds.create') }}" class="btn btn-secondary">Add Bed</a>

                      
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
                    <h2>Beds List</h2>
                    <ul class="header-dropdown">
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>                                       
                                    <th>ID</th>
                                    <th>Number</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($beds as $key => $bed)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><span class="list-name">{{ $bed->number }}</span></td>
                                    <td>Rs.{{ $bed->price }}</td>         
                                    <td><button type="button" class="btn btn-primary edit-data"
                                        data-id="{{ $bed->id }}" 
                                        data-number="{{ $bed->number }}" 
                                        data-price="{{ $bed->price }}"
                                        >
                                        <i class="fa fa-pencil"></i>
                                      </button>
                                      <a href="javascript:void(0)" class="delete btn btn-danger" 
                                          data-id="{{ $bed->id }}"
                                          data-number="{{ $bed->number }}"
                                            ><i class="fa fa-trash"></i></a>
                                    </td>                                
                                    
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
                    <input type="text" class="form-control" name="number" id="number" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" class="form-control" name="phone" id="price" disabled placeholder="phone">
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
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Bed <strong>"<span id="bed_number"></span>"</strong> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="deleteForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <div class="modal-body"> 
                <strong>Alert!</strong> This Action will not be UNDO.
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">DELETE NOW</button>
            </div>
        </form>
      </div>
    </div>
</div>
@push('footer-scripts')
<script>
    $('.edit-data').click(function(){       
        $('#number').val($(this).data("number"));
        $('#price').val($(this).data("price"));
        var bed_id = $(this).data('id');
        $('#updateForm').attr('action',"{{ url('beds') }}/"+bed_id);
        $('#updateModel').modal().show();
    });

    $('.delete').click(function(){
        var id = $(this).data('id');
        var number = $(this).data('number');
        $('#bed_number').text(number);
        $('#deleteForm').attr('action',"{{ url('beds') }}/"+id);
        $('#deleteModel').modal().show();
    });
</script>
@endpush
@endsection