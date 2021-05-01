@extends('layouts.app')
@section('title', 'Contact - Aqmfy')

@section('home')
    <!-- / menu -->

    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('img/background.jpeg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Contact</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('services.index') }}">Home</a></li>
                        <li class="active" style="color: rgb(189, 158, 158)">Contact</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->
    <!-- start contact section -->
    <section id="aa-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-contact-area">
                        <div class="aa-contact-top">
                            <h2>We are wating to assist you..</h2>
                            <p>We will try our best to respond to your question as clear as possible. Thank You</p>
                        </div>
                        <!-- contact map -->
                        <div class="aa-contact-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.476809133528!2d104.72366051474893!3d-2.9651154405976503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b75b745629721%3A0x947e8935aa238f1c!2sJl.%20Way%20Hitam%2C%20Siring%20Agung%2C%20Kec.%20Ilir%20Bar.%20I%2C%20Kota%20Palembang%2C%20Sumatera%20Selatan!5e0!3m2!1sen!2sid!4v1618586578878!5m2!1sen!2sid"
                                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                        </div>
                        <!-- Contact address -->
                        <div class="aa-contact-address">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="aa-contact-address-left">
                                        <form class="comments-form contact-form" action="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Your Name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" placeholder="Email" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Subject" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Company" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <textarea class="form-control" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button class="aa-secondary-btn">Send</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="aa-contact-address-right">
                                        <address>
                                            <h4>Aqmfy Stock</h4>

                                            <p><span class="fa fa-home">Palembang, Jln. Way Hitam No.55</span></p>
                                            <p><span class="fa fa-phone"></span>081298989898</p>
                                            <p><span class="fa fa-envelope"></span>Email: support@aqmfystock.com</p>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
