@extends('admin.layouts.main')

@section('contenido')
     <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Clientes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <li class="breadcrumb-item"><a href="#">
                    <li class="breadcrumb-item"><a href="#">
                        <a class="btn btn-outline-primary btn-sm" href="admin/generarPDF">
                            <i class="fa fa-print"></i> Imprimir datos</a>
                    </li>
            <ol class="breadcrumb float-sm-right">
             
              <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-add">
                <i class="fa fa-plus"></i> Agregar clientes</button>
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
                  <p>{{$message}}</p>
                </div>
             @endif
        <table class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Email</th>
              <th>Dirección</th>
              <th>Ciudad</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($datos as $p)
              <tr>
               
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->address }}</td>
                <td>{{ $p->city }}</td>
                <td>
                  <button class="btn btn-danger btnEliminar" data-id="{{ $p->id }}"
                  data-toggle="modal" data-target="#modal-delete">
                  <i class="fa fa-trash"></i></button>
                  
                  <button class="btn btn-primary btnEdit" data-id="{{ $p->id }}"
                  
                  data-toggle="modal" data-target="#modal-edit">
                  <i class="fa fa-edit"></i></button>

                  <form action="{{ url('/admin/clientes', ['id'=>$p->id])}}"
                      method="POST" id="formEliminar_{{ $p->id }}">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      <input type="hidden" name="id" value="{{ $p->id }}">
                      <input type="hidden" name="_method" value="delete">
                  </form>
                </td>
              </tr>
              @endforeach
            
          </tbody>
       
        </table>
      </div>
    </div>
  </div>

<!--Modal Editar -->
<div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form action="/admin/productos/edit" method="POST" enctype="multipart/form-data">
              @if($message= Session::get('errorEdit'))
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
                  
                  <div class="modal-body">
                    <input type="hidden" id="idEdit" name="id">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control form-control-border" id="nameEdit" name="nombre" value="{{ @old('nombre')}}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control form-control-border" id="descripcionEdit" name="descripcion"  value="{{ @old('descripcion')}}">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control form-control-border" id="stockEdit" name="stock"  value="{{ @old('stock')}}">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" class="form-control form-control-border" id="precioEdit" min="1" name="precio"  value="{{ @old('precio')}}"> 
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

<!--Modal Agregar -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar producto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
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
                  <div class="modal-body">
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

<!-- Modal Eliminar -->
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
                <button type="button" class="btn btn-danger btnCloseEliminar">Eliminar</button>
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

        @if($message= Session::get('errorEdit'))
          $("#modal-edit").modal('show');
        @endif


        $(".btnEliminar").click(function(){
          var id=$(this).data('id');
          idEliminar=id;
        });
        $(".btnEdit").click(function(){
          var id=$(this).data('id');
          $('#idEdit').val(id);
          var name=$(this).data('name');
          $('#nameEdit').val(name);
          var description=$(this).data('description');
          $('#descripcionEdit').val(description);
          var stock=$(this).data('stock');
          $('#stockEdit').val(stock);
          var price=$(this).data('price');
          $('#precioEdit').val(price);


        });
        $(".btnCloseEliminar").click(function(){
          $("#formEliminar_"+idEliminar).submit();
        });
      });
    </script>
@endsection