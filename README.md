# SnapBite
Merupakan sebuah sistem pemesanan delivery yang menampilkan berbagai pilihan restoran beserta daftar makanan yang disediakan oleh masing-masing restoran. Data restoran beserta data makanannya tersebut diperoleh dari [domain sistem manajemen restoran](https://github.com/filbertfelim/TST-SistemRestoran). Sistem akan mengolah data lokasi restoran dengan data lokasi pelanggan untuk menampilkan jarak antara lokasi restoran dengan lokasi pelanggan. Sistem ini juga menyediakan pilihan bagi pelanggan untuk melakukan filter pencarian restoran berdasarkan kategori kalori. Pelanggan dapat menambahkan menu yang ingin dipesannya dari suatu restoran ke keranjang pesanan. Sistem akan melakukan perhitungan biaya tambahan yang meliputi biaya pengantaran dan biaya pemesanan berdasarkan jarak antara lokasi restoran dengan lokasi pelanggan dan waktu pemrosesan makanan yang dipesan oleh pelanggan, yang merupakan core domain dari sistem ini. Berdasarkan harga makanan dan perhitungan biaya tambahan tersebut, sistem dapat menampilkan total harga yang harus dibayarkan oleh pelanggan. Sistem hanya menerima satu metode pembayaran, yaitu pembayaran digital menggunakan saldo yang dimiliki oleh pelanggan pada platform pemesanan delivery tersebut. Pemesanan hanya dapat dilakukan apabila saldo yang dimiliki oleh pelanggan mencukupi. Ketika pelanggan melakukan pemesanan, saldo tersebut akan secara otomatis berkurang. Sistem ini akan mencatat data pemesanan makanan tersebut, yang dapat diakses oleh [domain sistem manajemen restoran](https://github.com/filbertfelim/TST-SistemRestoran) terkait untuk mengetahui rekapitulasi pemesanan.

## Fitur
1. Sistem dapat melakukan autentikasi pengguna  
2. Sistem dapat menampilkan berbagai pilihan restoran beserta informasi kalori dan jarak
3. Sistem dapat melakukan filter restoran berdasarkan kategori kalori
4. Sistem dapat menampilkan daftar makanan yang tersedia pada restoran yang dipilih
5. Sistem dapat memasukkan makanan ke dalam keranjang pesanan
6. Sistem menyediakan pengelolaan makanan dalam keranjang pesanan
7. Sistem dapat menghitung dan menampilkan total harga pesanan
8. Sistem dapat menampilkan saldo pengguna
9. Sistem mencatat data pemesanan pengguna

## Teknologi
**Bahasa pemograman** : PHP
***Framework*** : CodeIgniter 4 
***Database*** : MySQL

## API Endpoint

| HTTP *Method*      | *Endpoint* | *Request body example*     | *Response body example*      | Description |
| ---        |    ----   |          --- |---        |    ----   |
| GET      |`/pemesananAPI/(:restoranID)`       | ```{“username”: string ,“password”: string}``` | ```{“id”: int,“orderDate”: string, “totalHarga”: int} [] | null```|Mengembalikan data pemesanan berdasarkan ID restoran yang diminta   |
| GET   | `/detailPemesananAPI/(:orderID)`| ```{“username”: string ,“password”: string}```      | ```{“id”: int,“namaMakanan”: string, “harga”: int,“jumlah”: int,“hargaPesanan”: int} | null```| Mengembalikan data detail pemesanan berdasarkan ID pemesanan yang diminta        |

#### 1. /pemesananAPI/(:restoranID)
Mengembalikan data pemesanan berdasarkan ID restoran yang diminta

HTTP *method* : **GET**

*Request body example*
```json
{
   “username”: string, 
   “password” : string
}
```
*Response body example*
```json
{
   “id”: int,
   “orderDate”: string, 
   “totalHarga”: int
} [] | null
```

#### 2. /detailPemesananAPI/(:orderID)
Mengembalikan data detail pemesanan berdasarkan ID pemesanan yang diminta

HTTP *method* : **GET**

*Request body example*
```json
{
   “username”: string, 
   “password” : string
}
```
*Response body example*
```json
{
   “id”: int,
   “namaMakanan”: string, 
   “harga”: int,
   “jumlah”: int,
   “hargaPesanan”: int
} | null
```


## Antarmuka Pengguna
### Sign In Page
![](https://lh7-us.googleusercontent.com/F8vuqjdsQnaD6SqGo0V-hCygUXdWtKg7JMnm3QVmuZRVCMM7ktCDIL51x8N4h6sgU4jrAsRrsFcW6MizjdpWcLhs6cP2PDpoaNhIA1j-olO319JfrqToQQda_oErraxA5I3bJ-l5B8NWc8pTtewHAD8)
### Restaurant Search Page
![](https://lh7-us.googleusercontent.com/syZ0Mwu66289b3FtfA5Ntmr08esUNhrdQlxBQSeGXkQq6QSp7ncvzNaBABWeFMEHuUvWGX7oLYMos4nM3oXTP6X9l-t-2Zkdo1VEsnM0O9dxuDlbEgRjWUC9Do_Fb6TyKNPXF9BAgMJ9T0aMKaJMUCQ)
### Restaurant Menu Search Page
![](https://lh7-us.googleusercontent.com/-G5f7--6lQcx3MLwNGH8VdTyIS9XKBfOb2BQlsmCzwY4iC-Ssb_LhLyk1I9u1Ruq_NOO9W4zhQN-cuomdjoq6FuFwQLeJijKorciOxSdPJfN-CEYXY6ascHs-DUcD4IUUL6AnKSz8PJAwJQI-3zQmNY)
### Orders Page
#### Tanpa pesanan
![](https://lh7-us.googleusercontent.com/1siBzXAGoCNEJJ9SPpKw0Dgo7fhiUCHwLw27ITRm9WcKZTyDBNe9F_bSNjxhke_s1sB8xeaiGrs9qNTNXQKXliP3IjjkRmFWMiwCtob7w0Xnt3WtUNqi5AvKjD2S_h2ZTMFxIuR9ofFBRr5-H8Hl-LU)
#### Dengan pesanan![](https://lh7-us.googleusercontent.com/Kge21unA6w1WhY37REeSL_5m6W9O0jt2kU-kC2FcotmnDHCRXv--YvBZdr_aeoSmJfzCKWnqUMCnTcFN2YqZ0BvXxf19uR66p-p_uWjokzov02XtiqUShK_DS-txEJdTDY-4V0k01S9ub-h6-kbTVpI)
## Database
Berikut skema ***database*** yang digunakan dalam sistem : ![](https://lh7-us.googleusercontent.com/W9ffIPl1-uaT6tA7csJibqVSC1LNyPAUUWo3NKbigzojMUQUtwBBj0_0LKCf_Wpu9drzXduh9MERmTDF--URDyfxS1iqwAa6X0Cdqn8v3vn9zT8oE42NUHGWbVlkZgaei-uazbNWqHxbAdO3QRffIf4)
