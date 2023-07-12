  <h1> Hello {{ $user->name }}</h1>

  <p>Please verify your email by clicking the button below or copy and paste the link below into the URL bar</p>
  <x-mail::button :url="url('/verify/email/' . $user->verification_code)">
      Click here to verify email
  </x-mail::button>

  <p><a
          href="{{ url('/verify/email/' . $user->verification_code) }}">www.munchmunch.neilmallia.com/verify/email/{{ $user->verification_code }}</a>
  </p>



  Thanks,<br>
  Munch Munch
