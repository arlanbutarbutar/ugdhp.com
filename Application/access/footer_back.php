<footer class="footer section py-5">
    <div class="row">
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
            <p class="mb-0 text-center text-xl-left">Powered by <a class="text-primary font-weight-normal" href="http://47.74.65.71" target="_blank">Netmedia Framecode</a></p>
        </div>
    </div>
</footer>
</main>
</div>
</div>
</div>
<script src="../Assets/console/popper.js/dist/umd/popper.min.js"></script><!-- Core -->
<script src="../Assets/console/bootstrap/dist/js/bootstrap.min.js"></script><!-- Core -->
<script src="../Assets/console/onscreen/dist/on-screen.umd.min.js"></script><!-- Vendor JS -->
<script src="../Assets/console/nouislider/distribute/nouislider.min.js"></script><!-- Slider -->
<script src="../Assets/console/jarallax/dist/jarallax.min.js"></script><!-- Jarallax -->
<script src="../Assets/console/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script><!-- Smooth scroll -->
<script src="../Assets/console/countup.js/dist/countUp.umd.js"></script><!-- Count up -->
<script src="../Assets/console/notyf/notyf.min.js"></script><!-- Notyf -->
<script src="../Assets/console/chartist/dist/chartist.min.js"></script><!-- Charts -->
<script src="../Assets/console/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script><!-- Charts -->
<script src="../Assets/console/vanillajs-datepicker/dist/js/datepicker.min.js"></script><!-- Datepicker -->
<script src="../Assets/console/simplebar/dist/simplebar.min.js"></script><!-- Simplebar -->
<script async defer src="https://buttons.github.io/buttons.js"></script><!-- Github buttons -->
<script src="../Assets/console/js/volt.js"></script><!-- Volt JS --> 
<script src="../Assets/js/register.js"></script>
<!-- <script src="../Assets/js/demo/chart.js"></script>Volt JS  -->
<!-- <script src="../Assets/js/sb-admin-2.min.js"></script>SB Admin 2 JS  -->
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 15000)
    $('.custom-file-input').on('change', function(){
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault()
        })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel.disableScroll')
    })
    function printDiv(elementId) {
        var a = document.getElementById('printing-css').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
</script>