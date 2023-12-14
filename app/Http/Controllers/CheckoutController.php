<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\PagSeguro\CreditCard;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');

        if(!auth()->check()){
            return redirect()->route('login');
        }

        if(!session()->has('cart')){
            return redirect()->route('home');
        }

        $this->makePagSeguroSession();

        $total = 0;

        $cartItems = array_map(function($line){
            // $amount = str_replace(['.', ','], ['', '.'], $line['amount']);
            // $price = (float) str_replace(['.', ','], ['', '.'], $line['price']);

            return  $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request)
    {
        try{
            $dataPost = $request->all();
        $user = auth()->user();
        $cartItems = session()->get('cart');
        $reference = 'LIBPHP000001';

        $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
        $result = $creditCardPayment->doPayment();

        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 4,
        ];

        $user->orders()->create($userOrder);

        session()->forget('cart');
        session()->forget('pagseguro_session_code');

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido Criado com Sucesso!',
                'order' => $reference
            ]
        ]);

        }catch(\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido!';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }


    public function thanks()
    {
        return view('thanks');
    }

    private function makePagSeguroSession(){

        if(!session()->has('pagseguro_session_code')){

            $sessionCode = \PagSeguro\Services\Session::create(\PagSeguro\Configuration\Configure::getAccountCredentials());

            session()->put('pagseguro_session_code',$sessionCode->getResult());
        }
    }

    public function installments($amount, $brand)
    {
        $amountValidate = $amount = str_replace(['.', ','], ['', '.'], $amount);

        $options = [
        'amount' =>  $amountValidate,
        'card_brand' => $brand,
        'max_installment_no_interest' => 2,
        'shipping_address_required' => false,
        ];

    $result = \PagSeguro\Services\Installment::create(
        \PagSeguro\Configuration\Configure::getAccountCredentials(),
        $options
    );

    $installments = $result->getInstallments();

    $arrayOrganizado = [];

    foreach ($installments as $objeto) {
        $novoObjeto = [
            'cardBrand' => $objeto->getCardBrand(),
            'quantity' => $objeto->getQuantity(),
            'amount' => $objeto->getAmount(),
            'totalAmount' => $objeto->getTotalAmount(),
            'interestFree' => $objeto->getInterestFree()
        ];
        array_push($arrayOrganizado, $novoObjeto);
    }

    return $arrayOrganizado;

    }
}
