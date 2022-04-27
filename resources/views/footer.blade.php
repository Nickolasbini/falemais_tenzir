<footer id="footer" class="container-fluid pt-5 pb-5" style="background-color:rgba(184, 184, 184, 0.14)">
    <div class="row col-sm-10 col-md-12 m-auto d-flex justify-content-around">
        <div class="col-sm-10 col-md-3 mt-4-sm">
            <h2 class="primary-color h4">
                SOBRE
            </h2>
            <p class="text-left">
                Somos a Tenzir...
            </p>
        </div>
        <div class="col-sm-10 col-md-3 mt-4-sm">
            <h2 class="primary-color h4 text-center">
                NOS SIGA
            </h2>
            <div class="d-flex flex-column text-center">
                <a class="m-auto" href="https://api.whatsapp.com/send?text=olá&phone=41984320432" target="_blank">
                    <img class="responsible-icon mt-2 mb-2 cursor-pointer color-social-icon" data-name="whatsapp" src="{{ asset('images/whatsapp-gray.svg') }}" data-name="whatsapp" data-toggle="tooltip" data-placement="top" title="Abrir whatsApp">
                </a>
                <a class="m-auto" href="https://www.facebook.com" target="_blank">
                    <img class="responsible-icon mt-2 mb-2 cursor-pointer color-social-icon" data-name="facebook" src="{{ asset('images/facebook-gray.svg') }}" data-name="facebook" data-toggle="tooltip" data-placement="top" title="Ver página do Facebook">
                </a>
                <a class="m-auto" href="https://www.instagram.com.br" target="_blank">
                    <img class="responsible-icon mt-2 mb-2 cursor-pointer color-social-icon" data-name="instagram" src="{{ asset('images/instagram-gray.svg') }}" data-name="instagram" data-toggle="tooltip" data-placement="top" title="Ver perfil do instagram">
                </a>
            </div>
        </div>
        <div class="col-sm-10 col-md-3 mt-4-sm">
            <h2 class="primary-color h4">
                CONTATO
            </h2>
            <div>
                <em class="lead SendEmail cursor-pointer" data-toggle="tooltip" data-placement="top" title="Enviar email">
                    Por email
                </em>
            </div>
        </div>
    </div>
</footer>

<section id="company-data" class="container text-center p-4">
    <p class="">
        <a class="opacity-hover" href="{{ \App\Models\URLHandler::viewLink('termsofservice') }}">Termos de serviço</a>
        |
        <a class="opacity-hover" href="{{ \App\Models\URLHandler::viewLink('privacypolicy') }}">Política de privacidade</a>
        |
        <a class="opacity-hover" href="{{ \App\Models\URLHandler::viewLink('cookiespolicy') }}">Política de cookies</a>
    </p>
    <p class="h6 cursor-pointer opacity-hover">
        <a target="_blank" href="https://www.cervodigital.com.br" style="text-decoration:none;color:var(--bs-body-color)">
            © Copyright agência cervo digital. 2021 - Todos os direitos reservados
        </a>
    </p>
</section>

<script>
    function checkFooterIcons(){
		if(screenWidht < 760){
			$('.color-social-icon').off('mouseenter');
			$('.color-social-icon').off('mouseleave');
			$('footer').css('text-align', 'center');
			var socialMediaIcons = $('.color-social-icon');
			socialMediaIcons.each(function(){
				var name = $(this).attr('data-name');
				$(this).attr('src', '/images/'+ name + '.svg');
			});
		}else{
            
        }
	}
	checkFooterIcons();
</script>