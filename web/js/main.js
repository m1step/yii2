    /*$(function(){
        $("#upload_link").on('click', function(e){
            e.preventDefault();
            $("#upload:hidden").trigger('click');
        });
    });*/

    $(document).on('click', '.disabled-href', function (e) {
        e.preventDefault();
    });

    $(document).on("click", '.add-comment', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(".col-sm-12 form input#name").val();
        var email = $(".col-sm-12 form input#email").val();
        var text = $(".col-sm-12 form textarea").val();
        if(name.length === 0 || email.length === 0 || text.length === 0) {
            $().toastmessage('showErrorToast', "Заполните все поля");
        }else {
            $.ajax({
                url: "/product/add-comment",
                data: {id: id, name: name, email: email, text: text},
                type: "GET",
                success: function () {
                    $('.comment-form').remove();
                    $().toastmessage('showSuccessToast', "Комментарий добавлен");
                    $('#comments').prepend("<ul>" +
                        "<li><a href='' class='disabled-href'><i class='fa fa-user'></i>" + name + "</a></li>" +
                        "<li><a href='' class='disabled-href'><i class='fa fa-calendar-o'></i>Только что</a></li>" +
                        "</ul><p>" + text + "</p><br />");
                },
                error: function () {
                    $().toastmessage('showErrorToast', "Что-то пошло не так");
                }
            });
        }
    });


    $(document).on("click", '.delete_img', function (e) {
        e.preventDefault();
        var isTrue = confirm("Удалить изображение?");
        if(isTrue === true){
            var href = $(this).attr('href');
            $(this).parent('div').parent('div').remove();
            $.get(href);
        }
    });

    function showItems(items) {
        $('#items .modal-body').html(items);
        $('#items').modal();
    }

    $(document).on("click", ".list-group-item", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: "/profile/show-modal-items",
            data: {id: id},
            type: "GET",
            success: function (res) {
                if(!res) alert('Ошибка!');
                showItems(res);
            },
            error: function () {
                $().toastmessage('showErrorToast', "Что-то пошло не так");
            }
        });
    });

    $(document).on("click", ".add-to-list", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $(this).parent().html('<a href="#" class="remove-from-list" data-id=' + id + '><i class="fa fa-minus-square"></i>Удалить из списка желаний</a>');
        $.ajax({
            url: "/category/add-to-list",
            data: {id: id},
            type: "GET",
            success: function () {
                $().toastmessage('showSuccessToast', "Товар добавлен в список");
            },
            error: function () {
                $().toastmessage('showErrorToast', "Что-то пошло не так");
            }
        });
    });

    $(document).on("click", ".remove-from-list", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $(this).parent().html('<a href="#" class="add-to-list" data-id=' + id + '><i class="fa fa-plus-square"></i>Добавить в список желаний</a>');
        $.ajax({
            url: "/category/remove-from-list",
            data: {id: id},
            type: "GET",
            success: function () {
                $().toastmessage('showWarningToast', "Товар удален из списка");
            },
            error: function () {
                $().toastmessage('showErrorToast', "Что-то пошло не так");
            }
        });
    });

    $(document).on("click", ".remove-from-profile-list", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $(this).parent().parent().parent().parent().parent().parent().remove();
        $.ajax({
            url: "/category/remove-from-list",
            data: {id: id},
            type: "GET",
            success: function () {
                $().toastmessage('showWarningToast', "Товар удален из списка");
            },
            error: function () {
                $().toastmessage('showErrorToast', "Что-то пошло не так");
            }
        });
    });


    $(function() {
        $(".d1 input").focus(function(){
            $(this).animate({ width:"300px"}, 500);
        }).blur(function(){
            $(this).animate({ width:"250px"}, 500);
        });
    });

	 $('#sl2').slider();

	 $('.catalog').dcAccordion({
		 speed: 400
	 });

	 function showCart(cart) {
		 $('#cart .modal-body').html(cart);
		 $('#cart').modal();
     }


     $('#cart .modal-body').on('click', '.del-item', function () {
		var id = $(this).data('id');
         $.ajax({
             url: '/cart/del-item',
             data: {id: id},
             type: 'GET',
             success: function (res) {
                 if(!res) alert('Ошибка!');
                 showCart(res);
             },
             error: function () {
                 $().toastmessage('showErrorToast', "Что-то пошло не так");
             }
         });
     });

     $('#main').on('click', '.del-item-cart', function () {
         var id = $(this).data('id');
         $.ajax({
             url: '/cart/del-item-cart',
             data: {id: id},
             type: 'GET',
             success: function (res) {
                 if(!res) alert('Ошибка!');
                  $('#main').html(res);
                  $('#main').load();
             },
             error: function () {
                 $().toastmessage('showErrorToast', "Что-то пошло не так");
             }
         });
     });
	 
	 function getCart() {
         $.ajax({
             url: '/cart/show',
             type: 'GET',
             success: function (res) {
                 if (!res) alert('Ошибка!');
                 showCart(res);
             },
             error: function () {
                 $().toastmessage('showErrorToast', "Что-то пошло не так");
             }
         });
         return false;
     }
     
     function clearCart() {
         $.ajax({
             url: '/cart/clear',
             type: 'GET',
             success: function (res) {
                 if(!res) alert('Ошибка!');
                 showCart(res);
                 $('.modal-footer .btn-default').click();
             },
             error: function () {
                 $().toastmessage('showErrorToast', "Что-то пошло не так");
             }
         });
     }



	$('.add-to-cart').on('click', function (e) {
		e.preventDefault();
		var id = $(this).data('id'),
        qty = $('#qty').val();
		$.ajax({
			url: '/cart/add',
			data: {id: id, qty: qty},
			type: 'GET',
			success: function (res) {
				if(!res) alert('Ошибка!');
				showCart(res);
            },
			error: function () {
                $().toastmessage('showErrorToast', "Что-то пошло не так");
            }
		});
	});
	 

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 400, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});