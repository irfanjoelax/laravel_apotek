<div class="navbar">
    <div class="row">
        <div class="column column-30 col-site-title"><a href="#" class="site-title float-left">APOTEK KIM FARMA</a></div>
        <div class="column column-30">
            <div class="user-section">
            <a href="#">
                <div class="username">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p>
                        @if (Auth::user()->level == 1)
                            Administrator
                        @else 
                            User
                        @endif
                    </p>
                </div>
            </a>
            </div>
        </div>
    </div>
</div>