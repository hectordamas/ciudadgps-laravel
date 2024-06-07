@extends('layouts.public')
@section('title')
<title>Empleos de {{$commerce->name}} en CiudadGPS</title>
@endsection
@section('content')
<!---------------------------- Crear Empleo ------------------------------------------->
<div class="modal fade" id="CrearEmpleos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Publicar Empleo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('locales-asociados/jobs/store')  }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $commerce->id }}" name="commerce_id"/>

                        <div class="form-group">
                            <label for="title" class="text-info">Cargo</label>
                            <input type="text" class="form-control" required name="title">
                        </div>

                        <div class="form-group">
                            <label for="description" class="text-info">Descripción del Cargo</label>
                            <textarea class="form-control" required name="description" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="user_email" class="text-info">E-Mail de Contacto:</label>
                            <input type="email" class="form-control" required name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="whatsapp" class="text-info">Whatsapp de Contacto:</label>
                            <input type="hidden" name="whatsapp_number_code" id="whatsapp_number_code" value="+58">
                            <input type="hidden" name="whatsapp_code" id="whatsapp_code" value="VE">
                            <input type="hidden" name="whatsapp_number" id="whatsapp_number">
                            <input type="hidden" name="whatsapp" id="whatsapp">
                            <input type="text" id="whatsappFormatted" required class="form-control" placeholder="412-1234567">
                        </div>

                        <button class="btn btn-fill-line">Publicar Empleo</button>
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
            <div class="col-md-12 text-center mb-3">
                <img 
                    src="{{ asset($commerce->logo) }}" 
                    alt="{{$commerce->name}}" 
                    width="100" 
                    height="100" 
                    style="border-radius: 100%;">

                <h6 class="mt-3">Empleos de {{$commerce->name}}</h6>

                <a class="mt-1 btn btn-fill-line btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#CrearEmpleos">
                    <i class="fas fa-briefcase"></i> Registrar un Empleo
                </a>
            </div>

            <div class="col-md-12">
                <table class="table shop_cart_table table-bordered table-striped">
                    @forelse($jobs as $job)
                        <tr>
                            <td>
                                {{$job->title}}
                            </td>
                            <td>
                                {{$job->created_at->diffForHumans()}}
                            </td>
                            <td>
                                {{$job->email}}
                            </td>
                            <td>
                                {{$job->whatsapp_number_code}}{{$job->whatsapp_number}}
                            </td>
                            <td class="d-flex justify-content-center">
                                <form 
                                    method="POST"
                                    action="{{ url('locales-asociados/jobs/'. $job->id .'/destroy') }}" 
                                    class="mr-2 destroy-jobs">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                <a href="{{ url('locales-asociados/jobs/'. $job->id . '/edit' ) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center">
                                No has publicado Empleos aún
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>


        </div>
    </div>
</div>
@endsection

@section('map')
<script>
    $(document).ready(function() {

        $('.destroy-jobs').on('submit', function(){
            if(confirm('Estás seguro de eliminar este aviso de empleo?, los cambios serán irreversibles')){
                return true
            }else{
                return false
            }
        })
    })
</script>
@endsection