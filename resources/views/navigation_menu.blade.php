@include('master_head')

<section id="top-section-homepage">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-sm navbar-light responsible responsible-navbar sticky-top w-100 pt-3 pb-3" style="z-index: 5;">
        <div class="container-fluid row nav-bar-items">
            <div class="col-sm-2 d-flex dropdown-menu-button-wrapper">
                <a class="navbar-brand" href="{{ \App\Models\URLHandler::viewLink('/') }}" data-toggle="tooltip" data-placement="top" title="Página inicial">
					<h5 class="primary-color">Fale Mais</span></h5></a>
                <button type="button" class="navbar-toggler float-right" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-sm-10">
                <div id="navbarCollapse" class="collapse navbar-collapse col">
                    <ul id="responsive-menu" class="nav navbar-nav col-sm-9 justify-content-center">
                        <li class="nav-item navbar-icon-wrapper list-options-menu p-3 d-flex" data-dropdown="true">
                            <img class="navbar-icon float-left" src="{{ asset('images/read-icon.webp') }}">
							<div class="dropdown mt-auto mb-auto ps-2" id="drop">
								<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: rgba(0, 0, 0, 0.55)">
								  	Ler
								</button>
								<div class="dropdown-menu clickAtA" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="{{ \App\Models\URLHandler::viewLink('history/list?filter=all') }}">Todos</a>
								    <a class="dropdown-item" href="{{ \App\Models\URLHandler::viewLink('history/list?filter=bestRated') }}">Mais votados</a>
								    <a class="dropdown-item" href="{{ \App\Models\URLHandler::viewLink('history/list?filter=ongoing') }}">Inacabados</a>
									<a class="dropdown-item" href="{{ \App\Models\URLHandler::viewLink('history/list?filter=finished') }}">Finalizados</a>
								    <a class="dropdown-item" href="{{ \App\Models\URLHandler::viewLink('history/list?filter=latest') }}">Novos lançamentos</a>
								    <a class="dropdown-item" href="{{ \App\Models\URLHandler::viewLink('history/list?filter=random') }}">Me surpreenda</a>
								    <a class="dropdown-item" href="{{ \App\Models\URLHandler::viewLink('history/list?filter=popular') }}">Populares</a>
								</div>
							</div>
                        </li>
                        <li class="nav-item navbar-icon-wrapper p-3 clickAtA" data-toggle="tooltip" data-placement="top" title="Escrever uma história">
                            <img class="navbar-icon float-left" src="{{ asset('images/write-icon.webp') }}">
                            <a class="nav-link no-padding-t float-right" href="{{ \App\Models\URLHandler::viewLink('history/create') }}">Escrever</a>
                        </li>
                        <li class="nav-item navbar-icon-wrapper p-3 clickAtA" data-toggle="tooltip" data-placement="top" title="Ver gêneros">
                            <img class="navbar-icon float-left" src="{{ asset('images/category-icon.webp') }}">
                            <a class="nav-link no-padding-t float-right" href="{{ \App\Models\URLHandler::viewLink('category/list') }}">Gêneros</a>
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

    // hover effect by jQuery
	$('.list-options-menu').hover(
		// hover in
		function () {
			var imgTag = $(this).find('img');
			var aTag = $(this).find('a');
			imgTag.css('opacity', '0.5');
			aTag.css('color', 'orange');
			if($(this).attr('data-dropdown') == 'true'){
				$('#dropdownMenuButton').click();
			}
		},
		// hover out
		function () {
			var imgTag = $(this).find('img');
			var aTag = $(this).find('a');
			imgTag.css('opacity', '1');
			aTag.css('color', 'rgba(0, 0, 0, 0.55)');
			if($(this).attr('data-dropdown') == 'true'){
				$('#dropdownMenuButton').click();
			}
		}
	);

	var screenWidht = $(window).width();
	$(window).resize(function(){
		screenWidht = $(this).width();
		checkFooterIcons();
		handleResizes();
	});

	function handleResizes(){
        var marginTopValue = $('#top-section-homepage nav').height();
        marginTopValue = marginTopValue + (marginTopValue / 2); 
        if(screenWidht < 760){
			$('.list-options-menu').find('.navbar-icon').css('max-height', '50px');
            marginTopValue = marginTopValue + (marginTopValue / 3);
		}
        $('#top-section-homepage').css('margin-bottom', marginTopValue + 'px');
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