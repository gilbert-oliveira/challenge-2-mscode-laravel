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

use Illuminate\Support\Facades\Mail;
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
Route::middleware(['auth:sanctum', 'check.active'])->get('/', function () {
    return redirect(route('dashboard.home'));
});

// Rota publica para visualizar um ticket
Route::get('/ticket/{token}', [TicketController::class, 'getDetailsPublic'])->name('public.ticket.details');

//Rota publica para cadastro de uma observação
Route::post('/ticket/{token}/observação/cadastrar', [ObservationController::class, 'postPublicObservation'])->name('public.observation.new');

// Grupo de rotas para o Dashboard
Route::prefix('dashboard')->middleware(['auth:sanctum', 'check.active'])->group(function () {

    //Rota para a página inicial do Dashboard
    Route::get('/', function () {
        return redirect(route('dashboard.home'));
    });

    //Rota para a página inicial do Dashboard
    Route::get('home', [HomeController::class, 'getHome'])->name('dashboard.home');

    //Rota para tela de alterar a senha
    Route::get('alterar-senha', [UsersController::class, 'getChangePassword'])->name('dashboard.change-password');
    //Rota para alterar a senha
    Route::post('alterar-senha', [UsersController::class, 'postChangePassword'])->name('dashboard.change-password');


    // Grupo de rotas para usuários
    Route::prefix('usuarios')->middleware(['check.admin'])->group(function () {

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
    // Rota para alteração de clientes
    Route::put('clientes', [CustomerController::class, 'putCustomers'])->name('dashboard.customers');

    // Rota para deletar o attachment
    Route::delete('attachment/deletar/{id}', [AttachmentController::class, 'deleteAttachment'])->name('dashboard.attachment.delete');

    // Grupo de rotas para tickets
    Route::prefix('tickets')->group(function () {

        // Rota para detalhes de um ticket
        Route::get('detalhes/{id}', [TicketController::class, 'detailTicket'])->name('dashboard.tickets.details');

        // Rota para listagem de tickets abertos
        Route::get('abertos', [TicketController::class, 'getOpenTickets'])->name('dashboard.tickets.open');

        //Rota para Tickets assumidos
        Route::get('assumidos', [TicketController::class, 'getAssumedTickets'])->name('dashboard.tickets.assumed');

        // Rota para listagem de tickets finalizados
        Route::get('finalizados', [TicketController::class, 'getFinishedTickets'])->name('dashboard.tickets.finished');

        // Rota para tela de cadastro de tickets
        Route::get('criar', [TicketController::class, 'newTickets'])->name('dashboard.tickets.new');
        // Rota para cadastro de tickets
        Route::post('criar', [TicketController::class, 'postTickets'])->name('dashboard.tickets.new');

        // Rota para adicionar um attachment a um ticket
        Route::post('attachment/{id}', [AttachmentController::class, 'postAttachment'])->name('dashboard.attachment.new');

        // Rota para assumir tickets
        Route::post('assumir', [TicketController::class, 'assumeTicket'])->name('dashboard.tickets.assume');
        // Rota para finalizar tickets
        Route::post('finalizar', [TicketController::class, 'finishTicket'])->name('dashboard.tickets.finish');

        // Rota para reabir tickets
        Route::post('reabrir', [TicketController::class, 'reopenTicket'])->name('dashboard.tickets.reopen');

        // Rota para transferir tickets
        Route::post('transferir', [TicketController::class, 'transferTicket'])->name('dashboard.tickets.transfer');

        // Rota para tela de cadastro de categorias de tickets
        Route::get('categorias', [CategoryController::class, 'getCategories'])->name('dashboard.tickets.categories');
        // Rota para cadastro de categorias de tickets
        Route::post('categorias', [CategoryController::class, 'postCategories'])->name('dashboard.tickets.categories');
        // Rota para deletar uma categoria de tickets
        Route::delete('categorias/deletar/{id}', [CategoryController::class, 'deleteCategory'])->name('dashboard.tickets.categories.delete');
        // Rota para editar uma categoria de tickets
        Route::put('categorias/editar/{id}', [CategoryController::class, 'editCategory'])->name('dashboard.tickets.categories.edit');

        // Rota para cadastro de observações de um ticket
        Route::post('observacao/cadastrar', [ObservationController::class, 'postObservation'])->name('dashboard.tickets.observation');
    });
});
