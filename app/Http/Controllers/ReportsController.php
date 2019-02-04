<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ReportsRepositoryContract;

class ReportsController extends Controller
{
    public function clients(ReportsRepositoryContract $repositoryContract)
    {
        return $repositoryContract->clients();
    }
}
