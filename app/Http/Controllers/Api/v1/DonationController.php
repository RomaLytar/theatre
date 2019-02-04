<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Donation;
use App\Models\LiqPay;
use App\Repositories\DonationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    protected $donationRepository;

    public function __construct(DonationRepository $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    public function store(Request $request) {
        $data = $request->input('data');
        $responseSignature = $request->input('signature');
        $publicKey = env('LIQ_PAY_PUBLIC_KEY');
        $privateKey = env('LIQ_PAY_PRIVATE_KEY');

        $signature = base64_encode( sha1(
            $privateKey .
            $data .
            $privateKey
            , 1 ));

        if(!$signature === $responseSignature) {
            return response()->json([
                'status' => false
            ]);
        }

        $liqPay = new LiqPay($publicKey, $privateKey);
        $data = $liqPay->decode_params($data);

        if(!$donation = Donation::where('payment_id', $data['payment_id'])->first()) {
            $this->donationRepository->createDonation($data);
        } else {
            $this->donationRepository->editDonation($data, $donation->id);
        }

        return response()->json([
            'status' => true
        ]);
    }
}
