@extends('admin.layouts.main')

@section('contenido')
     <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">
              <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-add">
                <i class="fa fa-plus"></i> Agregar producto</button>
              </li>
              
            </ol>
           </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
      @if($message= Session::get('Listo'))
                <div class="alert alert-success alert-dismissable fade show col-12" role="alert">
                  <h5>Listo:</h5>
                  <p>Se ha insertado correctamente</p>
                </div>
             @endif
        <table class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Stock</th>
              <th>Precio</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($productos as $p)
              <tr>
                <td>
                   <img src="{{ asset('img/productos/'.$p->image) }}" alt="" width="70px"> 
                   {{ $p->name }}
                </td>
                <td>{{ $p->description }}</td>
                <td>{{ $p->stock }}</td>
                <td>{{ $p->price }}</td>
                <td>
                  <button class="btn btn-danger btnEliminar" data-id="{{ $p->id }}"
                  data-toggle="modal" data-target="#modal-delete">
                  <i class="fa fa-trash"></i></button>
                  <form action="{{ url('/admin/paquetes', [id=>$p->id])}}"
                      method="POST" id="formEliminar_{{ $p->id }}">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      <input type="text" name="id" value="{{ $p->id }}">
                      <input type="text" name="_method" value="delete">
                  </form>
                </td>
              </tr>
              @endforeach
            
          </tbody>
       
        </table>
      </div>
    </div>
  </div>

    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="/admin/productos" method="POST" enctype="multipart/form-data">
              @if($message= Session::get('errorInsert'))
                <div class="alert alert-danger alert-dismissable fade show col-12" role="alert">
                  <h5>Error:</h5>
                  <ul>
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
             @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control form-control-border" id="nombre" name="nombre" value="{{ @old('nombre')}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control form-control-border" id="descripcion" name="descripcion"  value="{{ @old('descripcion')}}">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control form-control-border" id="stock" name="stock"  value="{{ @old('stock')}}">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" class="form-control form-control-border" id="precio" min="1" name="precio"  value="{{ @old('precio')}}"> 
                    </div>
                    <div class="form-group">
                        <label for="stock">Imagen</label>
                        <input type="file" class="form-control form-control-border" id="imagen" name="imagen"  value="{{ @old('imagen')}}">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h2 class="h6">Desea eliminar el producto?</h2>
                    
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
              </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
@endsection
@section('scripts')
    <script>
    var idEliminar=-1;
      $(document).ready(function(){
        @if($message= Session::get('errorInsert'))
          $("#modal-add").modal('show');
        @endif

        $(".btnEliminar").click(function(){
          var id=$(this).data('id');
          alert(id);
          idEliminar=id;
        });
      });
    </script>
@endsection