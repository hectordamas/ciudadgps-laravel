
<?php $__env->startSection('title'); ?>
<title>CiudadGPS - Empleos</title>
<meta name="description" content="Encuentra personal para tu empresa y busca empleo si eres un profesional" />
<meta name="keywords" content="Afiliar, comercio, negocio, emprendimiento, bolsa de empleo, talento, personal, captacion, trabajo, venezuela">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .content-p {
      max-height: 3.2em; /* Aproximadamente dos líneas de texto */
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
</style>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/jobs.jpg')); ?>'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h3 class="text-light text-capitalize">Descubre oportunidades laborales en CiudadGPS</h3>
                </div>
                <div class="row mt-4 d-md-flex d-none">
                    <div class="col-md-3 pr-1">
                        <a 
                            href="https://play.google.com/store/apps/details?id=com.ciudadgps.app" 
                            target="blank">
                            <img 
                                src="<?php echo e(asset('appButtons/play_store.png')); ?>" 
                                alt="App Store Button" 
                            />
                        </a>
                    </div>
                    <div class="pl-1 col-md-3">
                        <a 
                            href="https://apps.apple.com/us/app/ciudadgps/id1643027976"
                            target="blank">
                            <img 
                                src="<?php echo e(asset('appButtons/app_store.png')); ?>" 
                                alt="App Store Button" 
                            />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light active">Empleos</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- STAT SECTION FAQ --> 
<div class="section">
	<div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-10 mb-5">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <form action="<?php echo e(url('/empleos')); ?>">
                            <div class="input-group">
                                <input type="text" name="search" placeholder="Buscar Empleos Por Palabra Clave, Cargo o Empresa:" class="pl-3 form-control border-0 bg-light">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-0 bg-light">
                                        <i class="fas fa-search text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!--en el siguiente contenedor se deben ir colocando las sugerencias de busqueda-->
                        <div class="shadow bg-light search-results" style="position: absolute; width: 95.5%; z-index: 100;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-lg-10 mb-3">

                    <div class="card shadow border-0">

                        <div class="card-body">

                            <div class="row">

                                <a href="/empleo/<?php echo e($job->slug); ?>" class="col-md-2 col-3 d-flex justify-content-center">
                                    <img src="<?php echo e($job->commerce->logo); ?>" style="width: 100px; height: 100px;" class="rounded-circle border d-none d-md-block" alt="<?php echo e($job->title); ?>">
                                    <img src="<?php echo e($job->commerce->logo); ?>" style="width: 50px; height: 50px;" class="rounded-circle border d-block d-md-none" alt="<?php echo e($job->title); ?>">
                                </a>

                                <div class="col-md-10 col-9">
                                    <h4 class="product_title">
                                        <a href="/empleo/<?php echo e($job->slug); ?>"><?php echo e($job->title); ?></a>
                                    </h4>
                                    <h6><?php echo e($job->created_at->diffForHumans()); ?></h6>
                                    <div class="content-p">
                                        <p><?php echo e($job->description); ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="col-lg-10 d-flex justify-content-center py-5">
                <?php echo e($jobs->appends(Request::except('page'))->links()); ?>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('map'); ?>
<script>
    $(document).ready(function() {
      // Obtener referencia a los elementos del formulario y el contenedor de sugerencias
      var searchInput = $('input[name="search"]');
      var suggestionsContainer = $('.search-results');

      function fetchSuggestions(query) {
        $.ajax({
          url: '<?php echo e(url('/api/auth')); ?>' + `/searchJobs?search=${query}`,
          success: function(response) {
            suggestionsContainer.empty();
            response.jobs.forEach(function(suggestion) {
              var suggestionItem = $('<a href="<?php echo e(url("/empleos")); ?>'+'?search='+ suggestion.title +'" class="d-block pl-3 py-2 border-bottom"></a>');
              suggestionItem.html('<i class="fas fa-search text-primary mr-2"></i> ' + suggestion.title);
              suggestionsContainer.append(suggestionItem);
            });
          },
          error: function(e) {
            console.log(e);
          }
        });
      }

      searchInput.on('keyup', function() {
        var query = $(this).val().trim(); // Obtener el valor del campo de búsqueda y eliminar espacios en blanco
        if (query.length > 0) {
          fetchSuggestions(query);
        } else {
          suggestionsContainer.empty();
        }
      });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/jobs/index.blade.php ENDPATH**/ ?>