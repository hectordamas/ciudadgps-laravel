
<?php $__env->startSection('title'); ?>
<title>Todos los Comentarios</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    use Carbon\Carbon;
    Carbon::setLocale('es');  
    
    $rating = 0;
    foreach ($commerce->comments as $co) {
        $rating = $rating + $co->rating;
    }
    if($commerce->comments->count() > 0){
        $rating = $rating / $commerce->comments->count();
    }

    $ratingP = $rating * 100 / 5;  
?>
<div class="section">
<div class="container pb-5">
    <div class="row">
        <div class="col-10">
            <div class="comments">
                <h5 class="product_tab_title"><?php echo e($commerce->comments->count()); ?> opiniones para <a href="/comercios/<?php echo e($commerce->id); ?>"><span><?php echo e($commerce->name); ?></span></a></h5>
                <ul class="list_none comment_list mt-4">
                    <?php $__currentLoopData = $commerce->comments->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $ratingC = 0;
                            $ratingC = $comment->rating * 100 / 5;
                        ?>
                        <style>
                            .comment_img img{
                                width:100px; height:100px;
                            }
                            @media only screen and (max-width: 480px){
                                .comment_img img {
                                    max-width: 50px;
                                    height: 50px;
                                }
                            }
                        </style>
                    <li>
                        <div class="comment_img">
                            <img src="<?php echo e($comment->user->avatar ? $comment->user->avatar : asset('assets/user_avatar_default.png')); ?>" referrerpolicy="no-referrer" alt="<?php echo e($comment->user->name); ?>"/>
                        </div>
                        <div class="comment_block">
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:<?php echo e($ratingC); ?>%"></div>
                                </div>
                            </div>
                            <p class="customer_meta">
                                <span class="review_author"><?php echo e($comment->user->name); ?></span>
                                <span class="comment-date"><?php echo e(Carbon::parse($comment->created_at)->diffForHumans()); ?></span>
                            </p>
                            <div class="description">
                                <p><?php echo e($comment->comment); ?></p>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <?php echo e($comments->links()); ?>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/ciudadgps.com/resources/views/public/commerces/comments.blade.php ENDPATH**/ ?>