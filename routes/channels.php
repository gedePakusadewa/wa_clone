<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('notificat.{userId}', function ($user, $userId) {
    //return $friendId === strval(Auth::user()->id);
    //return $friendId === $user->id;
    //return true;
    return $user->name === "wick";

    //ibe berasumsi bahwa fitur broadcast sudah secara langsung mengirim broadcast ke channel dgn ruote yg sama tanpa perlu pegnecekan lagi di route/channel.php. Misal, di client nganggo route "userid.1" yg artinya channel userid dengan parameter 1. ada beberapa klien deng route berbeda yaitu "userid.2", "userid.3", "userid.4". kemudian ade broadcast uli server dengan isi channel 'userid.2' maka hasil broadcast langsung ditunjukkan ke klien dengan route "userid.2" (diasumsikan bahwa route/channel.php dengan return true), Pengecekan di route/channel.php hanya bertujuan untk melakukan verifikasi/validasi tambahan ke route klien (ibe konden nawang engken contoh ne untk aplikasi WA ne). Jadi untuk sementara route/channe.php langsung meberikan return true;
});
