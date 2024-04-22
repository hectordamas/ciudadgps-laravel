
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Lista de Notificaciones
            </div>
            <div class="card-body" style="overflow-x: auto;">
                <table class="datatable table table-bordered table-sm">
                    <thead class="table-dark">
                        <th></th>
                        <th>Titulo</th>
                        <th>Ver Detalle</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pushnotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($notification->created_at)->format('d/m/Y')); ?></td>
                            <td><?php echo e(Illuminate\Support\Str::limit($notification->title, 100)); ?></td>
                            <td>
                                <a  
                                    href="javascript:void(0)" 
                                    class="btn btn-sm btn-info detailButton" 
                                    data-id="<?php echo e($notification->id); ?>" 
                                    data-toggle="modal" 
                                    data-target="#exampleModal"
                                    onclick="detailButton(<?php echo $notification->id; ?>);"
                                    >
                                    <i class="far fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body body-modal">
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('map'); ?>
<script>
    $('.body-modal').html('')
    function detailButton(id){
      $.ajax({
        headers:{
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        url:'/getPushNotificationData',
        type:'POST',
        data:{id},
        success:function(data){
          $('.body-modal').html(`<p><strong>Titulo:</strong> ${data?.pushnotification?.title} <br> <strong>Mensaje:</strong> ${data?.pushnotification?.message}</p>`);
        },
      });
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/pushnotifications/index.blade.php ENDPATH**/ ?>