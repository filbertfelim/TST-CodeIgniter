<!DOCTYPE html>
<html class="bg-white">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Makanan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('css/styles.css'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for the toast */
        #toast {
            display: none;
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem;
            background-color: #48BB78;
            color: white;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="w-screen h-screen">
        <?php include 'navbar.php'; ?>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mx-8 lg:mx-16 py-8">
            <div class="col-span-1 lg:col-span-2">
                <?php foreach ($restoran as $restoranitem) : ?>
                    <div class="flex flex-row space-x-4">
                        <figure class="w-[30%]"><img src="<?= $restoranitem['image']; ?>" alt="Foto" class="rounded-xl" /></figure>
                        <div class="flex flex-col space-y-2 my-auto md:py-4">
                            <h1 class="font-text text-lg md:text-2xl font-bold text-black"><?= $restoranitem['namaRestoran']; ?></h1>
                            <p class="font-text text-black"><?= $restoranitem['totalKalori']; ?> Kalori | <span class="distanceResult font-text text-black"></span></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-4 mx-8 lg:mx-16 pb-16">
            <div class="col-span-4">
                <div id="makananContainer" class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4">
                    <?php foreach ($makanan as $makananitem) : ?>
                        <!-- MAKANAN CARD -->
                        <div class="card shadow-xl">
                            <div class="my-4 mx-4 cardbody">
                                <h2 class="font-text font-bold text-black"><?= $makananitem['namaMakanan']; ?></h2>
                                <p class="font-text text-black"><?= $makananitem['kalori']; ?> Kalori | <span class="priceResult font-text text-black"></span></p>
                                <div class="card-actions justify-end">
                                    <button data-food-waktuproses="<?= $makananitem['waktuProses']; ?>" data-food-harga="<?= $makananitem['harga']; ?>" data-food-kalori="<?= $makananitem['kalori']; ?>" data-food-id="<?= $makananitem['id']; ?>" data-food-name="<?= $makananitem['namaMakanan']; ?>" data-restoran-id="<?= $makananitem['restoranId']; ?>" class="addtocart bg-[#FFCBCB] text-black font-semibold font-text w-12 h-8 hover:bg-[#ffacac] rounded-xl">+</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="toast"></div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var customerLokasiX = <?= json_encode($lokasiX) ?>;
        var customerLokasiY = <?= json_encode($lokasiY) ?>;
        var restoran = <?= json_encode($restoran) ?>;
        const restoranId = restoran[0]['id'];
        $(document).ready(function() {

            function showToast(message) {
                var toast = $('#toast');
                toast.text(message);
                toast.fadeIn();

                // Hide the toast after 2 seconds
                setTimeout(function() {
                    toast.fadeOut();
                }, 500);
            }

            $.ajax({
                type: 'GET',
                url: 'http://localhost:8081/restoranbyid/' + restoranId + '?username=richeese&password=richeese123',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        const distance = countDistance(item.lokasiX, item.lokasiY, customerLokasiX, customerLokasiY);
                        $('.distanceResult').eq(index).append(distance + " km");
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

            $('#makananContainer').on('click', '.addtocart', function() {
                // Get the restaurant ID from the data attribute
                var foodId = $(this).data('food-id');
                var foodWaktuProses = $(this).data('food-waktuproses');
                var foodHarga = $(this).data('food-harga');
                var foodKalori = $(this).data('food-kalori');
                var foodName = $(this).data('food-name');
                var resId = $(this).data('restoran-id');
                addToCart(foodId, resId, foodWaktuProses, foodHarga, foodKalori, foodName);
            });

            $.ajax({
                type: 'GET',
                url: 'http://localhost:8081/makananAPI/' + restoranId + '?username=richeese&password=richeese123',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        const formattedNumber = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0,
                        }).format(item.harga);
                        $('.priceResult').eq(index).append(formattedNumber);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

            function countDistance(x1, y1, x2, y2) {
                const deltaX = x2 - x1;
                const deltaY = y2 - y1;
                // Euclidean distance formula
                const distance = Math.sqrt(deltaX ** 2 + deltaY ** 2);
                const roundedDistance = distance.toFixed(1);
                return parseFloat(roundedDistance);
            }

            function addToCart(foodId, restoranId, foodWaktuProses, foodHarga, foodKalori, foodName) {
                // Make an AJAX request to add the food to the cart
                console.log(foodId);
                console.log(restoranId);
                $.ajax({
                    type: 'POST',
                    url: '/cart/addToCart',
                    data: {
                        foodId: foodId,
                        restoranId: restoranId,
                        foodWaktuProses: foodWaktuProses,
                        foodHarga: foodHarga,
                        foodKalori: foodKalori,
                        foodName: foodName,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showToast('Item added to cart successfully.');
                        } else {
                            alert('Failed to add food to cart.');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Error occurred while adding food to cart.');
                    }
                });
            }
        });
    </script>
</body>

</html>