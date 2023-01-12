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
if(Auth::id()){
    $coupon = Coupon::where('coupon_code', $data['coupon'])
->where('coupon_code',$data['coupon'])
->where('coupon_status',1)
->where('coupon_date_end','>=',$today)
->where('coupon_used','like','%'.Auth::id().'%')
->first();
    if($coupon){
    // mã giảm giá đã sử dung
    }else{
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
    // mã giảm giá chưa sử dung

    }
}else{
    $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
$data = $request->all();
$coupon_login = Coupon::where('coupon_code', $data['coupon'])
->where('coupon_code',$data['coupon'])
->where('coupon_status',1)
->where('coupon_date_end','>=',$today)
->first();
// $coupon_login = $coupon
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

<?php
    function checkout() {
        if (Cart::count() > 0) {
            $checkoutProducts = Cart::content();
            $totalPrice = Cart::total();
            $numProducts = Cart::count();
            return view('user.cart.checkout', compact('checkoutProducts', 'totalPrice', 'numProducts'));
        } else {
            return back();
        }
    }

    function postCheckout(Request $request) {
        $request->validate(
            [
                'fullname' => 'required|min:3',
                'phone' => 'required|digits_between:10,12',
                'email' => 'required|email',
                'calc_shipping_provinces' => 'required',
                'calc_shipping_district' => 'required',
                'address' => 'required|min:5'

            ],
            [
                'required' => ':attribute không được để trống',
                'alpha' => ':attribute chỉ chứa ký tự chữ',
                'min' => ':attribute có ít nhất :min ký tự',
                'digits_between' => ':attribute chỉ chứa số và phải nhập 10 số',
                'email' => ':attribute phải có định dạng email'
            ],
            [
                'fullname' => 'Họ tên',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'calc_shipping_provinces' => 'Tỉnh/Thành phố',
                'calc_shipping_district' => 'Quận/Huyện',
                'address' => 'Địa chỉ'
            ]
        );

        try {
            DB::beginTransaction();

            //Insert data customer
            $address = $request->address . ', ' . $request->calc_shipping_district . ', ' . $request->calc_shipping_provinces;
            $dataCustomer = [
                'name' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $address,
            ];
            $customer = Customer::create($dataCustomer);

            // Insert data order
            $orderId = 'IS-' . $this->createOrderId();
            $dataOrder = [
                'id' => $orderId,
                'customer_id' => $customer->id,
                'total' => Cart::total()
            ];
            Order::create($dataOrder);

            //Inset orderDetail
            $content = Cart::content();
            $dataOrderDetail = array();
            foreach ($content as $key => $value) {
                $dataOrderDetail['order_id'] = $orderId;
                $dataOrderDetail['product_id'] = $value->id;
                $dataOrderDetail['color'] = $value->options->color_name;
                $dataOrderDetail['quantity'] = $value->qty;
                OrderDetail::create($dataOrderDetail);
            }

            $data['info'] = $customer;
            $data['cart'] = Cart::content();
            $data['total'] = Cart::total();
            $data['orderId'] = $orderId;
            $emailCustomer = $dataCustomer['email'];
            $nameCustomer = $dataCustomer['name'];

            //Send Mail
            Mail::send('user.mail.orderConfirmation', $data, function ($message) use ($emailCustomer, $nameCustomer) {
                $message->from('phananhtai868@gmail.com', 'ISMART STORE');
                $message->to($emailCustomer, $nameCustomer);
                $message->subject('Xác nhận đơn hàng cửa hàng ISMART STORE');
            });

            Cart::destroy();

            DB::commit();
            return redirect()->route('user.complete');
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
        // dd($request->all());
    }

    function createOrderId() {
        do {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $string = '';
            $max = strlen($characters) - 1;
            for ($i = 0; $i < 8; $i++) {
                $string .= $characters[mt_rand(0, $max)];
            }
        } while (Order::where('id', 'like', "%IS-{$string}%")->first());
        return $string;
    }

    function complete() {
        return view('user.cart.complete');
    }
?>
