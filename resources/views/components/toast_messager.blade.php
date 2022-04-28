<div aria-live="polite" aria-atomic="true">
    <div id="main-toast" class="toast mt-4 me-4" style="position:fixed; top:0; right:0; z-index:100000; background-color:rgb(255, 255, 255);">
        <div class="toast-header">
            <strong class="mr-auto primary-color">Tenzir</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="closeToast()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body"></div>
    </div>
</div>

<script>
    // close the messager toast
    function closeToast(idOfElement = 'main-toast'){
        $('#'+idOfElement).toast('hide');
    }
    // adds a message to the messager toast
    function addMessageToToast(message){
        if(message != ''){
            $('#main-toast').find('.toast-body').text(message);
            $('#main-toast').toast('show');
        }
    }
    // sets a delay animation when closing the messager toast
    function setDelayToToast(delayTimeInSeconds = '5000', toastId = 'main-toast'){
        $('#'+toastId).attr('data-bs-delay', delayTimeInSeconds);
    }
</script>