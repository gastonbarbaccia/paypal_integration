<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integracion de paypal</title>
</head>

<body>

    <div style="text-align: center;">
        <div id="paypal-button-container"></div>
    </div>

    

    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=MXN" data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'paypal',

                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: 11
                            }
                        }]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        var id_transaccion = orderData.id;

                        document.cookie = "id_trans="+ encodeURIComponent(id_transaccion);

                        window.location.replace("");


                    });
                },

                onError: function(err) {
                    //console.log(err);
                    window.location.replace("error.php");
                }
            }).render('#paypal-button-container');
        }


        initPayPalButton();
    </script>

</body>

</html>