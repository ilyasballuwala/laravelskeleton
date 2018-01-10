<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>eCabs 4 u</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="HandheldFriendly" content="true">
	<meta name="apple-touch-fullscreen" content="yes">

    <!-- Google Fonts-->
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">
    <style type="text/css">
		body{ font-family:'Nunito'; font-weight:400; font-size:18px; }
		table tr td:first-child{ width:200px; }
	</style>
	
</head>
<body>
    <p> Hello Driver {{ $maildetails['name'] }}, </p>
    <p> Greetings from eCabs 4 u !!</p>
    <p> Please click on the below URL to verify your registration at eCabs 4 u.</p>
    <p> Verification URL : <a href="{{ $maildetails['verificationurl'] }}" target="_blank">{{ $maildetails['verificationurl']  }}</a> </p>
    <p>With Regards,<br/>
    eCabs 4 u team.</p>
</body>
</html>
