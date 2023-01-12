<?php

use App\Models\Order;

$totalMoney = Cart::subtotal();
$transactionId = Transaction::insertGetId([
    'tr_user_id' => Auth::id(),
    'total' => $totalMoney,
    'note' => $request->note,
    'address' => $request->address,
    'phone' => $request->phone
])

if($transactionId){
    $products = Cart::content();
    foreach($products as $product){
        Order::insert([
            'or_transaction_id' => $transactionId,
            'or_product_id' => $product->id,
            'or_qty' => $product->qty,
            'or_price' => $product->price,
            'or_sale '  => $product->sale
        ])
    }
}


$price = $product->pro_price;
if($product->pro_price){
    $price = $price * (100-$product->pro_sale) / 100;
}

// checkout coupon
$today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
$data = $request->all();
$coupon = Coupon::where('coupon_code', $data['coupon'])
->where('coupon_code',$data['coupon'])
->where('coupon_status',1)
->where('coupon_date_end','>=',$now)
->first();

if($coupon){
    $count_coupon = $coupon->count();
    if($count_coupon>0){
        $coupon_session = Session::get('coupon');
        if($coupon_session == true){
            $is_available = 0;
            if($is_available==0){
                $cou[] = [
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_condition' => $coupon->coupon_condition,
                    'coupon_number' => $coupon->coupon_number
                ];
                Session::put('coupon',$cou);
            }
        }else{
            $cou[] = [
                'coupon_code' => $coupon->coupon_code,
                'coupon_condition' => $coupon->coupon_condition,
                'coupon_number' => $coupon->coupon_number
            ];
            Session::put('coupon',$cou);
        }
        Session::save();
        // add coupon success
    }
}else{
    // mã giảm giá o đúng
}

if(Session::get('coupon')){
    foreach (Session::get('coupon') as $key => $cou) {
        if($cou['coupon_condition'] == 1){
            ?>
                Mã giảm:
            <?php
            $cou['coupon_number'] ;
            ?>
            %
            <?php
            $total_coupon = ($total * $cou['coupon_number'])/100;
            echo "<p>Tổng giảm:</p>".number_format($total_coupon,0,',','.');
            echo "<p>Tổng đã giảm:</p>".number_format($total - $total_coupon,0,',','.');
        }elseif($cou['coupon_condition'] == 2){
            echo "Mã giảm".number_format($cou['coupon_number'],0,',','.') ."k" ;
            $total_coupon = $total -$cou['coupon_number'];
            echo number_format($total_coupon,0,',','.');
        }
    }
}


if($cou->coupon_date_end > $today){
    echo "Còn han";
}

// Confirm order
$data = $request->all();
$coupon = Coupon::where('coupon_code', $data['order_coupon'])
->first();
$coupon_coupon_used = $coupon->coupon_user.','.Auth::id();
$coupon->coupon_time = $cou->coupon_time -1;
$coupon->save();

?>
