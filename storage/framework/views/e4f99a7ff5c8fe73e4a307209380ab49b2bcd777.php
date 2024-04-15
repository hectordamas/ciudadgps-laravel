<li class="dropdown dropdown-mega-menu">
    <a class="dropdown-toggle nav-link" href="<?php echo e(url('categorias')); ?>" data-toggle="dropdown">Nuestras Categorías</a>
    <div class="dropdown-menu" style="margin-top:-15px;">
        <ul class="mega-menu d-lg-flex">
            <?php
                $catHeader = App\Models\Category::all();
                $sections = [0, 12, 24, 36];
            ?>
            <?php for($i = 0; $i < count($sections); $i++): ?>
                <?php
                    $section = $sections[$i];
                ?>
                <li class="mega-menu-col col-lg-3">
                    <ul>
                        <?php $__currentLoopData = $catHeader->skip($section)->take(12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $url = '/comercios/slug-categorias/' . $cat->slug . '?order=id';
                                if(session()->has('latitude') && session()->has('longitude')){
                                    $url = '/comercios/slug-categorias/' . $cat->slug . '?order=distance';
                                }
                            ?>
                            <li><a class="dropdown-item nav-link nav_item font-weight-bold text-secondary" href="<?php echo e(url($url )); ?>"><?php echo e($cat->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</li><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/layouts/megaMenu.blade.php ENDPATH**/ ?>