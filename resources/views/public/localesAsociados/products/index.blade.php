@extends('layouts.public')
@section('title')
<title>CiudadGPS - Productos</title>
@endsection
@section('content')
<!--------------------------- Lista de Categorias ------------------------------------------>
<div class="modal fade" id="Categorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Todas Las Categorías</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered shop_cart_table">
                        <tbody>
                            @forelse($pcategories as $pcategory)
                            <tr>
                                <td>{{ $pcategory->name }}</td>
                                <td class="d-flex justify-content-center">
                                    <form 
                                        method="POST"
                                        action="{{ url('locales-asociados/categories/'. $pcategory->id .'/destroy') }}" 
                                        class="mr-2 destroy-pcategory">
                                        @csrf
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                    <a href="{{ url('locales-asociados/categories/'. $pcategory->id . '/edit' ) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center">Aun no has creado categorias</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


<!--------------------------- Crear Categoria ------------------------------------------>
<div class="modal fade" id="CrearCategorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('locales-asociados/categories/store')  }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $commerce->id }}" name="commerce_id"/>

                        <div class="form-group">
                            <label for="name">Nombre de la Categoria</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <button class="btn btn-fill-line">Registrar Categoria</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


<!---------------------------- Crear Producto ------------------------------------------->
<div class="modal fade" id="CrearProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('locales-asociados/products/store')  }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $commerce->id }}" name="commerce_id"/>

                        <div class="form-group">
                            <label for="name" class="text-info">Nombre del Producto</label>
                            <input type="text" class="form-control" required name="name">
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-info">Imagen del Producto</label>
                            <input type="file" class="form-control" required name="image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="pcategory_id" class="text-info">Selecciona una Categoria</label>
                            <select name="pcategory_id" id="pcategory_id" class="form-control">
                                <option value="">Selecciona una Categoria</option>
                                @foreach($pcategories as $pcategory)
                                    <option value="{{ $pcategory->id }}">{{ $pcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description" class="text-info">Descripción</label>
                            <input type="text" class="form-control" required name="description">
                        </div>

                        <div class="form-group">
                            <label for="price" class="text-info">Precio</label>
                            <input type="number" step="any" min="1" class="form-control" name="price" id="price" required>
                            <strong class="text-success" id="priceFormated"></strong>
                        </div>


                        <button class="btn btn-fill-line">Registrar Producto</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center pb-3">
                <img src="{{ url($commerce->logo) }}" alt="Logo {{$commerce->name}}" width="80" height="80" class="shadow" style="border-radius: 100%;">
            </div>
            <div class="col-md-12 pb-2">
                <h6 class="text-center">Gestiona tus Productos en {{$commerce->name}}</h6>
            </div>
            <div class="col-md-12 pb-3 text-center">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        @if($commerce->enable) 
                            checked
                        @endif
                        type="checkbox" 
                        value="active" 
                        id="enable"
                    >
                    <input type="hidden" value="{{ $commerce->id }}" id="commerce_id" />
                    <label class="form-check-label" for="activarCatalogo">
                      Activar Catálogo
                    </label>
                </div>
            </div>
            <div class="col-md-12 pb-3 d-block text-center d-lg-flex justify-content-center">
                <a href="{{ url('slug-comercios/' . $commerce->slug) }}" target="_blank" class="btn btn-sm btn-fill-line mr-2">
                    <i class="fas fa-store"></i> Ir al Perfil Comercial
                </a>

                <div class="dropdown mr-2">
                    <button class="mt-1 btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton{{$commerce->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list"></i> Categorías
                    </button>
                    <div class="mt-1 dropdown-menu shadow border-0" aria-labelledby="dropdownMenuButton{{$commerce->id}}">
                       <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#Categorias">
                            <i class="fas fa-list"></i> Lista de Categorías
                       </a>
                       <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#CrearCategorias">
                            <i class="far fa-plus-square"></i> Crear Categoria                      
                        </a>
                    </div>
                </div>

                <a class="mt-1 btn btn-sm btn-fill-line" href="javascript:void(0)" data-toggle="modal" data-target="#CrearProductos">
                    <i class="fas fa-box-open"></i> Registrar un Producto
                </a>
            </div>

            <div class="col-md-12 pb-3">
                <table class="table table-bordered table-striped shop_cart_table">
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                <a href="{{ asset($product->image) }}" target="_blank">
                                    <img 
                                        class="border shadow"
                                        src="{{ asset($product->image) }}" 
                                        alt="Producto: {{$product->name}}" 
                                        width="50"
                                        height="50"
                                    />
                                </a>
                            </td>
                            <td>{{$product->name}}</td>
                            <td class="text-success font-weight-bold">${{ number_format($product->price, 2, '.', ',') }}</td>
                            <td class="d-flex justify-content-center">
                                <form 
                                        method="POST"
                                        action="{{ url('locales-asociados/productos/'. $product->id .'/destroy') }}" 
                                        class="mr-2 destroy-product">
                                    @csrf
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <button class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                
                                <a href="{{ url('locales-asociados/productos/' . $product->id . '/edit') }}" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center">
                                No has creado productos aún
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('map')
<script>
    $(document).ready(function() {
        $('#enable').on('change', function() {
            var formData = new FormData();
            formData.append('enable', $('#enable').is(':checked') ? 'active' : 'inactive');
            formData.append('commerce_id', $('#commerce_id').val());
            console.log($('#enable').is(':checked'))
            $.ajax({
                url: "{{ url('locales-asociados/setIsEnable') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response)
                },
                error: function(xhr) {
                    console.error('Error en la solicitud:', xhr);
                }
            });
        });

        $('#price').on('input', function(){
            let price = $('#price').val()

            let priceFormated = new Intl.NumberFormat("es-ES", {
                style: "currency",
                currency: "USD",
            }).format(price)

            $('#priceFormated').html(priceFormated)
        })

        $('.destroy-product').on('submit', function(){
            if(confirm('Estás seguro de eliminar este producto?, los cambios serán irreversibles')){
                return true
            }else{
                return false
            }
        })

        $('.destroy-pcategory').on('submit', function(){
            if(confirm('Estás seguro de eliminar esta categoria?, los cambios serán irreversibles')){
                return true
            }else{
                return false
            }
        })
    })
</script>
@endsection