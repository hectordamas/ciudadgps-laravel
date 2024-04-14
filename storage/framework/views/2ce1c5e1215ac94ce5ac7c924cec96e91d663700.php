
<?php $__env->startSection('title'); ?>
<title><?php echo e($article->title); ?> - CiudadGPS</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb_section page-title-mini" style="background-image: url('<?php echo e(asset('assets/blog.jpg')); ?>'); background-position: center center; background-size: cover; position: relative;">

    <div style="position: absolute; top: 0; right: 0; width: 100%; height:100%; background: rgba(0,0,0,0.6);"></div>

    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-8">
                <div class="page-title">
            		<h1 class="text-light text-capitalize">Blog</h1>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb justify-content-md-end text-light">
                    <li class="breadcrumb-item text-light"><a href="/" class="text-light">Inicio</a></li>
                    <li class="breadcrumb-item text-light"><a href="<?php echo e(url('/blog')); ?>" class="text-light">Blog</a></li>
                    <li class="breadcrumb-item text-light active">Artículo</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>

<!-- STAT SECTION ABOUT --> 
<div class="section py-5">
	<div class="container">
    	<div class="row">
        	<div class="col-xl-9">
            	<div class="single_post">
                	<h2 class="blog_title"><?php echo e($article->title); ?></h2>
                    <ul class="list_none blog_meta">
                        <li><a href="#"><i class="ti-calendar"></i> <?php echo e($article->created_at->diffForHumans()); ?></a></li>
                    </ul>
                    <div class="blog_img">
                        <img src="<?php echo e(asset($article->image)); ?>" style="object-fit: cover; max-height: 350px;" alt="<?php echo e($article->title); ?>" />
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">

                            <?php echo $article->content; ?>


                        	<div class="blog_post_footer">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <div class="tags">
                                            <?php $__currentLoopData = $article->atags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(url('/search/tags/' . $tag->id)); ?>"><?php echo e($tag->name); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post_navigation bg_gray">
                    <div class="row align-items-center justify-content-between p-4">
                        <div class="col-6">
                            <?php if($previousArticle): ?>
                            <a href="<?php echo e(url('blog/' . $previousArticle->slug )); ?>">
                                <div class="post_nav post_nav_prev">
                                    <i class="ti-arrow-left"></i>
                                    <span><?php echo e(Illuminate\Support\Str::limit($previousArticle->title, 35)); ?></span>
                                </div>
                            </a>
                            <?php endif; ?>
                        </div>

                        <div class="col-6">
                            <?php if($nextArticle): ?>
                            <a href="<?php echo e(url('blog/' . $nextArticle->slug )); ?>">
                                <div class="post_nav post_nav_next">
                                    <i class="ti-arrow-right"></i>
                                    <span><?php echo e(Illuminate\Support\Str::limit($nextArticle->title, 35)); ?></span>
                                </div>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
				<div class="card post_author">
                	<div class="card-body">
                    	<div class="author_img">
                        	<img 
                                src="<?php echo e($article->user->avatar); ?>" 
                                width="90" 
                                height="90" 
                                style="border-radius: 100%; object-fit: cover;" 
                                alt="<?php echo e($article->user->name); ?>" 
                            />
                        </div>
                        <div class="author_info">
                        	<h5 class="author_name"><?php echo e($article->user->name); ?></h5>
                            <span class="d-inline-bloc font-weight-bold" style="font-size: 13px;"><?php echo e($article->user->job_position); ?></span>
                        	<p><?php echo e($article->user->bio); ?></p>
                        </div>
                    </div>
                </div>
                <div class="related_post">
                	<div class="content_title">
                    	<h5>Artículos Relacionados</h5>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $relatedArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <div class="blog_post blog_style2 box_shadow1">
                                <div class="blog_img">
                                    <a href="<?php echo e(url('/blog/' . $related->slug)); ?>">
                                        <img src="<?php echo e(asset($related->image)); ?>" height="200" alt="<?php echo e($related->title); ?>">
                                    </a>
                                </div>
                                <div class="blog_content bg-white">
                                    <div class="blog_text">
                                        <h5 class="blog_title"><a href="<?php echo e(url('/blog/' . $related->slug)); ?>"><?php echo e(Illuminate\Support\Str::limit($related->title, 60)); ?></a></h5>
                                        <ul class="list_none blog_meta">
                                            <li><a href="#"><i class="ti-calendar"></i> <?php echo e($related->created_at->diffForHumans()); ?></a></li>
                                        </ul>
                                        <p><?php echo e(Illuminate\Support\Str::limit($related->excerpt, 140)); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                   

                	</div>
                </div>

            </div>

            <div class="col-xl-3 mt-4 pt-2 mt-xl-0 pt-xl-0">
            	<div class="sidebar">
                	<div class="widget">
                        <div class="search_form">
                            <form method="GET" action="<?php echo e(url('search/blog')); ?>"> 
                                <input required name="search" class="form-control" placeholder="Buscar..." type="text">
                                <button type="submit" title="Subscribe" class="btn icon_search" name="submit" value="Submit">
                                    <i class="ion-ios-search-strong"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                	<div class="widget">
                    	<h5 class="widget_title">Articulos Más Recientes</h5>
                        <ul class="widget_recent_post">
                            <?php $__empty_1 = true; $__currentLoopData = $recentArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="<?php echo e(url('/blog/' . $recent->slug)); ?>">
                                            <img src="<?php echo e(url($recent->image)); ?>" alt="<?php echo e($recent->title); ?>">
                                        </a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="<?php echo e(url('/blog/' . $recent->slug)); ?>"><?php echo e(Illuminate\Support\Str::limit($recent->title, 40)); ?></a></h6>
                                        <p class="small m-0"><?php echo e($recent->created_at->diffForHumans()); ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <a href="#">No hay Artículos Recientes Disponibles</a>
                            </li>
                            <?php endif; ?>
                    	</ul>
                    </div>

                	<div class="widget">
                    	<h5 class="widget_title">Etiquetas</h5>
                        <div class="tags">
                            <?php $__empty_1 = true; $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        	    <a href="<?php echo e(url('/search/tags/' . $tag->id)); ?>" ><?php echo e($tag->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <a href="#">No hay Etiquetas Disponibles</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- END SECTION ABOUT --> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/articles/show.blade.php ENDPATH**/ ?>