<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Property Rejected</title>
</head>
<body style="font-family: Arial, sans-serif; color:#222;">
  <p>Hi {{ $user_name }},</p>
  <p>Your property <strong>{{ $property_title }}</strong> was not approved.</p>
  @if(!empty($property_image))
  <p>
    <img src="{{ $property_image }}" alt="{{ $property_title }}" style="max-width: 100%; height: auto; border-radius: 6px;" />
  </p>
  @endif
  <p><strong>Reason:</strong></p>
  <p style="white-space: pre-line;">{{ $reason }}</p>
  <p>You can edit and resubmit your property from your dashboard.</p>
  <p>Thank you for using {{ getcong('site_name') }}.</p>
</body>
</html>
