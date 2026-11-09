<?php
// $key = "ULPLB0VSUO";
// $salt = "TQRESSMLL4";
$key = "XB7MDSLRW";
$salt = "MZE7VLZV9";
$env = "test";


$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$amount = 1111;
$firstname = 'test';
$email = 'test@gmail.com';
$phone = 1232232332;
$productinfo = "Easebuzz PHP Demo Product";

$surl = "http://localhost/easebuzz_demo/response.php";
$furl = "http://localhost/easebuzz_demo/response.php";

$data = array(
    'key'         => $key,
    'txnid'       => $txnid,
    'amount'      => $amount,
    'productinfo' => $productinfo,
    'firstname'   => $firstname,
    'email'       => $email,
    'phone'       => $phone,
    'surl'        => $surl,
    'furl'        => $furl
);

$hashSequence = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;
$hash = strtolower(hash('sha512', $hashSequence));

$data['hash'] = $hash;

$easebuzz_url = ($env == "test")
    ? "https://testpay.easebuzz.in/payment/initiateLink"
    : "https://pay.easebuzz.in/payment/initiateLink";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $easebuzz_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit;
}

curl_close($ch);
 
$result = json_decode($response, true);

if (isset($result['status']) && $result['status'] == 1) {
    $payment_url = ($env == "test")
        ? "https://testpay.easebuzz.in/pay/" . $result['data']
        : "https://pay.easebuzz.in/pay/" . $result['data'];

    header("Location: $payment_url");
    exit;
} else {
    echo "<h3>Failed to create payment link</h3>";
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
