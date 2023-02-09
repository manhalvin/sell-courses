<?php

/**
 * Hàm tích hợp API VNPayment
 * @param mixed $order
 * @return void
 */
function VnPayment($order)
{
    $vnp_Url = env("VNP_URL");
    $vnp_Returner = env("VNP_RETURNER");
    $vnp_TmnCode = env('VNP_TMNCODE');
    $vnp_HashSecret = env("VNP_HASHSECRET");

    $vnp_TxnRef = $order->order_code;
    $vnp_OrderInfo = $order->id;
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = (($order->final_amount) * 100);
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_Bill_Email = $order->email;
    $fullName = trim($order->name);
    if (isset($fullName) && trim($fullName) != '') {
        $name = explode(' ', $fullName);
        $vnp_Bill_FirstName = array_shift($name);
        $vnp_Bill_LastName = array_pop($name);
    }
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returner,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
        "vnp_Bill_LastName" => $vnp_Bill_LastName,
        "vnp_Bill_Email" => $vnp_Bill_Email,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret); //
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '200'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        return $vnp_Url;
    }

}

function sendResponse($data, $message, $code = 200)
{
    $response = [
        'success' => true,
        'data' => $data,
        'message' => $message,
    ];

    if (!empty($status)) {
        $response['code'] = $code;
    }

    return response()->json($response, 200);
}
