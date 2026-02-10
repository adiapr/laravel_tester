<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
        <script type="text/javascript"
        src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    </head>
  <body>

    <div class="container">
        <h1 class="my-3">Toko Durian</h1>
        <div class="card" style="width: 18rem;">
            <img src="https://t0.gstatic.com/licensed-image?q=tbn:ANd9GcRLjplh4TBl04Q3oPM5M4A1I4eRsqh86RLPx6zPbOw-aHtJ6_uKJZL7tt8O2aH5Jw5j" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Detail Pesanan</h5>
                <table>
                    <tr>
                        <td>Nama Pemesan</td>
                        <td>: {{ $order->name }}</td>
                    </tr>
                </table>
                {{ $snapToken }}
                <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>

                <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
                <div id="snap-container"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
          // Also, use the embedId that you defined in the div above, here.
          window.snap.embed(`{{ $snapToken }}`, {
            embedId: 'snap-container',
            onSuccess: function (result) {
              /* You may add your own implementation here */
              alert("payment success!"); console.log(result);
            },
            onPending: function (result) {
              /* You may add your own implementation here */
              alert("wating your payment!"); console.log(result);
            },
            onError: function (result) {
              /* You may add your own implementation here */
              alert("payment failed!"); console.log(result);
            },
            onClose: function () {
              /* You may add your own implementation here */
              alert('you closed the popup without finishing the payment');
            }
          });
        });
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>