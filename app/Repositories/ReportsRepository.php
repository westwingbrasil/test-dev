<?php

namespace App\Repositories;

use PHPJasper\PHPJasper;
use App\Models\Ticket;
use App\Models\Client;
use App\Repositories\Contracts\ReportsRepositoryContract;

class ReportsRepository implements ReportsRepositoryContract
{
    private $client;
    private $ticket;
    private $PHPJasper;
    private $dbConnection;
    private $tempPath;
    private $reportsPath;
    private $extension;
    private $reportModel;

    public function __construct(Client $client, Ticket $ticket, PHPJasper $PHPJasper)
    {
        $this->client = $client;
        $this->ticket = $ticket;
        $this->PHPJasper = $PHPJasper;

        $this->dbConnection = [
            'driver' => 'mysql',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD')
        ];

        $this->tempPath = env('DIR_TEMP');
        $this->reportsPath = public_path() . '/reports/';
        $this->extension = 'pdf';
        $this->reportModel = [
            'clients' => 'clients.jrxml',
        ];
    }

    public function clients()
    {
        $input = $this->reportsPath . $this->reportModel['clients'];
        $temp = time() . '_clients';
        $output = $this->tempPath . '/' . $temp;

        $options = [
            'format' => [$this->extension],
            'locale' => 'pt_BR',
            'db_connection' => $this->dbConnection
        ];

        $this->PHPJasper->process(
            $input,
            $output,
            $options
        )->execute();

        return $this->downloadReport($output, $this->extension, $temp);
    }

    private function downloadReport($output, $ext, $filename)
    {
        header('Content-Description: application/pdf');
        header('Content-Type: application/pdf');
        header('Content-Disposition:; filename=' . $filename . '.' . $ext);
        readfile($output . '.' . $ext);
        unlink(dirname($output) . '/' . $filename . '.' . $ext);
        flush();
        return;
    }
}