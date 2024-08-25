# APLIKASI SIMPLE-CASHIER

Jika Anda merasa repositori ini bermanfaat dan ingin menggunakannya, silakan pertimbangkan untuk memberikan bintang. Ini akan menunjukkan dukungan Anda terhadap repositori ini dan membantu orang lain menemukannya.

## Persyaratan Pengembangan Situs Web Ini

Berikut adalah apa yang perlu Anda unduh untuk pertama kali jika Anda ingin mengembangkan situs web ini dengan kode sumber terbaru saya:

- [Composer 2.7.5](https://getcomposer.org/)
- [CodeIgniter 4 4.5.4](https://github.com/codeigniter4/CodeIgniter4/releases/tag/v4.5.4)
- [XAMPP 8.2.12 Windows](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/)
- [Git](https://git-scm.com/downloads)

## Fitur

- Login untuk admin dan kasir
- Kasir dapat membuat tagihan, melihat list tagihan, melihat detail tagihan dan melihat stok produk
- Admin dapat melakukan semua kegiatan kasir, menghapus dan mengubah data produk, mengelola akun kasir dan dapat membuat akun untuk kasir
- Admin dapat menambahkan atau mengubah data metode pembayaran
- Tampilan website responsif

## Apa yang Saya Gunakan dalam Situs Web Ini ?

- CodeIgniter 4 v4.5.4
- Template SB Admin Bootstrap
- Myth/Auth v1.2.1

## Pengaturan

- Pastikan bahwa Anda sudah menginstal semua persyaratan pengembangan situs web di atas.
- [<b>Download](https://github.com/ImperFecti/simple-cashier/archive/refs/heads/master.zip) file proyek ini </b> dan ekstrak di mana pun Anda inginkan.
  -Atau Anda dapat menggunakan <b>git</b> dengan `git bash here` ke folder yang ditentukan dan mulai mengkloning repositori ini dengan perintah ini `git clone https://github.com/ImperFecti/simple-cashier.git`.
- Salin dan tempel file `env` lalu tempelkan kode ini untuk mengatur database:

```
# ENVIRONMENT

CI_ENVIRONMENT = development

# APP

app.baseURL = 'http://localhost:8080'
# If you have trouble with `.`, you could also use `_`.
# app_baseURL = ''
# app.forceGlobalSecureRequests = false
# app.CSPEnabled = false

# DATABASE

database.default.hostname = localhost
database.default.database = simple-cashier
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

- Untuk mengimpor database, buka [`phpmyadmin`](http://localhost/phpmyadmin) dan buat database baru dengan nama `bayarlistrik`.
- Di [`phpmyadmin`](http://localhost/phpmyadmin), pilih database `bayarlistrik` yang Anda buat dan kemudian pilih impor.
- Impor database bernama `bayarlistrik.sql` di dalam file direktori `APPPATH\app\Database`.
- itus web ini saat ini menggunakan [`http://localhost:8080/`](http://localhost:8080/) dari spark. Untuk memulai localhost dengan [spark](https://codeigniter.com/user_guide/cli/spark_commands.html), jalankan perintah ini `php spark serve` dari terminal Anda untuk mengaktifkan localhost.
- Jika Anda ingin mengembangkan situs web ini menggunakan XAMPP, Anda dapat mengubah <b>baseURL</b> di `App.php` dan pastikan file proyek disimpan di `htdocs`.

## Akun Admin

Jika Anda menggunakan database yang telah saya sediakan, Anda dapat menggunakan akun admin yang telah terdaftar di bawah ini:

- Username `admin` password `letslogintoadminaccount`
- Username `admin2` password `letslogintoadminaccount`
- Username `cashier2` password `letslogintocashieraccount`
- Username `cashier3` password `letslogintocashieraccount`

## Pengaturan Library Myth\Auth

- Jalankan `composer update` dari terminal untuk memperbarui dependensi dengan <b>composer</b>.
- Setelah pembaruan selesai, Anda dapat menemukan folder bernama `myth\auth` di dalam `APPPATH\app\Vendor` dan mulai mengatur pustaka ini.
- Jika Anda tidak dapat menemukan pustaka di dalam `Vendor`, coba jalankan perintah ini di dalam terminal.

```
composer require myth/auth
```

- Temukan `Auth.php` di dalam `Vendor\myth\auth\Config\` dan ubah variabel di bawah ini

### Grup Pengguna Default

Ubah nilai variabel `$defaultUserGroup` menjadi:

```
public $defaultUserGroup = 'cashier';
```

### Views

Ubah nilai variabel `$views` menjadi:

```
public $views = [
    'login'       => 'Myth\Auth\Views\login',
    'register'    => 'Myth\Auth\Views\register',
    'forgot'      => 'Myth\Auth\Views\forgot',
    'reset'       => 'Myth\Auth\Views\reset',
    'emailForgot' => 'Myth\Auth\Views\emails\forgot',
];
```

## Allow User Registration

Ubah nilai variable `$allowRegistration`

```
public $allowRegistration = false;
```

### Allow Password Reset via Email

Ubah nilai variabel `$activeResetter` menjadi:

```
public $activeResetter = null;
```

## Preview

- Login
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1276160637466050682/login.png?ex=66c884b5&is=66c73335&hm=335eace5f872eab9869d4147a8575bf128be8efd557452714d35c31b7d567202&)

- Dashboard
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1277203881071349760/dashboard1.png?ex=66cc504e&is=66cafece&hm=654939f704459d663f210fb3ce0be8986aba2b50515be84a01f81f10468bd3cf&)

  ![](https://cdn.discordapp.com/attachments/563035937949483008/1277203881398501419/dashboard2.png?ex=66cc504e&is=66cafece&hm=649c7bb379c1f89d548f52f8bc20c6eb1b1ad6441de824814263944c2a20bd3f&)

- Profile
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1276160637004939378/profile.png?ex=66c884b5&is=66c73335&hm=4582f46bc5b02c7f19b7693e7f6f960c664bb1aced39dff7fdea1bb7ca09eb9f&)

- Tabel Transaksi
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1276160635570487329/datatagihan.png?ex=66c884b5&is=66c73335&hm=18af267c65f9f4e05c9dac7a1811c28ccac938b27afcb6e12c91bb10ed663771&)

- Tabel Kasir
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1276160635893452902/datakasir.png?ex=66c884b5&is=66c73335&hm=b3860315dc7981df85ce0c6e78f3275192e6a358927011c80ab0ecaaa790b7d2&)

- Tabel Produk
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1276160636207894530/dataproduk.png?ex=66c884b5&is=66c73335&hm=f4be76b65c5c9c92b7bc10046b6513f6d362e354efdf4269fcf77ac83cf16537&)

- Tabel Metode Pembayaran
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1277203881998159946/tablepembayaran.png?ex=66cc504e&is=66cafece&hm=927a3adfe97a4d8ce2366fd895c577bd11df7621eb6fabf0e7369a84e4a88fe9&)

- Bukti Tagihan
  ![](https://cdn.discordapp.com/attachments/563035937949483008/1277203881708748860/buktitagihan.png?ex=66cc504e&is=66cafece&hm=5f508d9bf3dba07de395167968e8bde67517b32aad19ce786879705ab89463ec&)

## Menemukan masalah saat mengembangkan aplikasi ini?

Buat [issue](https://github.com/ImperFecti/simple-cashier/issues) baru untuk repositori ini atau Anda dapat mencoba menghubungi [email](mailto:adilm8909@gmail.com) / [instagram](https://www.instagram.com/_adilsputra/) / [twitter](https://twitter.com/_adilsputra)

## Ingin berkontribusi pada repositori ini?

Saya menyadari bahwa repositori ini masih belum sempurna dan belum optimal. Jika Anda memiliki ide untuk meningkatkan repositori ini, <b>[Fork](https://github.com/ImperFecti/simple-cashier/fork)</b> halaman repositori ini untuk membuat salinan repositori Anda sendiri di akun GitHub Anda.
