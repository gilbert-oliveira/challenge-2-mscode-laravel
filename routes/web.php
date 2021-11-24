<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UsersController;
use App\Models\Attachment;
use Illuminate\Support\Facades\Route;

//Rota para a página inicial do dashboard
Route::get('/', function () {
    return redirect(route('dashboard.home'));
});

// Grupo de rotas para o Dashboard
Route::prefix('dashboard')->group(function () {

    //Rota para a página inicial do Dashboard
    Route::get('/', function () {
        return redirect(route('dashboard.home'));
    });

    //Rota para a página inicial do Dashboard
    Route::get('home', [HomeController::class, 'getHome'])->name('dashboard.home');

    // Rota para listagem de usuários
    Route::get('usuarios', [UsersController::class, 'getUsers'])->name('dashboard.users');
    // Rota para cadastro de usuários
    Route::post('usuarios', [UsersController::class, 'postUsers'])->name('dashboard.users');

    // Rota para listagem de clientes
    Route::get('clientes', [CustomerController::class, 'getCustomers'])->name('dashboard.customers');
    // Rota para cadastro de clientes
    Route::post('clientes', [CustomerController::class, 'postCustomers'])->name('dashboard.customers');

    Route::delete('attachment/deletar/{id}', [AttachmentController::class, 'deleteAttachment'])->name('dashboard.attachment.delete');

    // Grupo de rotas para tickets
    Route::prefix('/tickets')->group(function () {

        // Rota para detalhes de um ticket
        Route::get('detalhes/{id}', [TicketController::class, 'detailTicket'])->name('dashboard.tickets.details');

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
    });
});
