$(document).ready(function(){  
    colorSuccess = '#1cc88a'  

    $("#checkAll").click(function(){
      $('.checkOne').not(this).prop('checked', this.checked);
    });

    $('.pagado').on('submit', function(e){
      if(confirm('Estás seguro(a) de ejecutar esta acción')){
          return true;
      }else{
          return false;
      }
    });

    $('.datatable').DataTable({
      "lengthMenu": [ [10, 25, 50, -1], ["10 Entradas", "25 Entradas", "50 Entradas", "Ver Todos"] ],
      "bSort": false,
      order: [[0, 'desc']],
      dom: 'Bfrtip',
      buttons: ['pageLength',
          {
              extend: 'copy',
              text: '<i class="far fa-copy"></i> Copiar Tabla',
              footer: true
          }, {
              extend: 'excel',
              text: '<i class="far fa-file-excel"></i> Descargar Excel',
              footer: true
          }, {
              extend: 'pdfHtml5',
              text: '<i class="far fa-file-pdf"></i> Descargar PDF',
              //orientation: 'landscape',
              //pageSize: 'LEGAL',
              footer: true
          }
      ],
      language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": '<i class="fas fa-angle-right"></i>',
              "previous": '<i class="fas fa-angle-left"></i>'
          }
      },
    });

    //Select2
    $('.select2').select2();
    $(".js-example-tags").select2({
      tags: true
    });

    //Alert success
    setTimeout(() => {
      $('.dimiss').fadeOut();
    }, 5000);


    ////////////////////////////////// Input Tel
    var phoneInput = document.getElementById("telephoneFormatted");
    if(phoneInput){
      var intlPhoneInput = window.intlTelInput(phoneInput, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      });

      function setPhoneInputData(){
        intlPhoneInput.setNumber($('#telephone_number').val())
        intlPhoneInput.setCountry($('#telephone_code').val()?.toLowerCase())
      }
  
      setPhoneInputData()
  
      function getPhoneInputData(){
        var countryCode = intlPhoneInput.getSelectedCountryData().iso2?.toUpperCase();
        var code = '+' + intlPhoneInput.getSelectedCountryData().dialCode;
        var number = phoneInput.value;
        var numberFormatted = code + number;
  
        return {numberFormatted, countryCode, code, number}
      }
  
      phoneInput.addEventListener('input', function(){
        var data = getPhoneInputData()
        $('#telephone_number_code').val(data.code);
        $('#telephone_code').val(data.countryCode);
        $('#telephone_number').val(data.number);
        $('#telephone').val(data.numberFormatted);
        intlPhoneInput.setNumber($('#telephone_number').val())
        intlPhoneInput.setCountry($('#telephone_code').val()?.toLowerCase())
      })
  
      phoneInput.addEventListener('countrychange', function(){
        var data = getPhoneInputData()
        $('#telephone_number_code').val(data.code);
        $('#telephone_code').val(data.countryCode);
        $('#telephone_number').val(data.number);
        $('#telephone').val(data.numberFormatted);
        intlPhoneInput.setNumber($('#telephone_number').val())
        intlPhoneInput.setCountry($('#telephone_code').val()?.toLowerCase())
      })
    }
 
    // ////////////////////////// Whatsapp
    var whatsapp = document.getElementById("whatsappFormatted");
    if(whatsapp){
      var intlWhatsapp = window.intlTelInput(whatsapp, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      });

      function setWhatsappData(){
        intlWhatsapp.setNumber($('#whatsapp_number').val())
        intlWhatsapp.setCountry($('#whatsapp_code').val()?.toLowerCase())
      }
  
      setWhatsappData()
  
      function getWhatsappData(){
        var countryCode = intlWhatsapp.getSelectedCountryData().iso2?.toUpperCase();
        var code = '+' + intlWhatsapp.getSelectedCountryData().dialCode;
        var number = whatsapp.value;
        var numberFormatted = code + number;
  
        return {numberFormatted, countryCode, code, number}
      }
  
      whatsapp.addEventListener('input', function(){
        var data = getWhatsappData()
        $('#whatsapp_number_code').val(data.code);
        $('#whatsapp_code').val(data.countryCode);
        $('#whatsapp_number').val(data.number);
        $('#whatsapp').val(data.numberFormatted);    
        intlWhatsapp.setNumber($('#whatsapp_number').val())
        intlPhoneInput.setCountry($('#whatsapp_code').val()?.toLowerCase())
      })
  
      whatsapp.addEventListener('countrychange', function(){
        var data = getWhatsappData()
        $('#whatsapp_number_code').val(data.code);
        $('#whatsapp_code').val(data.countryCode);
        $('#whatsapp_number').val(data.number);
        $('#whatsapp').val(data.numberFormatted);  
        intlWhatsapp.setNumber($('#whatsapp_number').val())
        intlPhoneInput.setCountry($('#whatsapp_code').val()?.toLowerCase())
      })
    }

    $('.iti').css('display', 'block');

    //DropZone
    $("div#dropzone").dropzone();


    //Edit Commerce Update
    $('#editCommerce').ajaxForm({
      uploadProgress: (event, position, total, percentComplete) => {
          Swal.fire({
              title: 'Procesando infomación, por favor espere...',
              allowEscapeKey: false,
              allowOutsideClick: false,
              showConfirmButton:false,
              showCancelButton:false,
              html: '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>'
          })
      },
      success: (data) => {
        if(data.message){
          return data.message && Swal.fire({icon:'success', title:data.message, confirmButtonText: "Listo", confirmButtonColor: colorSuccess})
        }
        return Swal.fire({icon:'error', title:'Ha ocurrido un error!', confirmButtonText: "Listo", confirmButtonColor: colorSuccess})
      },             
      error: (err) => {
        Swal.fire({icon:'error', title:'Ha ocurrido un error!', confirmButtonText: "Listo", confirmButtonColor: colorSuccess}) 
        console.log(err);
      },
    });

    //Store Commerce
    $('#storeCommerce').ajaxForm({
      uploadProgress: (event, position, total, percentComplete) => {
          Swal.fire({
              title: 'Procesando infomación, por favor espere...',
              allowEscapeKey: false,
              allowOutsideClick: false,
              showConfirmButton:false,
              showCancelButton:false,
              html: '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>'
          })
      },
      success: (data) => {
        $('#storeCommerce').fadeOut();
        $('#dropzone_container').fadeIn();
        $('#commerce_id').val(data.commerce.id);
        $('#continuar').attr('href', `/commerces/${data.commerce.id}/edit`);
        $('#name_commerce_created').html(data.commerce.name);
        $('#img_commerce_created').attr('src', data.commerce.logo);

        if(data.message){
          return data.message && Swal.fire({icon:'success', title:data.message, confirmButtonText: "Listo", confirmButtonColor: colorSuccess})
        }
        return Swal.fire({icon:'error', title:'Ha ocurrido un error!', confirmButtonText: "Listo", confirmButtonColor: colorSuccess})
      },             
      error: (err) => {
        Swal.fire({icon:'error', title:'Ha ocurrido un error!', confirmButtonText: "Listo", confirmButtonColor: colorSuccess}) 
        console.log(err);
      },
    });

    //Destroy Image
    $('.destroy-image').on('click', function(){
      var id = $(this).data('id');
      $('#image_id').val(id);
      $('#destroyImage').attr('action', `/imagesDestroy/${id}`);
    });

    $('#destroyImage').ajaxForm({
      uploadProgress: (event, position, total, percentComplete) => {
        Swal.fire({
            title: 'Procesando infomación, por favor espere...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            showConfirmButton:false,
            showCancelButton:false,
            html: '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>'
        })
    },
    success: (data) => {
      var id = $('#image_id').val()

      if(data.message){
        $('#destroyImage').modal('hide');
        $('.image' + id).css('display', 'none');
        return data.message && Swal.fire({icon:'success', title:data.message, confirmButtonText: "Listo", confirmButtonColor: colorSuccess})
      }
      return Swal.fire({icon:'error', title:'Ha ocurrido un error!', confirmButtonText: "Listo", confirmButtonColor: colorSuccess})
    },             
    error: (err) => {
      Swal.fire({icon:'error', title:'Ha ocurrido un error!', confirmButtonText: "Listo", confirmButtonColor: colorSuccess}) 
      console.log(err);
    },
  })

  function addToCartAlert (id) {
    Swal.fire({
      title: 'Añadir al Carrito',
      input: 'number',
      inputPlaceholder: 'Cantidad...',
      inputAttributes: {min: 1},
      confirmButtonText:'<i class="fas fa-shopping-cart"></i> Añadir al Carrito',
      confirmButtonColor: "#FF6000",
    }).then((qty) => {
      $.ajax({
        headers:{
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        url:'/addToCart',
        type:'POST',
        data:{ id, qty: qty.value },
        success:function(data){
          Swal.fire({
            icon: 'success',
            text: 'Producto agregado con éxito!',
            confirmButtonText: '<a style="color:#ffffff;" href="/carrito-de-compras">Procesar Orden</a>',
            showCancelButton:true,
            cancelButtonColor:'#343a40',
            cancelButtonText: "Continuar Comprando",
          }); 
          $('#commerceId').val(data.commerceId)
          $('#whatsappCheckout').val(data.whatsapp)

          var $count = data.count;
          $('.cart_count').html($count);
  
          var cart_subtotal = '$' + new Intl.NumberFormat().format(data.cart_subtotal);
          $('.cart_price').html(cart_subtotal);
          $('.amount').html(cart_subtotal);
          $('.cart_list').html('')
          
          data.items.map((item) => {
            $('.cart_list').append(`<li>\
                  <a href="#"><img src="${item.options['img']}" alt="${item.title}">${item.title}</a>\
                  <span class="cart_quantity">${item.quantity} x <span class="cart_amount">${'$' + item.price}</span>\
              </li>`);
          })
        },
      });
    })
  }

  $('.addToCart').on('click', function(){
    let id = $(this).data('id')
    let commerceId = $('#commerceId').val()
    let productCommerceId = $(this).data('commerce')
    
    if(commerceId){
      if(productCommerceId != commerceId){
        return Swal.fire({
          title: 'Tienes una orden en proceso',
          text: 'Al aceptar, estás eliminando el carrito de compras creado en el comercio anterior',
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: `Cancelar`,
        }).then((result) => {
          if (result.isConfirmed) {
            addToCartAlert(id)
          } 
        })
      }
    }
    return addToCartAlert(id)
  })

  $('.deleteCartItem').on('click', function() {
    let hash = $(this).data('hash')
    $.ajax({
      headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url:'/deleteCartItem',
      type:'POST',
      data:{ hash },
      success:function(data){
          Swal.fire({
            icon: 'success',
            text: 'Producto eliminado con éxito!'
          }); 

          var $count = data.count;
          $('.cart_count').html($count);
  
          var cart_subtotal = '$' + new Intl.NumberFormat().format(data.cart_subtotal);
          $('.cart_price').html(cart_subtotal);
          $('.amount').html(cart_subtotal);

          $('.cart_list').html('')
          
            data.items.map((item) => {
            $('.cart_list').append(`<li>\
                    <a href="#"><img src="${item.options['img']}" alt="${item.title}">${item.title}</a>\
                    <span class="cart_quantity">${item.quantity} x <span class="cart_amount">${'$' + item.price}</span>\
                </li>`);
            })

            $('#tr' + hash).remove()
            $('.cart_subtotal_amount').html('$' + data.cart_subtotal);
            $('.cart_total_amount').html('$' + data.cart_total);
        }
    })
  })

  $('.updateCartItem').on('click',function(){
    var hash = $(this).data('hash');
    var qty = $('#qty-input' + hash).val();

    Swal.fire({
      title: 'Modificar Producto',
      input: 'number',
      inputPlaceholder: 'Cantidad...',
      inputValue: qty,
      inputAttributes: {min: 1},
      confirmButtonText:'<i class="fas fa-shopping-cart"></i> Añadir al Carrito',
      confirmButtonColor: "#DD6B55",
    }).then((qty) => {
      $.ajax({
        headers:{
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        url:'/updateCartItem',
        type:'POST',
        data:{hash, quantity: qty.value},
        success:function(data){
          if(data.error){
            Swal.fire({
              icon: 'error',
              text: 'Disculpe, cantidad solicitada excede el inventario disponible.',
            }); 
          }else {
            let {count, cart_subtotal, cart_total, items, updatedItemQuantity, updatedItemPrice} = data
            $('.cart_count').html(count);
            $('.cart_subtotal').html('$' + cart_subtotal);
            $('.cart_subtotal_amount').html('$' + cart_subtotal)
            $('.cart_total_amount').html('$' + cart_total);

            $('.cart_list').html('')
          
            items.map((item) => {
            $('.cart_list').append(`<li>\
                    <a href="#"><img src="${item.options['img']}" alt="${item.title}">${item.title}</a>\
                    <span class="cart_quantity">${item.quantity} x <span class="cart_amount">${'$' + item.price}</span>\
                </li>`);
            })

            $('.product-quantity-' + hash).html(updatedItemQuantity)
            $('#qty-input' + hash).val(updatedItemQuantity)
            $('.product-subtotal-' + hash).html('$' + updatedItemPrice.toFixed(2))

            Swal.fire({
              icon: 'success',
              text: 'Producto modifcado con éxito!',
            }); 
          }
        },
      });
    });
  });

  $('#whatsappCheckout').on('click', function(){
    var cart = Object.values(JSON.parse($('#datosCarrito').val()))
    var whatsapp = $('#wsInput').val()
    var name = $('#checkoutName').val()
    var ci = $('#checkoutCedula').val()
    var cel = $('#checkoutCel').val()
    var address = $('#checkoutAddress').val()
    var city = $('#checkoutCity').val()
    var email = $('#checkoutEmail').val()
    var info = $('#checkoutNotes').val()
    var total = parseFloat($('#checkoutSubtotal').val()).toLocaleString('es-ES', { style: 'currency', currency: 'USD' })
    var totalQty = 0
    var items = ''
    cart.map((item) => {
      totalQty += parseInt(item.quantity)
      let price = parseFloat(item.price).toLocaleString('es-ES', { style: 'currency', currency: 'USD' });
      let subtotal = parseFloat(item.subtotal).toLocaleString('es-ES', { style: 'currency', currency: 'USD' });
      items += `----------------------------------%0A%2A${item.title}%2A%0A${item.quantity}+x+%24${price}+%3D+%24${subtotal}%0A`
    })
    let ws = `https://api.whatsapp.com/send?phone=${whatsapp}`
    let checkoutData = `&text=%2AORDEN+POR+CIUDADGPS:%2A%0A----------------------------------%0A%2ADATOS+DEL+CLIENTE%2A%0A----------------------------------%0A%2ACédula+%2F+RIF:%2A+${ci}%0A%2ANombre:%2A+${name}%0A%2ATeléfono:%2A+${cel}%0A%2ACorreo+Electrónico:%2A+${email}%0A%2ADirección:%2A+${address}%0A%2ACiudad:%2A+${city}%0A----------------------------------%0A%2ACARRITO+DE+COMPRAS%2A%0A${items}%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%0A%2AUnidades%3A%2A+${totalQty}%0A%2ATotal%3A%2A+%24${total}%0A%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%0A----------------------------------%0A%2ANOTAS+ADICIONALES%2A%0A----------------------------------%0A${info}%0A&app_absent=0`
    let url = ws + checkoutData
    window.open(url, '_blank');
  })

}); 
