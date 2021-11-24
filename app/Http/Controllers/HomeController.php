<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Exception;
use Carbon\Carbon;
use DateTimeZone, DatePeriod, DateTime, DateInterval;


class HomeController extends Controller
{

    /**
     * Método responsável por retornar os dias do mês atual.
     * @throws Exception
     */
    public static function getDaysTheMonth(): array
    {
        // Instancia a classe DateTime
        $now = Carbon::now(new DateTimeZone('America/Sao_Paulo'));

        // Retorna o dia inicial do mês atual
        $firstDayofPreviousMonth = $now->startOfMonth()->toDateTimeString();

        // Retorna o dia final do mês atual
        $lastDayofPreviousMonth = $now->endOfMonth()->toDateTimeString();

        //Gera um array com os dias do mês atual
        $period = new DatePeriod(
        // Data inicial
            new DateTime($firstDayofPreviousMonth),
            // Intervalo
            new DateInterval('P1D'),
            // Data final
            new DateTime($lastDayofPreviousMonth));

        // instancia um array vazio
        $arrayOfDays = [];

        // Percorre o array gerado
        foreach ($period as $date) {

            // Adiciona o dia do mês no array
            array_push($arrayOfDays, $date->format('Y-m-d'));
        }

        // Retorna o array com os dias do mês
        return $arrayOfDays;
    }

    /**
     * Método responsável por buscar os tickets do mês atual.
     * @throws Exception
     */
    private static function getTicketsByDay(): array
    {
        // Recupera os dias do mês atual
        $days = self::getDaysTheMonth();

        // Instancia um array vazio
        $tickets = [];

        // Percorre o array de dias
        foreach ($days as $day) {

            //Adiciona o ticket do dia no array
            array_push($tickets, Ticket::query()->whereDate('created_at', $day)->count());
        }

        // Formata o array
        $days = array_map(function ($day) {
            // retorna o dia formatado
            return date('d/m', strtotime($day));
        }, $days);

        // Retorna o array formatado com os dias e os tickets
        return array_combine($days, $tickets);
    }

    /**
     * Método responsável por retornar os tickets aberto.
     * @return int
     */
    private static function getOpenTickets(): int
    {

        // Retorna o total de tickets abertos
        return Ticket::all()->where('finished', false)->count();
    }

    /**
     * Método responsável por retornar os tickets fechados.
     * @return int
     */
    private static function getCompletedTickets(): int
    {
        // Retorna o total de tickets fechados
        return Ticket::all()->where('finished', true)->count();
    }

    /**
     * Método responsável por retornar os tickets reabertos.
     * @return int
     */
    private static function getReopenedTickets(): int
    {
        // Retorna o total de tickets reabertos
        return Ticket::all()->where('reopened', true)->count();
    }

    /**
     * Método responsável por retornar o conteúdo da view home.
     * @throws Exception
     */
    public function getHome()
    {

        //Retorna a view home com os dados
        return view('dashboard.home.home', [
            'open_tickets' => self::getOpenTickets(), // Tickets abertos
            'completed_tickets' => self::getCompletedTickets(), // Tickets fechados
            'reopened_tickets' => self::getReopenedTickets(), // Tickets reabertos
            'tickets_for_days' => self::getTicketsByDay(), // Array com os tickets por dia
        ]);
    }
}
