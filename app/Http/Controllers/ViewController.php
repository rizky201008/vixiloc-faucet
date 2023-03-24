<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function claim($code)
    {
        $payouts = Address::paginate(10);
        switch ($code) {
            case 'fey':
                return view("fey", ["title" => "Claim","payout" => $payouts]);
                break;
            case 'trx':
                return view("trx", ["title" => "Claim","payout" => $payouts]);
                break;
            default:
                return "Cok";
                break;
        }
    }
    public function claimNow(Request $request, $code)
    {
        $request->validate(
            [
                "to" => "required",
                'g-recaptcha-response' => 'recaptcha'
            ]
        );

        $api = env("FAUCETPAY_API");

        switch ($code) {
            case 'fey':
                $currency = "FEY";
                break;
            case 'trx':
                $currency = "TRX";
                break;
            default:
                $currency = "";
                break;
        }
        $find = Address::where("address", $request->to)->latest()->first();
        if ($find == null) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://faucetpay.io/api/v1/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => [
                    'api_key' => $api,
                    'amount' => '100000',
                    'to' => $request->to,
                    'currency' => $currency
                ],
            ));
            $response = curl_exec($curl);

            curl_close($curl);
            $json = json_decode($response);
            switch ($json->status) {
                case 450:
                    return back()->with(["limit" => "The faucet has reached maximum daily limit, claim again tomorrow"]);
                    break;
                case 200:
                    $date = Carbon::now();
                    $next_minute = date('Y-m-d H:i:s', strtotime($date . ' +1 minute'));
                    $address = new Address();
                    $address->address = $request->to;
                    $address->crypto = strtoupper($code);
                    $address->next_payout = $next_minute;
                    $address->save();
                    return back()->with(["success" => "Faucet reward have been sent to your faucetpay account. Claim again at " . date("H:i:s", strtotime($next_minute)) . " UTC"]);
                    break;
                case 456:
                    return back()->with(["invalid" => "Your address is invalid or not from faucetpay.io. We only accept faucetpay.io address"]);
                    break;
                default:
                    # code...
                    break;
            }
        } else {
            $date_time = strtotime($find->next_payout);
            $current_time = strtotime(Carbon::now("UTC"));
            if ($current_time >= $date_time) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://faucetpay.io/api/v1/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => [
                        'api_key' => $api,
                        'amount' => '100000',
                        'to' => $request->to,
                        'currency' => $currency
                    ],
                ));
                $response = curl_exec($curl);

                curl_close($curl);
                $json = json_decode($response);
                switch ($json->status) {
                    case 450:
                        return back()->with(["limit" => "The faucet has reached maximum daily limit, claim again tomorrow"]);
                        break;
                    case 200:
                        $date = Carbon::now();
                        $next_minute = date('Y-m-d H:i:s', strtotime($date . ' +1 minute'));
                        $address = new Address();
                        $address->address = $request->to;
                        $address->crypto = strtoupper($code);
                        $address->next_payout = $next_minute;
                        $address->save();
                        return back()->with(["success" => "Faucet reward have been sent to your faucetpay account. Next payout 1 minutes"]);
                        break;
                    case 456:
                        return back()->with(["invalid" => "Your address is invalid or not from faucetpay.io. We only accept faucetpay.io address"]);
                        break;
                    default:
                        # code...
                        break;
                }
            } else {
                return back()->with(["time" => "Please wait for 1 minutes after last payouts"]);
            }
        }
    }
}
