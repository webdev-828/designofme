<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

use App\Http\Resources\UserCollection;
use App\Product;
use App\User;
use App\Order;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Iyzipay\Model\InstallmentInfo;
use Iyzipay\Model\Locale;
use Illuminate\Support\Facades\Redirect;
use App\Mail\TestEmail;


class CheckoutController extends Controller
{
    public function index() {
        return response()->json(User::all());
    }

    public function makeOrder(Request $request) {
        $name = $request->post('firstname').' '.$request->post('lastname');
        $email = $request->post('email');
        $phone = $request->post('phone');
        $country = $request->post('country');
        $city = $request->post('city');
        $zipcode = $request->post('zipcode');
        $address = $request->post('address');
        $size = $request->post('size');
        $color = $request->post('color');
        $product_key = $request->post('product_key');
        $product = Product::where('id', $product_key)->first();

        $base_url = request()->getSchemeAndHttpHost();;

        $price = "";
        $product_id = "";
        $user_id = "";

        if ($product){
            $price = $product['price'];
            $product_id = $product['id'];
            $user_id = $product['user_id'];
        }

        $order = new Order([
            'saler_id' => $user_id,
            'product_id' => $product_id,
            'size' => $size,
            'color' => $color,
            'quantity' => "1",
            'prize' => $price,
            'city' => $city,
            'country' => $country,
            'address' => $address,
            'zipcode' => $zipcode,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        $names = explode(" ", $name);

        $yo = new \Iyzipay\Options();

        $yo->setBaseUrl(env("IYZIPAY_BASE_URL"));
        $yo->setApiKey(env("IYZIPAY_API_KEY"));
        $yo->setSecretKey(env("IYZIPAY_SECRET_KEY"));

        $request_s = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $request_s->setLocale(\Iyzipay\Model\Locale::TR);
        $request_s->setConversationId("123456789");
        $price = $price * 6;
        $request_s->setPrice($price);
        $request_s->setPaidPrice($price);
        $request_s->setCurrency(\Iyzipay\Model\Currency::TL);
        $request_s->setBasketId("B67832");
        $request_s->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $request_s->setCallbackUrl($base_url."/api/designofme/order/status");
        // $request_s->setCallbackUrl("https://www.merchant.com/callback");
        $request_s->setEnabledInstallments(array(2, 3, 6, 9));

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId("BY789");
        $buyer->setName($names[0]);
        $buyer->setSurname('');
        if($name[1] !=""){
            $buyer->setSurname($names[1]);
        }
        $buyer->setGsmNumber($phone);
        $buyer->setEmail($email);
        $buyer->setIdentityNumber("74300864791");
        $buyer->setLastLoginDate("2015-10-05 12:43:35");
        $buyer->setRegistrationDate("2013-04-21 15:12:09");
        $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
        $buyer->setIp("85.34.78.112");
        $buyer->setCity($city);
        $buyer->setCountry($country);
        $buyer->setZipCode($zipcode);

        $request_s->setBuyer($buyer);
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName("Jane Doe");
        $shippingAddress->setCity($city);
        $shippingAddress->setCountry($country);
        $shippingAddress->setAddress($address);
        $shippingAddress->setZipCode($zipcode);
        $request_s->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName("Jane Doe");
        $billingAddress->setCity($city);
        $billingAddress->setCountry($country);
        $billingAddress->setAddress($address);
        $billingAddress->setZipCode($zipcode);
        $request_s->setBillingAddress($billingAddress);

        $basketItems = array();
        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        $firstBasketItem->setId("BI101");
        $firstBasketItem->setName("Binocular");
        $firstBasketItem->setCategory1("Collectibles");
        $firstBasketItem->setCategory2("Accessories");
        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        $firstBasketItem->setPrice($price);
        $basketItems[0] = $firstBasketItem;
        $request_s->setBasketItems($basketItems);

        $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request_s, $yo );

        $order->token = $checkoutFormInitialize->getToken();
        $order->status = 0;

        if($order->save() & $checkoutFormInitialize->getStatus() == "success") {
            return response()
                ->json([
                    'status' => 'success',
                    'token' => $checkoutFormInitialize->getToken(),
                    'message' => "Order created successfully",
                ]);
        }else{
            return response()
                ->json([
                    'status' => 'failed',
                    'message' => 'Failed to cretae an order',
                ]);
        }
    }

    public function orderCallback(Request $request) {
        $order = Order::where('token',$request->input('token'))->first();
        if($order){
            \Mail::send('emails.test', ['id'=>$order->id,'product_id'=>$order->product_id,'saler_id'=>$order->saler_id,'price'=>$order->prize,'size'=>$order->size,'name'=>$order->name,'address'=>$order->address,'city'=>$order->city,'zipcode'=>$order->zipcode,'country'=>$order->country,'email'=>$order->email,'phone'=>$order->phone], function($message) {
                $message->to('hello@designof.me', 'TestEmail')->subject('New Order Placed');
                $message->from('info@allaboutelectronics.co.in','New Order Placed');
            });

            Order::where('id', $order->id)
                ->update([
                    'status' => '1'
                ]);
            $base_url = request()->getSchemeAndHttpHost();
            $url = $base_url."/order/success/".$order->id."/".$order->saler_id."/".$order->size."/".$order->color;
            return Redirect::to($url);
        } else {
                $base_url = request()->getSchemeAndHttpHost();
                return Redirect::to($base_url);
        }
    }
}
