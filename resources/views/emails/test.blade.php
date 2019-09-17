<!DOCTYPE html>
    <html lang="en-US">
    	<head>
    		<meta charset="utf-8">
    	</head>
    	<body>
    	<style>
    		table td{
    			border : 1px solid #ddd;
			}
    	</style>
    		<h2 align="center">Your Order is successfully placed</h2>
    		<table style="margin:0px 10%;width:80%; border:1px solid #ddd" >
    			<tr>
    				<td ><b>Order No.</b> </td>
    				<td>{!!$id!!}</td>
    			</tr>
    			<tr>
    				<td><b>Product Id.</b> </td>
    				<td>{!!$product_id!!}/{!!$saler_id!!}</td>
    			</tr>
    			<tr>
    				<td><b>Price.</b></td>
    				<td>{!!$price!!}</td>
    			</tr>
    			<tr>
    				<td><b>Size</b>
    				<td>{!!$size!!}</td>
    			</tr>
    			<tr>
    				<td><b>Shipping Addrees</b>
    				<td><p>{!!$name!!}, <br/>
						   {!!$address!!}, <br/>
						   {!!$city!!}, <br/>
						   {!!$zipcode!!}, <br/>

						   {!!$country!!} <br/>
						   <br/>
						   {!!$email!!} <br/>
						   {!!$phone!!}

    				</p>


    				</td>
    			</tr>
    		</table>
    		<h6></h6>

    	</body>
    </html>
