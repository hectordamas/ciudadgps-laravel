<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CiudadGPS - Dashboard</title>
    <link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/sb-admin-2.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/datatables/dataTables.bootstrap4.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(url('/administrador')); ?>">
                <div class="sidebar-brand-text mx-3">
                    <img src="<?php echo e(asset('assets/logo_gps_blanco.png')); ?>" style="width:100%; max-width:150px;">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo e(url('/administrador')); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Escritorio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Comercios
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-store"></i>
                    <span>Comercios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Comercios:</h6>
                        <a class="collapse-item" href="<?php echo e(route('commerces.create')); ?>">Crear Comercios</a>
                        <a class="collapse-item" href="<?php echo e(route('commerces.filter')); ?>">Lista de Comercios</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-bullhorn"></i>
                    <span>Anuncios</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Anuncios:</h6>
                        <a class="collapse-item" href="<?php echo e(route('banners.create')); ?>">Crear Anuncio</a>
                        <a class="collapse-item" href="<?php echo e(route('banners.index')); ?>">Lista de Anuncios</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories"
                    aria-expanded="true" aria-controls="collapseCategories">
                    <i class="fas fa-marker"></i>
                    <span>Categorías</span>
                </a>
                <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Categorías:</h6>
                        <a class="collapse-item" href="<?php echo e(route('category.create')); ?>">Crear Categoría</a>
                        <a class="collapse-item" href="<?php echo e(route('category.index')); ?>">Lista de Categorías</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistory"
                    aria-expanded="true" aria-controls="collapseHistory">
                    <i class="fas fa-history"></i>
                    <span>Historias</span>
                </a>
                <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Historias:</h6>
                        <a class="collapse-item" href="<?php echo e(route('stories.create')); ?>">Crear Historias</a>
                        <a class="collapse-item" href="<?php echo e(route('stories.index')); ?>">Lista de Historias</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrador
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-user"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Usuarios:</h6>
                        <a class="collapse-item" href="<?php echo e(url('users/create')); ?>">Registrar Usuario</a>
                        <a class="collapse-item" href="<?php echo e(url('users')); ?>">Lista de Usuarios</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifications"
                    aria-expanded="true" aria-controls="collapseNotifications">
                    <i class="fas fa-bell"></i>
                    <span>Notificaciones</span>
                </a>
                <div id="collapseNotifications" class="collapse" aria-labelledby="headingNotifications" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Notificaciones:</h6>
                        <a class="collapse-item" href="<?php echo e(url('pushnotifications/create')); ?>">Crear Notificaciones</a>
                        <a class="collapse-item" href="<?php echo e(url('pushnotifications')); ?>">Lista de Notificaciones</a>
                    </div>
                </div>
            </li>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(Auth::user()->name); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo e(Auth::user()->avatar ? Auth::user()->avatar : asset('assets/user_avatar_default.png')); ?>" 
                                    referrerpolicy="no-referrer" 
                                    alt="<?php echo e(Auth::user()->name); ?>"
                                >
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar Sesión
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    

                    <?php echo $__env->yieldContent('content'); ?>          

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



            <!-- Footer -->
            <footer class="sticky-footer bg-dark">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-light">
                        <span>Copyright &copy; CiudadGPS 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('assets/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/jquery/jquery.form.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('assets/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset('assets/js/sb-admin-2.js')); ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo e(asset('assets/vendor/chart.js/Chart.min.js')); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset('assets/js/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/demo/chart-pie-demo.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/vendor/sweetalert/sweetalert.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/d7cey82e44je5nszsk92ggh7lijck476uco237t6qs8tjsje/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="<?php echo e(asset('assets/js/script.js?v=8')); ?>"></script>
    <?php if(session()->has('error')): ?>
        <script>
            Swal.fire({icon:'error', title:'Ha ocurrido un error!', text: "<?php echo e(session('error')); ?>", confirmButtonText: "OK", confirmButtonColor: '#dc3545'})
        </script>
    <?php endif; ?>

    <?php if(session()->has('message')): ?>
        <script>
            Swal.fire({icon:'success', title:'', text: "<?php echo e(session('message')); ?>", confirmButtonText: 'OK', confirmButtonColor: '#28a745'})
        </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('map'); ?>
    <?php echo $__env->yieldContent('chart'); ?>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcWkdk6cq3cMIUqrJK36j7aErEOlWdqVo&callback=initMap">
    </script>
    
</body>

</html>

<?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>