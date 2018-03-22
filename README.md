# Install
1. Composer Install
2. buat database, misal "test"
3. rubah .env 
    a. DB_DATABASE = <sesuai nama DB yg barusan dibuat>
    b. DB_USERNAME = <sesuaikan dengan konfigurasi mesin anda>
    c. DB_PASSWORD = <sesuaikan dengan konfigurasi mesin anda>
 4. php artisan migrate
 
 # Penggunaan
 1. Fetching API provinsi & kota
    a. - php artisan fetchdata:list  => untuk memasukan semua data provinsi dan kota
 2. Fetching API provinsi
    a. untuk memasukan data provinse
      - 1. php artisan fetchdata:list province
      - 2. a. masukan id (number, range(1-34))provinsi jika ingin mengupdate salah satu data provinsi
           b. masukan/ketik 'all' atau ''(langsung enter) untuk mengganti/memasukan semua data provinsi
 3. Fetching API provinsi
    a. untuk memasukan data city
      - 1. php artisan fetchdata:list city
      - 2. a. masukan id (number, range(1-501))city jika ingin mengupdate salah satu data city
           b. masukan/ketik 'all' atau ''(langsung enter) untuk mengganti/memasukan semua data city
 
 4.  REST API
      a. masukan url "/search/provinces/{province_id}" => untuk mengambil data provinsi
      b. masukan url "/search/cities/{cities_id}" => untuk mengambil data city
