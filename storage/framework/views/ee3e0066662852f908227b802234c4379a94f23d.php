
<?php $__env->startSection('title'); ?>
<title>Configurar Horarios de Atención - CiudadGPS</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        Horarios de Atención
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="commerce_id" value=<?php echo e($commerce->id); ?> id="commerce_id">
                        <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row day-row" data-day-id="<?php echo e($day['id']); ?>">
                                <div class="col-md-12 pb-2">
                                    <div class="form-check d-flex justify-content-between align-items-center">
                                        <label class="form-check-label" for="activarCatalogo">
                                            <?php echo e($day["name"]); ?>

                                        </label>
                                        <input 
                                            class="form-check-input enable-checkbox" 
                                            <?php if($day["isSelected"]): ?> 
                                                checked
                                            <?php endif; ?>
                                            type="checkbox" 
                                            value="active" 
                                        >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 form-group">
                                            <label for="open-time-<?php echo e($day['id']); ?>">Hora de Apertura</label>
                                            <input type="time" id="open-time-<?php echo e($day['id']); ?>" class="form-control open-time" 
                                                value="<?php echo e(sprintf('%02d:%02d', $day['hour_open'], $day['minute_open'])); ?>">
                                        </div>
                                        <div class="col-sm-6 col-lg-6 form-group">
                                            <label for="close-time-<?php echo e($day['id']); ?>">Hora de Cierre</label>
                                            <input type="time" id="close-time-<?php echo e($day['id']); ?>" class="form-control close-time" 
                                                value="<?php echo e(sprintf('%02d:%02d', $day['hour_close'], $day['minute_close'])); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('map'); ?>
<script>
    $(document).ready(function() {
        $('.enable-checkbox, .open-time, .close-time').on('input', function() {
            let $row = $(this).closest('.day-row');
            let dayId = $row.data('day-id');
            let isSelected = $row.find('.enable-checkbox').is(':checked');
            let hourOpen = $row.find('.open-time').val().split(':')[0];
            let minuteOpen = $row.find('.open-time').val().split(':')[1];
            let hourClose = $row.find('.close-time').val().split(':')[0];
            let minuteClose = $row.find('.close-time').val().split(':')[1];
            let commerce_id = $('#commerce_id').val();

            $.ajax({
                url: "<?php echo e(url('locales-asociados/cambiarHorarios')); ?>",
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: dayId,
                    is_selected: isSelected,
                    hour_open: hourOpen,
                    minute_open: minuteOpen,
                    hour_close: hourClose,
                    minute_close: minuteClose,
                    commerce_id: commerce_id
                },
                success: function(response) {
                    console.log('Horario actualizado:', response);
                },
                error: function(error) {
                    console.error('Error al actualizar el horario:', error);
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/localesAsociados/hours/index.blade.php ENDPATH**/ ?>