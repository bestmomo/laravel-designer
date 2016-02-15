/*!
 * Start Bootstrap - Creative Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Fit Text Plugin for Main Header
    $("h1").fitText(
        1.2, {
            minFontSize: '35px',
            maxFontSize: '65px'
        }
    );

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

})(jQuery); // End of use strict

$(function(){
  
    $("input[type='checkbox'][name='lsd']").prop('checked', false );
    $("input[type='checkbox'][name='langs']").prop('checked', false );

    $('li>a, .navbar-brand, #togo').on('click', function(e) {
        e.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
          scrollTop: $(this.hash).offset().top
        }, 1000, function(){
          window.location.hash = hash;
        });
    });

    $("input[type='checkbox'][name='lsd']").change(function(e) {
        $('#lsdcontent').toggleClass('hidden');
    });

    $("input[type='checkbox'][name='langs']").change(function(e) {
        $('#langcontent').toggleClass('hidden');
    });

    $('#formmaker').submit(function(e) {  
        e.preventDefault();

        $('#submit').html('<span class="fa fa-spinner fa-pulse fa-5x"></span>');
         
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function(data){
                $('#submit').html('<a href="' + data.url + '" class="btn btn-primary btn-xl">It\'s ready, get it !</a>');
                $('#final').removeClass('hidden');                
            },
            statusCode: {
                500: function() {
                    $('#submit').html('<div class="alert alert-danger" role="alert">Sorry but something doesn\'t work. Try again later.</div>');
                },
                422: function(data) {
                    $.each(data.responseJSON, function (key, value) {
                        $('#urllsd' + '+small').text(value);
                        $('#urllsd').parent().addClass('has-error');
                        $('#submit').html('<input class="btn btn-default btn-xl" type="submit" value="make your own !">');
                    });  
                }
            }
        });
    });

    $(document).on('submit', '#formcontact', function(e) {  
        e.preventDefault();
         
        $('input+small').text('');
        $('input').parent().removeClass('has-error');
        $('textarea+small').text('');
        $('textarea').parent().removeClass('has-error');
         
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        })
        .done(function(data) {
            $('.alert-success').removeClass('hidden');
            $('#contactForm').modal('hide');
        })
        .fail(function(data) {
            $.each(data.responseJSON, function (key, value) {
                if(key == 'email') {
                    type = 'input'
                } else {
                    type = 'textarea';
                }
                var input = '#formcontact ' + type + '[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');
            });
        });
    });

});
