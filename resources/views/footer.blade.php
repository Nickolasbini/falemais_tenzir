<footer id="footer" class="container-fluid pt-5 pb-5" style="background-color:rgba(184, 184, 184, 0.14)">
    <div class="row col-sm-10 col-md-12 m-auto d-flex justify-content-around">
        <div class="col-sm-10 col-md-3 mt-4-sm">
            <h2 class="primary-color h4">
                SOBRE
            </h2>
            <p class="text-left">
                Empresa de telefonia especializada em chamadas de longa distância nacional e referência do mercado Brasileiro. 
            </p>
        </div>
        <div class="col-sm-10 col-md-3 mt-4-sm">
            <h2 class="primary-color h4 text-center">
                NOS SIGA
            </h2>
            <div class="d-flex flex-column text-center">
                <a class="m-auto" href="https://api.whatsapp.com/send?text=olá&phone=41900000000" target="_blank">
                    <img class="responsible-icon mt-2 mb-2 cursor-pointer color-social-icon" data-name="whatsapp" src="{{ asset('images/whatsapp-gray.svg') }}" data-name="whatsapp" data-toggle="tooltip" data-placement="top" title="Abrir whatsApp">
                </a>
                <a class="m-auto" href="https://www.facebook.com" target="_blank">
                    <img class="responsible-icon mt-2 mb-2 cursor-pointer color-social-icon" data-name="facebook" src="{{ asset('images/facebook-gray.svg') }}" data-name="facebook" data-toggle="tooltip" data-placement="top" title="Ver página do Facebook">
                </a>
                <a class="m-auto" href="https://www.instagram.com" target="_blank">
                    <img class="responsible-icon mt-2 mb-2 cursor-pointer color-social-icon" data-name="instagram" src="{{ asset('images/instagram-gray.svg') }}" data-name="instagram" data-toggle="tooltip" data-placement="top" title="Ver perfil do instagram">
                </a>
            </div>
        </div>
        <div class="col-sm-10 col-md-3 mt-4-sm">
            <h2 class="primary-color h4">
                CONTATO
            </h2>
            <div>
                <em class="lead cursor-pointer" onclick="sendEmail()">
                    Por email
                </em>
            </div>
        </div>
    </div>
</footer>

<section id="company-data" class="container text-center p-4">
    <p class="">
        <a class="opacity-hover" href="{{ \App\Helpers\URLHandler::viewLink('termsofservice') }}">Termos de serviço</a>
        |
        <a class="opacity-hover" href="{{ \App\Helpers\URLHandler::viewLink('privacypolicy') }}">Política de privacidade</a>
        |
        <a class="opacity-hover" href="{{ \App\Helpers\URLHandler::viewLink('cookiespolicy') }}">Política de cookies</a>
    </p>
    <p class="h6 cursor-pointer opacity-hover">
        <a target="_blank" href="https://www.google.com" style="text-decoration:none;color:var(--bs-body-color)">
            © Copyright criador do site. 2022 - Todos os direitos reservados
        </a>
    </p>
</section>

<div class="fixed-bottom text-right me-4 mb-4">
    <a class="float-right border perfect-rounded p-2 btn btn-secondary" onclick="goTop()" style="border-radius: 100% !important; border: 1px solid #6c757d !important;">
        <img class="small-icon" src="{{ asset('images/arrow-up.svg') }}" alt="up icon">
    </a>
</div>

<script>
    $(document).ready(function(){
        checkFooterIcons();
    });

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
		}
	}

    function goTop(){
        $(document).scrollTop(0);
    }

    $('#footer .responsible-icon').mouseenter(function() {
            if(screenWidht < 760){
                return;
            }
			var name = $(this).attr('data-name');
			$(this).attr('src', '/images/'+ name + '.svg');
        })
        .mouseleave(function() {
            if(screenWidht < 760){
                return;
            }
            var name = $(this).attr('data-name');
			$(this).attr('src', '/images/'+ name + '-gray.svg');
    });

    function sendEmail(){
        var email = "nickolasbini@hotmail.com";
        var subject = 'Quero tirar uma dúvida';
        var emailBody = 'Olá ...';
        document.location = "mailto:"+email+"?subject="+subject+"&body="+emailBody;
    }
</script>