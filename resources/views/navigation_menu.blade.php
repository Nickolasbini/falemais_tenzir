@include('master_head')

<section id="home">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm navbar-light responsible responsible-navbar fixed-top w-100 pt-3 pb-3 d-flex justify-content-center border-b" style="z-index: 5; background: #fff">
        <div class="container-fluid row nav-bar-items">
            <div class="col-sm-2 d-flex dropdown-menu-button-wrapper justify-content-between">
                <a class="navbar-brand cursor-pointer" href="{{ \App\Helpers\URLHandler::viewLink('/') }}" data-toggle="tooltip" data-placement="top" title="Página inicial">
					<h5 class="primary-color mt-auto mb-auto">Fale Mais</span></h5></a>
                <button type="button" class="navbar-toggler float-right" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-sm-10">
                <div id="navbarCollapse" class="collapse navbar-collapse col">
                    <ul id="responsive-menu" class="nav navbar-nav col-sm-12 justify-content-end">
                        <li class="nav-item navbar-icon-wrapper p-3 clickAtA d-flex col-sm-10 col-md-3">
                            <a class="nav-link no-padding-t float-right list-option btn btn-dark opacity-hover h6 w-100" style="color:#fff" href="#plans">Nossos planos</a>
                        </li>
						<li class="nav-item navbar-icon-wrapper p-3 clickAtA d-flex col-sm-10 col-md-3">
                            <a class="nav-link no-padding-t float-right list-option btn btn-dark opacity-hover h6 w-100" style="color:#fff" href="#about">Sobre</a>
                        </li>
						<li class="nav-item navbar-icon-wrapper p-3 clickAtA d-flex col-sm-10 col-md-3">
                            <a class="nav-link no-padding-t float-right list-option btn btn-dark opacity-hover h6 w-100" style="color:#fff" href="#simulate">Simulação</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</section>

<script>
	$(document).ready(function(){
		handleResizes();
	});

    $('.clickAtA').on('click', function(){
        var urlToGo = $(this).find('a').attr('href');
        window.location.href = urlToGo;
    });

	var screenWidht = $(window).width();
	$(window).resize(function(){
		screenWidht = $(this).width();
		checkFooterIcons();
		handleResizes();
	});

	function handleResizes(){
        var marginTopValue = $('#home nav').height();
        marginTopValue = marginTopValue + (marginTopValue / 2); 
        if(screenWidht < 760){
			$('.list-options-menu').find('.navbar-icon').css('max-height', '50px');
            marginTopValue = marginTopValue + (marginTopValue / 2);
		}
        $('#home').css('margin-bottom', marginTopValue + 'px');
	}

	$('#dropdownMenuButton').on('click', function(){
		$('.dropdown-menu').toggle('oppened-dropdown');
	});

	$('.dropdown-item').on('click', function(){
		$('.dropdown-menu').toggle('oppened-dropdown');
	});
	
    $('.color-social-icon')
        .mouseenter(function() {
			var name = $(this).attr('data-name');
			$(this).attr('src', 'images/'+ name + '.svg');
        })
        .mouseleave(function() {
            var name = $(this).attr('data-name');
			$(this).attr('src', 'images/'+ name + '-gray.svg');
    });


	/* Ajax Area */
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

	$(document).on('click', '.followHref', function(){
		var hrefToGo = $(this).attr('data-href');
		window.location.href = hrefToGo;
	});

	$('.close-message').on('click', function(){
        if($(this).hasClass('custom-message-close-button') == true){
            $('#messages_wrapper').fadeOut();
        }else{
            $('#messages_wrapper').fadeOut();
            awaitAndRemove();
        }
    });

    function awaitAndRemove(){
        var myInterval = setInterval(function(){
            $('#viewMessager').remove();
            clearInterval(myInterval);
        }, 2000);
    }
</script>