<footer class="block">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-4">
                <div class="footer-bottom">
                    <img src='{{asset("uploads/carharu.png")}}' style="width: 160px;">
                    <br><br>
                    <p>Comprehensive cars portal of Nepal</p>
                </div>
            </div><!--  -->
            <div class="col-lg-3 col-md-4">
                <h3 class="">Connect with us</h3>
                <ul class="links">
                    <li><a href="https://www.facebook.com/CarHaruOfficial/">Facebook</a></li>
                    <li><a href="https://www.instagram.com/CarHaruOfficial/">Instagram</a></li>
                </ul>
            </div><!--  -->
            <div class="col-lg-4 col-md-4">
                <h3 class="">Contact US</h3>
                <div class="location">
                    <p>Adddres: Baluwatar, Kathmandu, Nepal</p>
                    <p>Email: hello@carharu.com</p>
                </div>
            </div><!--  -->
        </div>
    </div>
    <div class="text-center bot">Copyright © {{ date('Y') }} CarHaru &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('page', ['slug' => 'privacy-policy'])}}">Privacy Policy</a> |
        <a href="{{route('page', ['slug' => 'terms-conditions'])}}">Terms & Conditions</a>
    </div>
</footer>
<!-- cnds -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<!-- swiper js -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{asset('assets/rateyo/jquery.rateyo.js')}}"></script>
<script src="{{asset('assets/noui/src/nouislider.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
<script src="{{asset('assets/js/custom.js') . '?v=' . rand(9999,9999999)}}"></script>
@yield('scripts')
</body>
</html>
