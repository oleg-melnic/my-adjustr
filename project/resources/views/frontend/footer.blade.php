<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <ul class="list-unstyled">
                    <li>
                        <img src="/images/logo.png" height="50">
                    </li>
                    <li>
                        <a href="{{ route('about') }}">About</a>
                    </li>
                    <li>
                        <a href="/blog">Blog</a>
                    </li>
                </ul>


            </div>
            <div class="col col-xs-12">
                <ul class="list-unstyled">
                    <li>
                        <h6><b>Homeowners</b></h6>
                    </li>
                    <li>
                        <a href="{{ route('how-it-works') }}">How It Works</a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}">Services & Fees</a>
                    </li>
                </ul>
            </div>
            <div class="col col-xs-12">
                <ul class="list-unstyled">
                    <li>
                        <h6><b>Professionals</b></h6>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">Join as a professional</a>
                    </li>
                    <li>
                        <a href="{{ route('prices') }}">Pricing</a>
                    </li>
                </ul>
            </div>
            <div class="col col-xs-12">
                <ul class="list-unstyled">
                    <li>
                        <h6><b>Support</b></h6>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="/faq">FAQ</a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}">Terms & Conditions</a>
                    </li>
                    <li>
                        <a href="{{ route('policy') }}">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <img src="/images/facebook.svg" height="30">
                    </li>
                    <li class="list-inline-item">
                        <img src="/images/instagram.svg" height="30">
                    </li>
                    <li class="list-inline-item">
                        <img src="/images/twitter.svg" height="30">
                    </li>
                </ul>
            </div>

        </div>

    </div>
</section>

<section id="copyright">
    <div class="container">
        <div class="text-left">
            <span>© 2019 Copyright. All rights reserved.</span>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("div[id^='myModal']").each(function(){

        var currentModal = $(this);

        //click next
        currentModal.find('.btn-next').click(function(){
            currentModal.modal('hide');
            currentModal.closest("div[id^='myModal']").nextAll("div[id^='myModal']").first().modal('show');
        });

        //click prev
        currentModal.find('.btn-prev').click(function(){
            currentModal.modal('hide');
            currentModal.closest("div[id^='myModal']").prevAll("div[id^='myModal']").first().modal('show');
        });

    });


</script>

</body>
</html>
