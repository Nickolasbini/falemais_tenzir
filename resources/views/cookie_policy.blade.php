@include('navigation_menu')

<section class="mt-5 mb-5 container text-center-sm">

    <h2 class="mt-3 primary-color text-center">Política de Cookies</h2>

    A presente Política de Cookies é um documento complementar à Política de Privacidade da <em class="primary-color">{{env('APP_NAME')}}</em>, disponível neste link: <a href="{{\App\Models\URLHandler::viewLink('privacypolicy')}}">Política de privacidade</a>. Aqui, você encontrará informações objetivas e claras sobre o que são Cookies, quais Cookies utilizamos em nossas aplicações, qual papel desempenham e como configurá-los.
    <h4 class="mt-5 primary-color text-center">1. O que são Cookies?</h4>

    Cookies são pequenos arquivos de texto ou fragmentos de informação que são baixados em seu computador, smartphone ou qualquer outro dispositivo com acesso à internet quando você visita nossa aplicação.

    Eles contêm informações sobre a sua navegação em nossas páginas e retêm apenas informações relacionadas a suas preferências. 

    Assim, essa página consegue armazenar e recuperar os dados sobre os seus hábitos de navegação, de forma a melhorar a experiência de uso, por exemplo. É importante frisar que eles não contêm informações pessoais específicas, como dados sensíveis ou bancários.

    O seu navegador armazena os cookies no disco rígido, mas ocupam um espaço de memória mínimo, que não afetam o desempenho do seu computador. A maioria das informações são apagadas logo ao encerrar a sessão, como você verá no próximo tópico.
    <h4 class="mt-5 primary-color text-center">1.1. Tipos de Cookies</h4>

    <h6 class="h5 primary-color">Os cookies, quanto a seus proprietários, podem ser:</h6>

        <p class="ps-3">Cookies proprietários: são cookies definidos por nós</p>

    <h6 class="h5 primary-color">Os cookies, quanto ao seu tempo de vida, podem ser:</h6>

        <p class="ps-3">Cookies de sessão ou temporários: são cookies que expiram assim que você fecha o seu navegador, encerrando a sessão.</p>
        <p class="ps-3">Cookies persistentes ou permanentes: são cookies que permanecem no seu dispositivo durante um período determinado ou até que você os exclua.</p>

    <h6 class="h5 primary-color">Os cookies, quanto a sua finalidade, podem ser:</h6>

        <p class="ps-3">Cookies necessários: são cookies essenciais que possibilitam a navegação em nossas aplicações e o acesso a todos os recursos; se estes, nossos serviços podem apresentar mal desempenho ou não funcionar.</p>
        <p class="ps-3">Cookies de desempenho: são cookies que otimizam a forma que nossas aplicações funcionam, coletando informações anônimas sobre as páginas acessadas.</p>
        <p class="ps-3">Cookies de funcionalidade: são cookies que memorizam suas preferências e escolhas (como seu nome de usuário)</p>
        <p class="ps-3">Cookies de publicidade: são cookies que direcionam anúncios em função dos seus interesses e limitam a quantidade de vezes que o anúncio aparece.</p>

    <h4 class="mt-5 primary-color text-center">2. Por que usamos Cookies?</h4>

    A <em class="primary-color">{{env('APP_NAME')}}</em> utiliza Cookies para fornecer a melhor experiência de uso, tornando nossas aplicações mais fáceis e personalizadas, tendo por base suas escolhas e comportamento de navegação.

    Assim, buscamos entender como você utiliza nossas aplicações e ajustar o conteúdo para torná-lo mais relevante para você, além de lembrar de suas preferências.

    Os Cookies participam deste processo porquanto armazenam, leem e executam os dados necessários para cumprir com o nosso objetivo.
    <h4 class="mt-5 primary-color text-center">3. Que tipo de Cookies utilizamos?</h4>

    Abaixo listamos todos os Cookies que podem ser utilizados pela <em class="primary-color">{{env('APP_NAME')}}</em>. É importante lembrar que você pode gerenciar a permissão concedida para cada Cookie em seu navegador.

    Além disso, uma vez que os Cookies capturam dados sobre você, aconselhamos a leitura de nossa Política de Privacidade, disponível neste link <a href="{{\App\Models\URLHandler::viewLink('privacypolicy')}}">Política de privacidade</a>.
    
    <h4 class="mt-5 primary-color text-center">4. Gerenciamento dos Cookies</h4>

    A instalação dos cookies está sujeita ao seu consentimento. Apesar da maioria dos navegadores estar inicialmente configurada para aceitar cookies de forma automática, você pode rever suas permissões a qualquer tempo, de forma a bloqueá-los, aceitá-los ou ativar notificações para quando alguns cookies forem enviados ao seu dispositivo. 

    Atualmente, na primeira vez que você acessa nossas aplicações, será requerida a sua concordância com a instalação destes. Apenas após a sua aceitação eles serão ativados.

    Para tanto, utilizamos um sistema de popout na página inicial de <em class="primary-color">{{env('APP_NAME')}}</em>. Dessa maneira, não apenas solicitamos sua concordância, mas também informamos que a navegação continuada em nossos sites será entendida como consentimento. 

    Como já dito, você pode, a qualquer tempo e sem nenhum custo, alterar as permissões, bloquear ou recusar os Cookies. Você também pode configurá-los caso a caso. Todavia, a revogação do consentimento de determinados Cookies pode inviabilizar o funcionamento correto de alguns recursos da plataforma.

    Para gerenciar os cookies do seu navegador, basta fazê-lo diretamente nas configurações do navegador, na área de gestão de Cookies.

    <h4 class="mt-5 primary-color text-center">5. Disposições finais</h4>

    Para a (nome empresarial), a privacidade e confiança são fundamentais para a nossa relação com você. Estamos sempre nos atualizando para manter os mais altos padrões de segurança 

    Assim, reservamo-nos o direito de alterar esta Política de Cookies a qualquer tempo. As mudanças entrarão em vigor logo após a publicação, e você será avisado.

    Ao continuar a navegação nas nossas aplicações após essa mudança se tornar eficaz, você concorda com elas. Aconselhamos que você sempre verifique esta Política, bem como a nossa Política de Privacidade.

    Em caso de dúvidas sobre esta Política de Cookies, entre em contato conosco pelos seguintes meios:

    <div class="container d-flex flex-column justify-content-center text-center mt-5 mb-5">
        <a class="m-auto mt-3 mb-3" href="https://api.whatsapp.com/send?text=olá&phone=41983420432" target="_blank">
            <img class="responsible-icon mt-2 mb-2 cursor-pointer color-social-icon" src="{{ asset('images/whatsapp-gray.svg') }}">
        </a>
        <a class="mt-3 mb-3 opacity-hover" onclick="sendTheEmail()">nickolasbini@hotmail.com</a>
    </div>

    Esta Política de Cookies foi atualizada pela última vez: 27/04/2022.

</section>

@include('footer')