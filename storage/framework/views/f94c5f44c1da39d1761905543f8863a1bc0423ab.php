
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card shadow">
            <div class="card-header font-weight-bold text-dark">
                Modificar Articulo
            </div>
            <div class="card-body">
                <form class="row" action="<?php echo e(url('/articles/' .$article->id. '/update')); ?>" 
                    method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-6 form-group">
                        <label for="title" class="font-weight-bold">Titulo</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo e($article->title); ?>"/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="image" class="font-weight-bold">Imagen Destacada</label>
                        <input type="file" class="form-control" name="image" accept="image/*" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="slug" class="font-weight-bold">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="<?php echo e($article->slug); ?>" readonly/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="tags" class="font-weight-bold">Etiquetas</label>
                        <select name="tags[]" id="tags" class="form-control js-example-tags" multiple>
                            <?php $__currentLoopData = $tags->sortBy('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $selected = in_array($tag->id, $article->atags->pluck('id')->toArray()) ? 'selected' : '';
                                ?>

                                <option value="<?php echo e($tag->name); ?>" <?php echo e($selected); ?>><?php echo e($tag->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>



                    <div class="col-md-12 form-group">
                        <label for="excerpt" class="font-weight-bold">Resumen</label>
                        <textarea name="excerpt" class="form-control" rows="5"><?php echo $article->excerpt; ?></textarea>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="content" class="font-weight-bold">Contenido</label>
                        <textarea name="content" id="summernote" class="form-control"><?php echo $article->content; ?></textarea>
                    </div>

                    <div class="col-md-12 form-group">
                        <input type="submit" class="btn btn-dark" value="Modificar Articulo">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
<script>
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('keyup', function() {
        const titleValue = titleInput?.value?.trim()?.toLowerCase()?.replace(/[^\w\s]/gi, '')?.replace(/\s+/g, '-');
        const maxLength = 50; // Longitud máxima deseada del slug
        const truncatedSlug = titleValue.substring(0, maxLength); // Recorta el slug si es demasiado largo
        slugInput.value = truncatedSlug;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/articles/edit.blade.php ENDPATH**/ ?>