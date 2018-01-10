<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Efficient Property Management Apartment Homes</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="HandheldFriendly" content="true">
	<meta name="apple-touch-fullscreen" content="yes">

    <title>Property Inquiry</title>

    <!-- Google Fonts-->
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">
    <style type="text/css">
		body{ font-family:'Nunito'; font-weight:400; font-size:18px; }
		table tr td:first-child{ width:200px; }
	</style>
	
</head>
<body>
    
    <p> Hello Admin, </p>
    <p> Property Inquiry has been arrived with the following details.</p><br/>
    <table cellpadding="3">
    	<tr>
        	<td>Name :</td>
            <td>{{ ucfirst($inquirydetails->contact_name) }}</td>
        </tr>
        <tr>    
            <td>Email :</td>
             <td>{{ $inquirydetails->contact_email }}</td>
        </tr>
        <tr>     
            <td>Phone :</td>
            <td>@if($inquirydetails->contact_phone != NULL && $inquirydetails->contact_phone != '') {{ ucfirst($inquirydetails->contact_phone) }} @else N/A @endif</td>
        </tr>
        <tr>    
            <td>Reference Property :</td>
            <td>@if($propertyname != NULL && $propertyname != '') {{ ucfirst($propertyname) }} @else N/A @endif</td>
        </tr>
        <tr>    
            <td>Best Time To Call :</td>
            <td>@if($inquirydetails->contact_timetocall != NULL && $inquirydetails->contact_timetocall != '') {{ ucfirst($inquirydetails->contact_timetocall) }} @else N/A @endif</td>
            
        </tr>
        <tr>
        	<td>Message :</td>
            <td>@if($inquirydetails->contact_message != NULL && $inquirydetails->contact_message != '') {{ ucfirst($inquirydetails->contact_message) }} @else N/A @endif</td>
        </tr>
    </table>
    <br/>
    <p>With Regards,<br/>
    Efficient Corporate.</p>
</body>
</html>
