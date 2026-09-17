#SADENA RESTAURANT

## Cara Instalasi
1. masuk ke branch kalian masing masing
2. cloning repo ini ke dalam folder www/htdocs dengan cara ketik : `git clone https://github.com/sukmaningrumdewi-bit/sadena-restoran.git`
3. lalu setelah tercloning, masuk ke vscode dan ketik : `composer install` di cmd atau terminal vscode
4. lalu setelah berhasil silahkan ketik : `copy .env.example .env` di cmd atau terminal vscode
5. setelah ter-copy buka file env lalu ganti bagian DB_DATABASE nya
6. setelah sudah diganti nama yang sesuai langsung ketik : `php artisan key:generate`
7. setelaah berhasil kalian ketik : `php artisan migrate`
8. lalu coba jalankan `php artisan serve`
