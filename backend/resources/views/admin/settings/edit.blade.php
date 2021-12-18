@extends('admin.layout.master')

@section('title', 'Settings | General')
@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"
                              action="{{ route('admin.settings.update') }}">
                            @method('PUT')
                            @csrf
                            {{-- @foreach($settings as $key=>$value)
                                @if($key != 'logo')
                                    @if($key != 'tags')
                                        @if( $key != 'top_bar_background_color' && $key != 'top_bar_text_color' && $key != 'top_border_color' && $key != 'navbar_background_color'  && $key != 'footer_background_color' && $key != 'button_color' && $key != 'navbar_text_color' && $key != 'navbar_hover_color' && $key != 'navbar_active_color' && $key !='footer_background_color' && $key != 'footer_bottom_background_color' && $key != 'footer_bottom_text_color' && $key != 'footer_text_color' && $key != 'footer_bottom_border_color' && $key != 'top_bar_visible' && $key != 'phone_number_visible' && $key !=  'email_address_visible')
                                        <span class="mt-5">
                                            <label for="{{ $key }}">{{ucwords(str_replace('_', ' ', $key)) }}</label>
                                            <input type="text" name="{{ $key }}" class="form-control" id="{{ $key }}"
                                                   value="{{ $value }}">
                                        </span>

                                        @endif
                                        @else
                                        <div class="form-group">
                                            <label for="tags">{{ __('SEO keywords') }}</label>
                                            <input type="text" name="tags" class="form-control tags  selectize-{{ $loop->index }}" value="{{$value }}">
                                        </div>

                                    @endif
                                @else
                                    <div class="form-row">
                                        <div class="col-md-2   text-center">
                                            <div class="form-group" id="imgPreview">
                                                <img src="{{ asset('logo') . '/' . $value }}" class="img-fluid"
                                                     alt="{{ $value }}">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="catImage">{{ __('Logo') }} ( {{ setting('general.logo') }}
                                                                                       )</label>
                                                <div class="custom-file">
                                                    <input type="file" name="logo" class="custom-file-input"
                                                           id="catImage">
                                                    <label class="custom-file-label"
                                                           for="catImage">{{ __('Choose') }} {{__('file') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach<div class="row "> --}}
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center m-b">
                                                <h3 class="m-b-0">{{__('Main Info')}}</h3>
                                            </div>
                                            <div class="form form-horizontal">
                                                <div class="form-group d-flex justify-content-center">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <input type="file" name="logo" class="custom-file-input" id="catImage">
                                                            <label class="custom-file-label" for="catImage">{{ __('Choose') }} {{__('file') }}</label>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 5px;">
                                                            <div class="form-row">
                                                                <div class="col-md-12 text-center">
                                                                    <div class="form-group" id="imgPreview">
                                                                        <img src="{{asset('logo') . '/' . setting('general.logo') }}" class="img-fluid w-50 h--50" height="50" alt="no image" id="output_image">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="form-control-1">{{__("Website Name")}}</label>
                                                    <input id="form-control-1" name="website_name" value="{{setting('general.website_name')}}" class="form-control" type="text">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('Map iFrame Link')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="map_iframe_link" value="{{setting('general.map_iframe_link')}}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1">{{__('Address')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text"  name="address" value="{{setting('general.address')}}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('Phone')}} #</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="phone_number" value="{{setting('general.phone_number')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('Contact Email')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="contact_email" value="{{setting('general.contact_email')}}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center m-b">
                                                <h3 class="m-b-0">{{__('Payment Setting')}}</h3>
                                            </div>
                                            <div class="form form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('Payment Gareway')}}</label>
                                                    <select id="form-control-1" name="payment_gateway" class="custom-select form-control" type="text">
                                                        <option value="" {{ setting('general.payment_gateway') == null ? 'selected' : '' }}>{{__('none')}}</option>
                                                        <option value="paymob" {{ setting('general.payment_gateway') == 'paymob' ? 'selected' : '' }}>{{__('Paymob')}}</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-0 pb-0">
                                                    <h4>{{__('Auth Methods')}} <span style="font-size: .8em">{{__('( API Key | User Login )')}}</span></h4>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('API Key')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="payment_api_key" value="{{setting('general.payment_api_key')}}">
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-6">
                                                        <label class="col-sm-3 control-label" for="form-control-1">{{__('Merchant ID')}}</label>
                                                        <input id="form-control-1" class="form-control" type="text" name="payment_merchant_id" value="{{setting('general.payment_merchant_id')}}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-sm-3 control-label" for="form-control-1" >{{__('Iframe ID')}}</label>
                                                        <input id="form-control-1" class="form-control" type="text" name="payment_iframe_id" value="{{setting('general.payment_iframe_id')}}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-sm-3 control-label" for="form-control-1" >{{__('Integration ID')}}</label>
                                                        <input id="form-control-1" class="form-control" name="payment_integration_id" type="text" value="{{setting('general.payment_integration_id')}}">
                                                    </div>
                                                    <div class="col-6 d-flex flex-row-reverse align-items-center">
                                                        <i class="fas fa-lg fa-info-circle" id="info_integration_icon"></i>
                                                    </div>
                                                </div>
                                                <div id='info_integration' class="row p-3 m-2" style="display:none; background:gainsboro" >
                                                    <div>
                                                        {{__('When you create (Integration) in ')}}
                                                        <a href="https://accept.paymob.com/portal2/en/PaymentIntegrations" target="_blank">{{__('Paymob site')}}</a>
                                                        {{__('you should add this')}}
                                                    </div>
                                                    <div class="note_div" id="proc" onclick="copyToClipboard('#proc_dev')">
                                                        <strong>{{__('Transaction processed callback')}}</strong><br>
                                                        <div >
                                                            <span id="proc_dev">{{'api.troom.aisent/api/processed'}}</span>
                                                            <i id="proc_copy" class="fas fa-copy d-flex flex-row-reverse align-items-baseline hidden"></i>
                                                        </div>
                                                    </div>
                                                    <div class="note_div" id="res" onclick="copyToClipboard('#res_dev')">
                                                        <strong>{{__('Transaction response callback')}}</strong><br>
                                                        <div class="" >
                                                            {{-- <span id="res_dev">{{route('response')}}</span> --}}
                                                            <span id="res_dev">{{'api.troom.aisent/api/response'}}</span>
                                                            <i  id="res_copy" class="fas fa-copy d-flex flex-row-reverse align-items-baseline hidden"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group pt-4 mb-0 pb-0">
                                                    <h5>{{__('It is better not to use this method')}}<span style="font-size: .8em">{{__('( Username | Password )')}}</span></h5>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-6">
                                                        <label class="col-sm-3 control-label" for="form-control-1" >{{__('Username')}}</label>
                                                        <input id="form-control-1" class="form-control" type="text" name="payment_username" value="{{setting('general.payment_username')}}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-sm-3 control-label" for="form-control-1" >{{__('Password')}}</label>
                                                        <input id="form-control-1" class="form-control" type="password" name="payment_password" value="{{setting('general.payment_password')}}">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center m-b">
                                                <h3 class="m-b-0">{{__('Social Media Info')}}</h3>
                                            </div>
                                            <div class="form form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('Facebook Link')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="facebook_page_link" value="{{setting('general.facebook_page_link')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('Twitter Link')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="twitter_page_link" value="{{setting('general.twitter_page_link')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1">{{__('Whatsapp')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="whatsapp_number" value="{{setting('general.whatsapp_number')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('LinkedIn Link')}}</label>
                                                    <input id="form-control-1" class="form-control" name="linkedin_page_link" type="text" value="{{setting('general.linkedin_page_link')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('Instagram Link')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="instagram_page_link" value="{{setting('general.instagram_page_link')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="form-control-1" >{{__('YouTube Link')}}</label>
                                                    <input id="form-control-1" class="form-control" type="text" name="youTube_page_link" value="{{setting('general.youTube_page_link')}}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="signup">
                                                <div class="signup-body">
                                                    <div class="text-center m-b">
                                                        <h3 class="m-b-0">{{__('Marketing Tools')}}</h3>
                                                        <small></small>
                                                    </div>
                                                    <div  class="form form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="form-control-1" >{{__('SEO keywords')}}</label>
                                                            <div class="col-sm-12">
                                                                <input id="form-control-1" name="tags" class="form-control tags" type="text" value="{{setting('general.tags')}}">
                                                                <span class="label label-default">{{__('Business')}}</span>
                                                                <span class="label label-warning">{{__('Finance')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="form-control-3">{{__('Website Description')}}</label>
                                                            <div class="col-sm-12">
                                                                <textarea id="form-control-3" class="form-control" type="text" name="website_description">{{setting('general.website_description')}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="form-control-1">{{__('Facebook Pixel')}}</label>
                                                            <div class="col-sm-12">
                                                                <input id="form-control-1" class="form-control" type="text" name="facebook_pixel" value="{{setting('general.facebook_pixel')}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label" for="form-control-1" >{{__('Google Analytic')}}</label>
                                                            <div class="col-sm-12">
                                                                <input id="form-control-1" class="form-control" type="text"  name="google_analytic" value="{{setting('general.google_analytic')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('input[type="file"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview').show();
        });

        $('.tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
        });

        $('#info_integration_icon').click(function() {
            $("#info_integration").toggle("slow");
        });

        $("#proc").hover(function() {
            $('#proc_copy').removeClass('hidden');
            }, function() {
            $('#proc_copy').addClass('hidden');
        });
        $("#res").hover(function() {
            $('#res_copy').removeClass('hidden');
            }, function() {
            $('#res_copy').addClass('hidden');
        });
    </script>
@stop
