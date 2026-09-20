SADENA RESTAURANT
Cara Instalasi
#masuk ke branch kalian masing masing

#cloning repo ini ke dalam folder www/htdocs dengan cara ketik : 'git clone https://github.com/sukmaningrumdewi-bit/sadena-restoran.git'

#lalu setelah tercloning, masuk ke vscode dan ketik : 'composer install' di cmd atau terminal vscode

#lalu setelah berhasil silahkan ketik : 'copy .env.example .env' di cmd atau terminal vscode

#setelah ter-copy buka file env lalu ganti bagian DB_DATABASE nya

#setelah sudah diganti nama yang sesuai langsung ketik : 'php artisan key:generate'

#setelah berhasil kalian ketik : 'php artisan migrate' untuk membuat struktur tabel

#selanjutnya, masukkan data awal (seed) ke dalam database dengan mengetik : 'php artisan db:seed'

#lalu coba jalankan php artisan serve
