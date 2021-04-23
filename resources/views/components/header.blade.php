  <!-- Start header section -->
  <div>
      <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
      <header id="aa-header">
          @php
              use App\Models\User;
              use App\Models\Cart;
              $order = false;
              $wishlist = false;
              $chat = false;
              $role = false;
              $user = false;
              $carts = Cart::where('user_id', auth()->id())->get();

              if (url()->current() == env('APP_URL') . '/wishlists') {
                  $wishlist = true;
              } elseif (url()->current() == env('APP_URL') . '/orders/' . auth()->id()) {
                  $order = true;
              } elseif (url()->current() == env('APP_URL') . '/messages') {
                  $chat = true;
              } elseif (url()->current() == env('APP_URL') . '/roles') {
                  $role = true;
              } elseif (url()->current() == env('APP_URL') . '/users') {
                  $user = true;
              }
              $categories = User::categories();

          @endphp

          <!-- start header top  -->
          <div class="aa-header-top">
              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="aa-header-top-area">
                              <!-- start header top left -->
                              <div class="aa-header-top-left">
                                  <!-- start language -->
                                  <div class="aa-language">
                                      <div class="dropdown">
                                          <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1"
                                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <img src="{{ asset('img/indonesia.png') }}" alt="english flag">INDONESIA
                                              <span class="caret"></span>
                                          </a>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                              <li><a href="#"><img src="{{ asset('img/indonesia.png') }}"
                                                          alt="">INDONESIA</a></li>
                                              <li><a href="#"><img src="{{ asset('img/english.jpg') }}"
                                                          alt="">ENGLISH</a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <!-- / language -->
                                  <!-- start cellphone -->
                                  <div class="cellphone hidden-xs">
                                      <p><span class="fa fa-phone"></span>+62 812-989-8998</p>
                                  </div>
                                  <!-- / cellphone -->
                              </div>
                              <!-- / header top left -->
                              <div class="aa-header-top-right">
                                  <ul class="aa-head-top-nav-right">
                                      @guest
                                          <li class="hidden-xs"><a href="{{ route('login') }}">Login</a></li>
                                          <li><a href="{{ route('register') }}">Register</a></li>
                                      @else
                                          @if (auth()->user()->roles->first() != null &&
        auth()->user()->roles->first()->name == 'Admin')
                                              <li><a href="{{ route('roles.index') }}">Roles</a>
                                              </li>
                                              <li class="hidden-xs"><a href="{{ route('users.index') }}">Manage Users</a>
                                              </li>
                                          @else
                                              <li><a
                                                      href="{{ route('profiles.edit', auth()->user()) }}">{{ Auth::user()->name }}</a>
                                              </li>
                                              @if (auth()->user()->seller)
                                                  <li class="hidden-xs"><a
                                                          href="{{ route('sellers.show', auth()->user()->seller) }}">Seller
                                                          Profile</a>
                                                  </li>
                                              @else
                                                  <li class="hidden-xs"><a href="{{ route('sellers.create') }}">Become a
                                                          Seller</a>
                                                  </li>
                                              @endif
                                              <li class="hidden-xs"><a href="{{ route('wishlists.show') }}">Wishlist</a>
                                              </li>
                                              <li class="hidden-xs"><a
                                                      href="{{ route('orders.index', auth()->user()) }}">Orders</a></li>
                                              <li><a href="{{ route('logout') }}"
                                                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                              </li>
                                              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                  @csrf
                                              </form>
                                          @endif
                                      @endguest


                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- / header top  -->

          <!-- start header bottom  -->
          <div class="aa-header-bottom">
              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="aa-header-bottom-area">
                              <!-- logo  -->
                              <div class="aa-logo">
                                  <!-- Text based logo -->

                                  <!-- img based logo -->
                                  <a href="{{ route('services.index') }}"><img
                                          src="{{ asset('img/textaqmfy.png') }}" alt="logo img" width="180"
                                          style="margin-top: 40px"></a>
                              </div>
                              <!-- / logo  -->
                              <!-- workspace -->
                              <div class="aa-workspace">
                                  @auth
                                      <a class="aa-workspace-link" href="#" data-toggle="modal" data-target="#login-modal">
                                          <span class="aa-workspace-title">WORKSPACE</span>
                                      </a>
                                  @endauth

                              </div>
                              <!-- cart box -->
                              <div class="aa-cartbox">
                                  @auth

                                      <a class="aa-cart-link" href="{{ route('carts.index') }}">
                                          <span class="fa fa-shopping-basket"></span>
                                          <span class="aa-cart-title">SHOPPING CART</span>
                                          <span class="aa-cart-notify">{{ auth()->user()->carts->count() }}</span>
                                      </a>
                                  @endauth
                                  <div class="aa-cartbox-summary">
                                      @if ($carts->count() == 0)

                                          <div class="h4">Nothing Here</div>

                                      @else

                                          <ul>
                                              @foreach ($carts->take(3) as $cart)
                                                  <li>
                                                      <a class="aa-cartbox-img"
                                                          href="{{ route('services.show', $cart->service) }}">
                                                          <div style="width: 100px;
                                                          height: 100px;
                                                          overflow: hidden;"><img
                                                                  src="{{ asset($cart->service->serviceImage()) }}"
                                                                  alt="img" class="img-rounded"></div>
                                                      </a>
                                                      <div class="aa-cartbox-info">
                                                          <h4><a
                                                                  href="{{ route('services.show', $cart->service) }}">{{ $cart->service->name }}</a>
                                                          </h4>
                                                          <p>{{ $cart->quantity }} x Rp.
                                                              {{ number_format($cart->service->price) }}
                                                          </p>
                                                      </div>
                                                      <form action="{{ route('carts.destroy', $cart->id) }}"
                                                          method="POST">
                                                          @csrf
                                                          @method('DELETE')
                                                          <button class="aa-remove-product"><span
                                                                  class="fa fa-times"></span></button>
                                                      </form>

                                                  </li>
                                              @endforeach

                                          </ul>
                                          <a class="aa-cartbox-checkout aa-primary-btn"
                                              href="{{ route('checkout') }}">Checkout</a>
                                      @endif

                                  </div>
                              </div>
                              <!-- / cart box -->
                              <!-- search box -->
                              <div class="aa-search-box">
                                  <form action="{{ route('search') }}" autocomplete="off">
                                      <input class="typeahead" type="text" name="" id=""
                                          placeholder="Search here ex. 'photography' " name="query">
                                      <button type="submit" style="background-color: black"><span
                                              class="fa fa-search"></span></button>
                                  </form>
                              </div>
                              <!-- / search box -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- / header bottom  -->
      </header>
      <section id="menu">
          <div class="container">
              <div class="menu-area">
                  <!-- Navbar -->
                  <div class="navbar navbar-default" role="navigation">
                      <div class="navbar-header">
                          <button type="button" class="navbar-toggle" data-toggle="collapse"
                              data-target=".navbar-collapse">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </button>
                      </div>
                      <div class="navbar-collapse collapse">
                          <!-- Left nav -->
                          <ul class="nav navbar-nav">
                              <li><a href="{{ route('services.index') }}">Home</a></li>
                              <li><a href="{{ route('contact') }}">Contact</a></li>
                              @foreach ($categories as $category)
                                  <li><a href="{{ route('search.category', $category->id) }}">{{ $category->name }}
                                      </a>
                                  </li>
                              @endforeach
                          </ul>
                      </div>
                      <!--/.nav-collapse -->
                  </div>
              </div>
          </div>
      </section>
      <!-- / menu -->
  </div>
