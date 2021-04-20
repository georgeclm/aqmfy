  <!-- Start header section -->
  <div>
      <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>

      <header id="aa-header">
          @php
              use App\Models\User;
              $order = false;
              $wishlist = false;
              $chat = false;
              $role = false;
              $user = false;
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
                                  <a href="{{ route('services.index') }}"><img class="mt-4"
                                          src="{{ asset('img/textaqmfy.png') }}" alt="logo img" width="220"></a>
                              </div>
                              <!-- / logo  -->
                              <!-- workspace -->
                              <div class="aa-workspace">
                                  @auth
                                      <a class="aa-workspace-link" href="" data-toggle="modal" data-target="#login-modal">
                                          <span class="aa-workspace-title">WORKSPACE</span>
                                      </a>
                                  @endauth

                              </div>
                              <!-- cart box -->
                              <div class="aa-cartbox">
                                  @auth

                                      <a class="aa-cart-link" href="#">
                                          <span class="fa fa-shopping-basket"></span>
                                          <span class="aa-cart-title">SHOPPING CART</span>
                                          <span class="aa-cart-notify">2</span>
                                      </a>
                                  @endauth

                                  <div class="aa-cartbox-summary">
                                      <ul>
                                          <li>
                                              <a class="aa-cartbox-img" href="#"><img src="img/woman-small-2.jpg"
                                                      alt="img"></a>
                                              <div class="aa-cartbox-info">
                                                  <h4><a href="#">Product Name</a></h4>
                                                  <p>1 x $250</p>
                                              </div>
                                              <a class="aa-remove-product" href="#"><span
                                                      class="fa fa-times"></span></a>
                                          </li>
                                          <li>
                                              <a class="aa-cartbox-img" href="#"><img src="img/woman-small-1.jpg"
                                                      alt="img"></a>
                                              <div class="aa-cartbox-info">
                                                  <h4><a href="#">Product Name</a></h4>
                                                  <p>1 x $250</p>
                                              </div>
                                              <a class="aa-remove-product" href="#"><span
                                                      class="fa fa-times"></span></a>
                                          </li>
                                          <li>
                                              <span class="aa-cartbox-total-title">
                                                  Total
                                              </span>
                                              <span class="aa-cartbox-total-price">
                                                  $500
                                              </span>
                                          </li>
                                      </ul>
                                      <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
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
      <div class="bg-white">
          <div class="container d-flex w-100 h-100 p-1 mx-auto flex-column border-bottom border-light border-5">
              <header class="mb-auto">
                  <div>
                      <nav class="nav nav-masthead justify-content-center float-md-start">
                          @foreach ($categories as $category)
                              <a class="nav-link"
                                  href="{{ route('search.category', $category->id) }}">{{ $category->name }}</a>
                          @endforeach
                      </nav>
                  </div>
              </header>
          </div>
      </div>
  </div>
