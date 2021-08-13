<!-- == Footer == -->
    <div class="footer m-3" data-aos="fade-in" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4>Tentang UGD HP</h4>
                        <p>Pelayanan perbaikan Handphone dan Laptop/PC juga Jasa Pembuatan Website.</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-col middle">
                        <h4>Layanan</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><a class="turquoise" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>hp">Handphone</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><a class="turquoise" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>laptop">Laptop</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><a class="turquoise" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>app">Pembuatan Wesbite</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-col middle">
                        <h4>Legal</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="turquoise" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>terms-conditions">Terms & Conditions</a>, <a class="turquoise" href="<?php if(isset($_SESSION['auth'])){echo "../";}?>privacy-policy">Privacy Policy</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-col last text-center">
                        <h4>Social Media</h4>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-google-plus-g fa-stack-1x"></i>
                            </a>
                        </span>
                    </div> 
                </div>
            </div>
        </div>
    </div>
<!-- == end of footer == -->
<!-- == Copyright == -->
    <div class="copyright mb-n5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small mb-n5">Powered by <a href="https://cutt.ly/netmedia-framecode" class="text-decoration-none font-weight-bold text-dark" target="_blank">Netmedia Framecode</a></p>
                </div>
            </div>
        </div>
    </div>
<!-- == end of copyright == -->
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/jquery.min.js"></script>
<!-- <script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/popper.min.js"></script> -->
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/bootstrap.min.js"></script>
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/jquery.easing.min.js"></script>
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/swiper.min.js"></script>
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/jquery.magnific-popup.js"></script>
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/validator.min.js"></script>
<script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/js/js-visitor/scripts.js"></script>
<!-- <script src="<?php if(isset($_SESSION['auth'])){echo "../";}?>Assets/sweetalert/dist/sweetalert2.all.min.js"></script> -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script> -->
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 15000)

    AOS.init({
        // offset: 100,
        duration: 1000,
        throttleDelay: 99
    });
            
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right':scrollWidth});
    }).resize();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })

    const options = {
        bottom: '32px', // default: '32px'
        right: 'unset', // default: '32px'
        left: '32px', // default: 'unset'
        time: '0.3s', // default: '0.3s'
        mixColor: '#fff', // default: '#fff'
        backgroundColor: '#fff',  // default: '#fff'
        buttonColorDark: '#100f2c',  // default: '#100f2c'
        buttonColorLight: '#fff', // default: '#fff'
        saveInCookies: true, // default: true,
        label: '🌓', // default: ''
        autoMatchOsTheme: true // default: true
    }

    const darkmode = new Darkmode(options);
    darkmode.showWidget();

    $(document).ready(function(){
        $('#keyword-hp').on('keyup',function(){
            $.get('fo.php?keyword-hp='+$('#keyword-hp').val(),function(data){
                $('#container-search-handphone').html(data);
            });
        });
    });
    $(document).ready(function(){
        $('#keyword-laptop').on('keyup',function(){
            $.get('fo.php?keyword-laptop='+$('#keyword-laptop').val(),function(data){
                $('#container-search-laptop').html(data);
            });
        });
    });
</script>