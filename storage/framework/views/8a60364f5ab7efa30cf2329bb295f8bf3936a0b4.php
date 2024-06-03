
<?php $__env->startSection('title'); ?>
<title>CiudadGPS - Chatea con Sof.ia</title>
<meta name="description" content="Descubre la IA de CiudadGPS, Sofia, ayuda a nuestros usuarios a encontrar comercios cercanos a su ubicación y te da sugerencias según lo que necesites" />
<meta name="keywords" content="Inteligencia artificial, ia, ciudadgps, comercios">
<style>
    .message-card {
        max-width: 75%;
        padding: 10px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        background: #f5f5f5;
    }
    .user-message {
        background-color: #e1ffc7;
        align-self: flex-end;
    }
    .bot-message {
        background-color: #fff;
        align-self: flex-start;
    }
    .message-time {
        display: block;
        margin-top: 5px;
        font-size: 0.85em;
        text-align: right;
    }
    @media (max-width: 767.98px) {
        .drawer-menu {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 75%;
            height: 100%;
            background: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            z-index: 1050;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        .drawer-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        .drawer-open .drawer-menu {
            transform: translateX(0);
        }
        .drawer-open .drawer-backdrop {
            display: block;
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="section" style="background-image: url(<?php echo e(asset('chatbg.jpg')); ?>);">
    <div class="container-fluid contenedor">
        <div class="row px-lg-2">
            <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                <div class="drawer-menu shadow-sm">
                    <div class="card border-0" style="border-radius: 10px; height: 60vh; overflow-y: auto;">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">Conversaciones</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom">
                                    <a href="#!" class="d-flex justify-content-between px-2">
                                        <div class="d-flex flex-row">
                                            <div class="pt-1">
                                                <p class="small text-muted">
                                                    <i class="fas fa-comment-alt mr-1"></i> Conversación 1
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p class="small text-muted mb-1">Just now</p>
                                        </div>
                                    </a>
                                </li>
                                <!-- Más elementos de conversación -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="drawer-backdrop"></div>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between">
                        <h6 class="font-weight-bold mb-0">Chatea con Sof.ia</h6>
                        <a href="javascript:void(0)" class="d-md-none" id="drawerButton">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="chat-window shadow-sm" style="max-height: 60vh; overflow-y: auto; border-radius: 8px; padding: 16px;">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-start mb-4">
                            <div class="message-card bot-message">
                                <h6 class="text-secondary">Sof.ia:</h6>
                                <p class="mb-0">Hola, soy Sof.ia, tu asistente virtual. ¿En qué puedo ayudarte hoy?</p>
                                <span class="message-time text-muted small">Hace 1 minuto</span>
                            </div>
                        </li>
                        <li class="d-flex justify-content-end mb-4">
                            <div class="message-card user-message">
                                <h6 class="text-success">Tu:</h6>
                                <p class="mb-0">Necesito encontrar una cafetería cercana.</p>
                                <span class="message-time text-muted small">Hace 1 minuto</span>
                            </div>
                        </li>
                        <li class="d-flex justify-content-start mb-4">
                            <div class="message-card bot-message">
                                <h6 class="text-secondary">Sof.ia:</h6>
                                <p class="mb-0">Claro, hay una cafetería llamada "Café Central" a 500 metros de tu ubicación.</p>
                                <span class="message-time text-muted small">Hace 50 segundos</span>
                            </div>
                        </li>
                        <li class="d-flex justify-content-end mb-4">
                            <div class="message-card user-message">
                                <h6 class="text-success">Tu:</h6>
                                <p class="mb-0">¡Perfecto, gracias!</p>
                                <span class="message-time text-muted small">Hace 30 segundos</span>
                            </div>
                        </li>
                        <li class="d-flex justify-content-start mb-4">
                            <div class="message-card bot-message">
                                <h6 class="text-secondary">Sof.ia:</h6>
                                <p class="mb-0">De nada. ¿Necesitas algo más?</p>
                                <span class="message-time text-muted small">Hace 15 segundos</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="input-group mt-3 shadow border-0" style="border-radius: 10px">
                    <input class="form-control border-0" id="messageInput" placeholder="Escribe tu Mensaje..." style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;" />
                    <button type="button" id="sendButton" class="btn btn-fill-out rounded-0" style="border-top-right-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                        <i class="fas fa-paper-plane"></i> Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('map'); ?>
<script>
    document.getElementById('sendButton').addEventListener('click', function() {
        const messageInput = document.getElementById('messageInput');
        const messageText = messageInput.value;

        if (messageText.trim() !== '') {
            const chatMessages = document.querySelector('.chat-window ul');

            // Añadir el mensaje del usuario
            const userMessage = document.createElement('li');
            userMessage.className = 'd-flex justify-content-end mb-4';
            userMessage.innerHTML = `
                <div class="message-card user-message">
                    <p class="mb-0">${messageText}</p>
                    <span class="message-time text-muted small">Just now</span>
                </div>
            `;
            chatMessages.appendChild(userMessage);

            // Limpiar el área de texto
            messageInput.value = '';

            // Simular la respuesta del chatbot (esto debe ser reemplazado con la lógica real)
            setTimeout(() => {
                const botMessage = document.createElement('li');
                botMessage.className = 'd-flex justify-content-start mb-4';
                botMessage.innerHTML = `
                    <div class="message-card bot-message">
                        <p class="mb-0">Esta es una respuesta simulada de Sof.ia</p>
                        <span class="message-time text-muted small">Just now</span>
                    </div>
                `;
                chatMessages.appendChild(botMessage);

                // Scroll automático al final del chat
                const chatWindow = document.querySelector('.chat-window');
                chatWindow.scrollTop = chatWindow.scrollHeight;
            }, 1000);
        }
    });

    // Abrir y cerrar el drawer
    const drawerButton = document.getElementById('drawerButton');
    drawerButton.addEventListener('click', function() {
        document.body.classList.toggle('drawer-open');
    });

    // Cerrar el drawer al hacer clic en el fondo
    document.querySelector('.drawer-backdrop').addEventListener('click', function() {
        document.body.classList.remove('drawer-open');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Proyectos en Curso\ciudadgps\ciudadgps laravel\resources\views/public/chat/index.blade.php ENDPATH**/ ?>