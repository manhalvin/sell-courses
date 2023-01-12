<?php
public function confirm_order(Request $request){
    $data = $request->all();

    $shipping = new Shipping();
    $shipping->shipping_name = $data['shipping_name'];
    $shipping->shipping_email = $data['shipping_email'];
    $shipping->shipping_phone = $data['shipping_phone'];
    $shipping->shipping_address = $data['shipping_address'];
    $shipping->shipping_notes = $data['shipping_notes'];
    $shipping->shipping_method = $data['shipping_method'];
    $shipping->save();
    $shipping_id = $shipping->shipping_id;

    $checkout_code = substr(md5(microtime()),rand(0,26),5);


    $order = new Order;
    $order->customer_id = Session::get('customer_id');
    $order->shipping_id = $shipping_id;
    $order->order_status = 1;
    $order->order_code = $checkout_code;

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $order->created_at = now();
    $order->save();

    if(Session::get('cart')==true){
       foreach(Session::get('cart') as $key => $cart){
           $order_details = new OrderDetails;
           $order_details->order_code = $checkout_code;
           $order_details->product_id = $cart['product_id'];
           $order_details->product_name = $cart['product_name'];
           $order_details->product_price = $cart['product_price'];
           $order_details->product_sales_quantity = $cart['product_qty'];
           $order_details->product_coupon =  $data['order_coupon'];
           $order_details->product_feeship = $data['order_fee'];
           $order_details->save();
       }
    }
    Session::forget('coupon');
    Session::forget('fee');
    Session::forget('cart');
}


public function order_place(Request $request){
    //insert payment_method
    //seo
    $meta_desc = "Đăng nhập thanh toán";
    $meta_keywords = "Đăng nhập thanh toán";
    $meta_title = "Đăng nhập thanh toán";
    $url_canonical = $request->url();
    //--seo
    $data = array();
    $data['payment_method'] = $request->payment_option;
    $data['payment_status'] = 'Đang chờ xử lý';
    $payment_id = DB::table('tbl_payment')->insertGetId($data);

    //insert order
    $order_data = array();
    $order_data['customer_id'] = Session::get('customer_id');
    $order_data['shipping_id'] = Session::get('shipping_id');
    $order_data['payment_id'] = $payment_id;
    $order_data['order_total'] = Cart::total();
    $order_data['order_status'] = 'Đang chờ xử lý';
    $order_id = DB::table('tbl_order')->insertGetId($order_data);

    //insert order_details
    $content = Cart::content();
    foreach($content as $v_content){
        $order_d_data['order_id'] = $order_id;
        $order_d_data['product_id'] = $v_content->id;
        $order_d_data['product_name'] = $v_content->name;
        $order_d_data['product_price'] = $v_content->price;
        $order_d_data['product_sales_quantity'] = $v_content->qty;
        DB::table('tbl_order_details')->insert($order_d_data);
    }
    if($data['payment_method']==1){

        echo 'Thanh toán thẻ ATM';

    }elseif($data['payment_method']==2){
        Cart::destroy();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }else{
        echo 'Thẻ ghi nợ';

    }
?>
