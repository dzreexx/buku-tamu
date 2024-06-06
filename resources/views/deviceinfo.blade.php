<!-- resources/views/device_info.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Device Information</title>
</head>
<body>
    <h1>Device Information</h1>
    <p><strong>Device:</strong> {{ $device }}</p>
    <p><strong>Platform:</strong> {{ $platform }}</p>
    <p><strong>Browser:</strong> {{ $browser }}</p>
    <p><strong>Is Phone:</strong> {{ $isPhone ? 'Yes' : 'No' }}</p>
    <p><strong>Is Tablet:</strong> {{ $isTablet ? 'Yes' : 'No' }}</p>
    <p><strong>Is Desktop:</strong> {{ $isDesktop ? 'Yes' : 'No' }}</p>
    <p><strong>Is Bot:</strong> {{ $isBot ? 'Yes' : 'No' }}</p>
</body>
</html>