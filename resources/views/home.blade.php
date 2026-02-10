<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <h1 class="my-3">Toko Durian</h1>
        <div class="card" style="width: 18rem;">
            <img src="https://t0.gstatic.com/licensed-image?q=tbn:ANd9GcRLjplh4TBl04Q3oPM5M4A1I4eRsqh86RLPx6zPbOw-aHtJ6_uKJZL7tt8O2aH5Jw5j" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Durian Lokal</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            
                <form action="/checkout" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="">Mau pesan berapa?</label>
                        <input type="number" name="qty" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">No Telp</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Alamat</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>