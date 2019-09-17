<?php

return [
	'baseUrl'       => env( 'IYZIPAY_BASE_URL', '' ),
	'apiKey'        => env( 'IYZIPAY_API_KEY', '' ),
	'secretKey'     => env( 'IYZIPAY_SECRET_KEY', '' ),
	'billableModel' => 'App\User'
];