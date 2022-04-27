@include('navigation_menu')

<section class="container mt-5 mb-5 row m-auto col-sm-12 col-md-10 justify-content-center">
    <div class="text-center">
        <p class="h4">
            Simule o preço da ligação
        </p>
    </div>
</section>

<section id="avaliable-plans">
    <div class="container mt-5 mb-5 row m-auto col-sm-12 col-md-10 justify-content-center">
        @foreach($callPlans as $callPlan)
            <div class="card m-2 cursor-pointer mt-5 mb-5 pt-5 pb-5" style="width: 18rem;">
                <div class="card-body d-flex flex-column justify-content-around">
                    <h5 class="card-title primary-color">
                        {{$callPlan->planName}}
                    </h5>
                    <p class="card-text">
                        Plano de ligações imperdível da Tenzir com {{$callPlan->planMinutes}} minutos.
                    </p>
                    <div class="form-check">
                        <input class="form-check-input callPlans-groupment" type="checkbox" data-callPlanId="{{$callPlan->id}}">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section id="call-price-simulator">
    <div class="container mt-5 mb-5">
        <div class="col-sm-10 col-md-8 m-auto">
            <div class="row justify-content-between">
                <div class="col-sm-10 col-md-5 mt-3 mb-3">
                    <label for="origin">
                        Código(DDD) de origem
                    </label>
                    {{ Form::select('originDDD', $currentDDDs, null, ['id' => 'origin', 'class' => 'form-control']) }}
                </div>
                <div class="col-sm-10 col-md-5 mt-3 mb-3">
                    <label for="destination">
                        Código(DDD) de destino
                    </label>
                    {{ Form::select('destinationDDD', array_reverse($currentDDDs), null, ['id' => 'destination', 'class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-sm-10 col-md-12 m-auto mt-3 mb-5">
                <label for="callTime">
                    Tempo da ligação <small>(em minutos)</small>
                </label>
                {{ Form::text('callTimeInMinutes', null, ['id' => 'callTime', 'class' => 'form-control', 'placeholder' => 'Ex: 2']) }}
            </div>
            <div>
                <a id="request-price-simulation" class="btn btn-success">
                    Calcular
                </a>
            </div>
        </div>
    </div>
    <div>
        <p id="simulation-result" class="h4"></p>
    </div>
</section>

@include('footer')

<script>
    // request the price simulation
    $('#request-price-simulation').on('click', function(){
        var origin      = $('#origin').find(":selected").text();
        var destination = $('#destination').find(":selected").text();
        var callTime    = $('#callTime').val();
        callTime = onlyNumbers(callTime);
        if(callTime == '' || callTime == 0){
            addMessageToToast('Informe o tempo da chamada');
            return;
        }
        var chosenPlan = $('.callPlans-groupment:checked');
        if(chosenPlan.length == 0){
            addMessageToToast('Escolha um plano de ligações');
            return;
        }
        var callPlanId = chosenPlan.attr('data-callPlanId');
        openLoader();
        $.ajax({
            url: "{{ \App\Models\URLHandler::viewLink('simulatecallprice') }}",
            method: 'POST',
            data: {origin: origin, destination: destination, callTime: callTime, callPlanId: callPlanId},
            dataType: 'JSON',
            success: function(result){
                if(result.success == true){
                    closeToast();
                    $('#simulation-result').text(result.value);
                }
            },
            failure: function(){
                addMessageToToast('Um erro ocorreu, tente novamente');
                return;
            },
            complete: function(){
                openLoader(true);
            }
        });
    });

    // formats the value entered on the callTime input field preventing non numeric values and inserting a word at the end
    $('#callTime').on('input', function(){
        var value = $(this).val();
        var formatedValue = onlyNumbers(value);
        formatedValue = (formatedValue != '' ?  formatedValue + ' Minutos' : formatedValue);
        $('#callTime').val(formatedValue);
    });

    // strips all non numeric characters from value sent
    function onlyNumbers(value){
        var formatedValue = value.replace(/\D/g, "");
        return formatedValue;
    }

    // handles click on card
    $('.card').on('click', function(){
        if($(this).hasClass('manually-clicked') == true){
            $(this).removeClass('manually-clicked');
            return;
        }
        $(this).addClass('manually-clicked');
        $(this).find('.callPlans-groupment').click();
    });

    // perform the management of the CallPlans checkbox and style
    $('.callPlans-groupment').on('click', function(){
        $('.callPlans-groupment').prop('checked', false);
        $('.callPlans-groupment').parents('.card').css('opacity', '0.5');
        $('.callPlans-groupment').parents('.card').find('.card-title').removeClass('primary-color');
        $(this).prop('checked', true);
        $(this).parents('.card').css('opacity', '1');
        $(this).parents('.card').find('.card-title').addClass('primary-color');
    });
</script>