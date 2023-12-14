@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="card_number">Número do Cartão <span class="brend"></span></label>
                        <input type="text" class="form-control" name="card_number">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="card_name">Nome no Cartão</label>
                        <input type="text" class="form-control" name="card_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Mês de Expiração</label>
                        <input type="text" class="form-control" name="card_month">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="">Ano de Expiração</label>
                        <input type="text" class="form-control" name="card_year">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">Código de Segurança</label>
                        <input type="text" class="form-control" name="card_cvv">
                    </div>
                </div>

                <div class="col-md-12 installments form-group">

                </div>

                <button class="btn btn-success btn-lg processCheckout">Comprar</button>
            </form>
        </div>
    </div>
    @section('scripts')
     <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script src="{{asset('js/jquery.ajax.js')}}"></script>
        <script>
        const sessionId = "{{session()->get('pagseguro_session_code')}}";

        PagSeguroDirectPayment.setSessionId(sessionId);

        let amountTransaction = '{{$cartItems}}';
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brend');

        cardNumber.addEventListener('keyup', function(){
            if(cardNumber.value.length >= 6){
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function(res){

                        let imgFlag = `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png`;

                        document.querySelector('input[name=card_brand]').value = res.brand.name;

                        spanBrand.innerHTML = `<img src="${imgFlag}"></img>`;

                        getInstallments(amountTransaction, res.brand.name);
                    },
                    error: function(err){
                        console.log(err);
                    },
                    complete: function(res){
                        // console.log('Complete: ' + res)
                    }
                });
            }
        });

        let submitButton = document.querySelector('button.processCheckout');

        submitButton.addEventListener('click', function(){
            event.preventDefault();
            PagSeguroDirectPayment.createCardToken({
                cardNumber:      document.querySelector('input[name=card_number]').value,
                brand:document.querySelector('input[name=card_brand]').value,
                cvv:             document.querySelector('input[name=card_cvv]').value,
                expirationMonth: document.querySelector('input[name=card_month]').value,
                expirationYear:  document.querySelector('input[name=card_year]').value,
                success: function(res){
                    processPayment(res.card.token);
                },
                error: function(res){
                    console.log(res);
                },
            });
        });

        function processPayment(token){
            let data = {
                card_token: token,
                hash:  PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}'
            };

            $.ajax({
                type: 'POST',
                url: "{{route('checkout.proccess')}}",
                data: data,
                dataType: 'json',
                success: function(res){
                    toastr.success(res.data.message, 'Sucesso!');
                    window.location.href = "{{route('checkout.thanks')}}?order=" + res.data.order;
                },
                error: function(err){
                    console.log(err);
                }
            });
        }

        // function getInstallments(amount, brand){
        //     PagSeguroDirectPayment.getInstallments({
        //         amount: amount,
        //         maxInstallmentNoInterest: 0,
        //         brand: brand,
        //         success: function(res){
        //             let selectInstallments = drawSelectInstallments(res.installments[brand]);

        //             document.querySelector('.installments').innerHTML = selectInstallments;
        //         },
        //         error: function(err){
        //             console.log(err);
        //         },
        //         complete: function(res){

        //         },
        //     });
        // }

        function getInstallments(amount, brand){
            $.ajax({
                type: 'GET',
                url: `http://localhost:8000/checkout/installments/${amount}/${brand}`,
                success: function(res){
                    let selectInstallments = drawSelectInstallments(res);

                    document.querySelector('.installments').innerHTML = selectInstallments;
                },
                error: function(err){
                    console.log(err);
                }
            });
        }

        function drawSelectInstallments(installments){
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control select_installments">';

            for(let l of installments){
                select += `<option value="${l.quantity}|${l.amount}">${l.quantity}x de ${l.amount} - Total fica ${l.totalAmount}`;
            }

            select += '</select>';

            return select;
        }
    </script>
  @endsection
@endsection
