<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Property Approved</title>
</head>
<body style="font-family: Arial, sans-serif; color:#222;">
  <p>Hi {{ $user_name }},</p>
  <p>Your property <strong>{{ $property_title }}</strong> has been approved and is now live.</p>
  @if(!empty($property_image))
  <p>
    <img src="{{ $property_image }}" alt="{{ $property_title }}" style="max-width: 100%; height: auto; border-radius: 6px;" />
  </p>
  @endif
  @if(!empty($property_url))
  <p>View it here: <a href="{{ $property_url }}" target="_blank">{{ $property_url }}</a></p>
  @endif
  <p>Thank you for using {{ getcong('site_name') }}.</p>
</body>
</html>
