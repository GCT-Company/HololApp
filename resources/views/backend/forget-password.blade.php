<!DOCTYPE html>
<html>
  <head>
    {{-- required meta tags --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- title --}}
    <title>{{ __('Forget Password') . ' | ' . $websiteInfo->website_title }}</title>

    {{-- fav icon --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/' . $websiteInfo->favicon) }}">

    {{-- bootstrap css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    {{-- atlantis css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.css') }}">

    {{-- admin-login css also using for forget password --}}
    <link rel="stylesheet" href="{{ asset('assets/css/admin-login.css') }}">

    {{-- forget form style --}}
    <link rel="stylesheet" href="{{ asset('assets/css/forget-form.css') }}">
  </head>

  <body>
    {{-- forget password form start --}}
    <div class="forget-page">
      @if (!empty($websiteInfo->logo))
        <div class="text-center mb-4">
          <img class="login-logo" src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="logo">
        </div>
      @endif

      <div class="form">
        <form class="forget-password-form" action="{{ route('admin.mail_for_forget_password') }}" method="POST">
          @csrf
          <input type="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}"/>
          @if ($errors->has('email'))
            <p class="text-danger text-left">{{ $errors->first('email') }}</p>
          @endif

          <button type="submit" class="mt-2">{{ __('proceed') }}</button>
        </form>

        <a class="back-to-login" href="{{ route('admin.login') }}">
          &lt;&lt; {{ __('Back') }}
        </a>
      </div>
    </div>
    {{-- forget password form end --}}


    {{-- jQuery --}}
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    {{-- popper js --}}
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>

    {{-- bootstrap js --}}
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    {{-- bootstrap notify --}}
    <script src="{{ asset('assets/js/bootstrap-notify.min.js') }}"></script>

    {{-- fonts and icons script --}}
    <script src="{{ asset('assets/js/webfont.min.js') }}"></script>

    <script>
      WebFont.load({
        google: {"families": ["Lato:300,400,700,900"]},
        custom: {"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset("assets/css/fonts.min.css") }}']},
        active: function() {
          sessionStorage.fonts = true;
        }
      });
    </script>

    @if (session()->has('success'))
      <script>
        var content = {};

        content.message = '{{ session('success') }}';
        content.title = 'Success';
        content.icon = 'fa fa-bell';

        $.notify(content, {
          type: 'success',
          placement: {
            from: 'top',
            align: 'right'
          },
          showProgressbar: true,
          time: 1000,
          delay: 4000
        });
      </script>
    @endif

    @if (session()->has('warning'))
      <script>
        var content = {};

        content.message = '{{ session('warning') }}';
        content.title = 'Warning!';
        content.icon = 'fa fa-bell';

        $.notify(content, {
          type: 'warning',
          placement: {
            from: 'top',
            align: 'right'
          },
          showProgressbar: true,
          time: 1000,
          delay: 4000
        });
      </script>
    @endif
  </body>
</html>
