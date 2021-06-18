<!-- Vendor js -->
<script src="{{ asset('admins/js/vendor.min.js') }}"></script>

<!-- optional plugins -->
<script src="{{ asset('admins/libs/moment/moment.min.js') }}"></script>

<script src="{{ asset('admins/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('admins/libs/flatpickr/flatpickr.min.js') }}"></script>

<!-- page js -->
<script src="{{ asset('admins/js/pages/dashboard.init.js') }}"></script>

<!--Summernote js-->
<script src="{{ asset('admins/libs/summernote/summernote-bs4.min.js') }}"></script>

<!-- Init js -->
<script src="{{ asset('admins/js/pages/form-editor.init.js') }}"></script>  


<!-- App js -->
<script src="{{ asset('admins/js/app.min.js') }}"></script>



<!-- Main script js -->
<script src="{{ asset('admins/js/script.js') }}"></script>





<script>
$(document).ready(function(){
// *********** BOTTOM ALERT DANGER ****************//
function bottom_alert_error(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_danger").children('.bottom-alert-danger')

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })

    setTimeout(function(){
        $(alert).css({
            bottom: '-100px'
        })
    }, 4000)
}








// *********** BOTTOM ALERT SUCCESS ****************//
function bottom_alert_success(string){
    var bottom = '0px';
    var alert =  $("#bottom_alert_success").children('.bottom-alert-success')

    if($(window).width() > 767){
        bottom = '5px'
    }

    $(alert).html(string)
    $(alert).css({ bottom: bottom })

    setTimeout(function(){
        $(alert).css({
            bottom: '-100px'
        })
    }, 4000)
}
})
</script>