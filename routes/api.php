    <?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\RestaurantController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout')->middleware('verify.token');
        Route::post('refresh', 'refresh')->middleware('verify.token');

    });

    Route::get('/home',[HomeController::class,'index'])->middleware('auth:api');

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('hotels', \App\Http\Controllers\HotelController::class)->middleware(['auth:api','verify.token']);
    Route::post('bookRoom',[\App\Http\Controllers\BookingRoomController::class,'bookingRoom'])->middleware(['auth:api','verify.token']);

    Route::group(['middleware' => [ 'auth:api','verify.token']], function () {
        Route::get('restaurants', [RestaurantController::class, 'index']);
        Route::get('restaurant_details/{restaurant_id}', [RestaurantController::class, 'restaurantDetails']);
        Route::post('bookRestaurant/{id}', [RestaurantController::class, 'bookRestaurant']);
    });

