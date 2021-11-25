<?php

use App\Http\Controllers\{
    AttachmentController,
    CategoryController,
    CustomerController,
    HomeController,
    ObservationController,
    TicketController,
    UsersController,
};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rota para a página inicial do dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return redirect(route('dashboard.home'));
});

// Grupo de rotas para o Dashboard
Route::prefix('dashboard')->middleware(['auth:sanctum', 'verified'])->group(function () {

    //Rota para a página inicial do Dashboard
    Route::get('/', function () {
        return redirect(route('dashboard.home'));
    });

    //Rota para a página inicial do Dashboard
    Route::get('home', [HomeController::class, 'getHome'])->name('dashboard.home');

    // Grupo de rotas para usuários
    Route::prefix('usuarios')->group(function () {

        // Rota para listagem de usuários
        Route::get('/', [UsersController::class, 'getUsers'])->name('dashboard.users');
        // Rota para cadastro de usuários
        Route::post('/', [UsersController::class, 'postUsers'])->name('dashboard.users');

        // Rota para desativação de usuários
        Route::post('desativar', [UsersController::class, 'disableUser'])->name('dashboard.users.disable');

        //Rota para ativação de usuários
        Route::post('ativar', [UsersController::class, 'enableUser'])->name('dashboard.users.enable');
    });


    // Rota para listagem de clientes
    Route::get('clientes', [CustomerController::class, 'getCustomers'])->name('dashboard.customers');
    // Rota para cadastro de clientes
    Route::post('clientes', [CustomerController::class, 'postCustomers'])->name('dashboard.customers');

    // Rota para deletar o attachment
    Route::delete('attachment/deletar/{id}', [AttachmentController::class, 'deleteAttachment'])->name('dashboard.attachment.delete');

    // Grupo de rotas para tickets
    Route::prefix('tickets')->group(function () {

        // Rota para detalhes de um ticket
        Route::get('detalhes/{id}', [HomeController::class, 'detailTicket'])->name('dashboard.tickets.details');

        // Rota para listagem de tickets abertos
        Route::get('abertos', [TicketController::class, 'getOpenTickets'])->name('dashboard.tickets.open');

        // Rota para listagem de tickets finalizados
        Route::get('finalizados', [TicketController::class, 'getOpenTickets'])->name('dashboard.tickets.finished');

        // Rota para tela de cadastro de tickets
        Route::get('criar', [TicketController::class, 'newTickets'])->name('dashboard.tickets.new');
        // Rota para cadastro de tickets
        Route::post('criar', [TicketController::class, 'postTickets'])->name('dashboard.tickets.new');

        // Rota para tela de cadastro de categorias de tickets
        Route::get('categorias', [CategoryController::class, 'getCategories'])->name('dashboard.tickets.categories');
        // Rota para cadastro de categorias de tickets
        Route::post('categorias', [CategoryController::class, 'postCategories'])->name('dashboard.tickets.categories');

        // Rota para cadastro de observações de um ticket
        Route::post('observacao/cadastrar', [ObservationController::class, 'postObservation'])->name('dashboard.tickets.observation');
    });
});
