@extends('layouts.public')
@section('title')
<title>CiudadGPS - Chatea con SofIA</title>
<meta name="description" content="Descubre la IA de CiudadGPS, Sofia, ayuda a nuestros usuarios a encontrar comercios cercanos a su ubicación y te da sugerencias según lo que necesites" />
<meta name="keywords" content="Inteligencia artificial, ia, ciudadgps, comercios">
@include('public.chat.style')
@endsection
@section('content')
@php
    function formatMessageWithBoldAndLinks($text)
    {
        // Reemplazar **texto** con <strong>texto</strong>
        $formattedText = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);

        // Reemplazar URLs que comienzan con https con un enlace
        $formattedText = preg_replace('/(https:\/\/[^\s]+)/', '<a href="$1" target="_blank">$1</a>', $formattedText);

        // Reemplazar * con un salto de línea
        $formattedText = preg_replace('/\* /', '<br> ', $formattedText);

        return $formattedText;
    } 
@endphp
<div class="section pt-3" style="background-color:#e9edef;">
    <div class="container-fluid contenedor">
        <div class="row px-lg-2">
            <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                <div class="drawer-menu shadow" style="border-radius: 10px;">
                    <div class="card border-0" style="border-radius: 10px; height: 60vh; overflow-y: auto;">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3">Conversaciones</h5>
                            <ul class="list-unstyled mb-0">
                                @forelse($conversations as $conv)
                                <li class="border-bottom">
                                    <a href="{{ url('conversations/' . $conv->id. '/show') }}" class="d-flex justify-content-between px-2 align-items-center">
                                        <div class="d-flex flex-row">
                                            <div class="pt-1">
                                                <p class="small text-muted">
                                                    {{$conv->title}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p class="small text-muted mb-1">{{ $conv->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                                @empty
                                <li class="border-bottom">
                                    <a href="javascript:void(0)" class="d-flex justify-content-between px-2 align-items-center">
                                        <div class="d-flex flex-row">
                                            <div class="pt-1">
                                                <p class="small text-muted">
                                                    <i class="fas fa-comment-dots mr-1"></i> Aún no has abierto una conversación
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforelse

                                <!-- Más elementos de conversación -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="drawer-backdrop"></div>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="chat-container shadow" style="border-radius: 10px; background-image: url({{ asset('chatbg.jpg') }});">
                    <div class="card border-0" style="border-radius: 10px;">
                        <div class="card-body d-flex justify-content-between align-items-center py-3">
                            <h6 class="font-weight-bold mb-0" id="titleChat">{{isset($conversation) ? $conversation->title : 'Chatea con SofIA'}}</h6>
                            <a href="javascript:void(0)" class="d-md-none" id="drawerButton">
                                <i class="ion-android-menu" style="font-size: 20px;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="chat-window" style="max-height: 65vh; overflow-y: auto; border-radius: 8px; padding: 16px;">
                        <ul class="list-unstyled mb-0" id="chatMessages">

                            @if(isset($conversation))
                                @foreach($conversation->messages as $message)
                                <li class="d-flex {{ $message->is_user ? 'justify-content-end' : 'justify-content-start' }} mb-4">
                                    <div class="message-card {{ $message->is_user ? 'user-message' : 'bot-message' }}">
                                        <h6 class="text-{{ $message->is_user ? 'success' : 'secondary' }}">{{ $message->is_user ? 'Tú' : 'SofIA' }}:</h6>
                                        <p class="mb-0">{!! formatMessageWithBoldAndLinks($message->content) !!}</p>
                                        <span class="message-time text-muted small">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </li>
                                @endforeach
                            @else
                            <li class="d-flex justify-content-start mb-4">
                                <div class="message-card bot-message">
                                    <h6 class="text-secondary">SofIA:</h6>
                                    <p class="mb-0">Hola, soy SofIA, tu asistente IA de CiudadGPS. Estoy aquí para proporcionarte información relevante sobre servicios y establecimientos comerciales. ¿En qué puedo ayudarte hoy?</p>
                                    <span class="message-time text-muted small">Justo ahora</span>
                                </div>
                            </li>
                            @endif


                        </ul>
                    </div>
                    <div class="input-group shadow border-0" style="border-radius: 10px">
                        <input type="hidden" name="conversationId" id="conversationId" value="{{ isset($conversation) ? $conversation->id : '' }}">
                        <input class="form-control border-0" id="messageInput" placeholder="Escribe tu Mensaje...">
                        <button type="button" id="sendButton" class="btn btn-fill-out rounded-0">
                            <span id="buttonText"><i class="fas fa-paper-plane"></i> Enviar</span>
                            <span id="spinner" style="display: none;"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>                                                          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('map')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
moment.locale('es');
document.getElementById('sendButton').addEventListener('click', function() {
    sendMessage();
});

document.getElementById('messageInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
});


function updateConversationList(conversations) {
    const conversationList = document.querySelector('.drawer-menu ul');
    let newConversationList = "";

    conversations.forEach((conversation) => {
        const conversationItem = `
            <li class="border-bottom">
                <a href="{{ url('conversations/${conversation.id}/show') }}" class="d-flex justify-content-between px-2 align-items-center">
                    <div class="d-flex flex-row">
                        <div class="pt-1">
                            <p class="small text-muted">
                                ${conversation.title}
                            </p>
                        </div>
                    </div>
                    <div class="pt-1">
                        <p class="small text-muted mb-1">${moment(conversation.created_at).fromNow()}</p>
                    </div>
                </a>
            </li>
        `;
        newConversationList += conversationItem;
    });

    conversationList.innerHTML = newConversationList;
}




function formatMessageWithBoldAndLinks(text) {
    // Reemplazar **texto** con <strong>texto</strong>
    let formattedText = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

    // Reemplazar URLs que comienzan con https con un enlace
    formattedText = formattedText.replace(/(https:\/\/[^\s]+)/g, '<a href="$1" target="_blank">$1</a>');

    // Reemplazar * con un salto de línea
    formattedText = formattedText.replace(/\* /g, '<br> ');

    return formattedText;
}


// Ejemplo de uso en tu función sendMessage
function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const conversationId = document.getElementById('conversationId').value;
    const messageText = messageInput.value;
    const sendButton = document.getElementById('sendButton');
    const buttonText = document.getElementById('buttonText');
    const spinner = document.getElementById('spinner');

    console.log(conversationId)

    if (messageText.trim() !== '') {
        const chatMessages = document.getElementById('chatMessages');

        // Añadir el mensaje del usuario
        const userMessage = document.createElement('li');
        userMessage.className = 'd-flex justify-content-end mb-4';
        userMessage.innerHTML = `
            <div class="message-card user-message">
                <h6 class="text-success">Tú:</h6>
                <p class="mb-0">${formatMessageWithBoldAndLinks(messageText)}</p>
                <span class="message-time text-muted small">Justo ahora</span>
            </div>
        `;
        chatMessages.appendChild(userMessage);

        // Limpiar el área de texto y mostrar el spinner en el botón
        messageInput.value = '';
        sendButton.disabled = true;
        messageInput.disabled = true;
        buttonText.style.display = 'none';
        spinner.style.display = 'inline-block';

        // Enviar el mensaje al backend
        fetch('/handleChatRequest', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                message: messageText, 
                conversation_id: conversationId 
            })
        })
        .then(response => response.json())
        .then(data => {
            const botMessage = document.createElement('li');
            botMessage.className = 'd-flex justify-content-start mb-4';
            botMessage.innerHTML = `
                <div class="message-card bot-message">
                    <h6 class="text-secondary">SofIA:</h6>
                    <p class="mb-0">${formatMessageWithBoldAndLinks(data.response)}</p>
                    <span class="message-time text-muted small">Just now</span>
                </div>
            `;
            chatMessages.appendChild(botMessage);

            // Scroll automático al final del chat
            const chatWindow = document.querySelector('.chat-window');
            chatWindow.scrollTop = chatWindow.scrollHeight;

            // Ocultar el spinner y habilitar el input y el botón
            sendButton.disabled = false;
            messageInput.disabled = false;
            buttonText.style.display = 'inline-block';
            spinner.style.display = 'none';

            //Titulo de la conversacion
            $('#titleChat').html(data?.conversation?.title);
            $('#conversationId').val(data?.conversation?.id);
            updateConversationList(data?.conversations)
        })
        .catch(error => {
            console.log(error);

            const errorMessage = document.createElement('li');
            errorMessage.className = 'd-flex justify-content-start mb-4';
            errorMessage.innerHTML = `
                <div class="message-card bot-message">
                    <h6 class="text-danger">Error:</h6>
                    <p class="mb-0">Hubo un problema al enviar tu mensaje. Por favor, intenta de nuevo.</p>
                    <span class="message-time text-muted small">Just now</span>
                </div>
            `;
            chatMessages.appendChild(errorMessage);

            // Ocultar el spinner y habilitar el input y el botón
            sendButton.disabled = false;
            messageInput.disabled = false;
            buttonText.style.display = 'inline-block';
            spinner.style.display = 'none';
        });
    }
}

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
@endsection
