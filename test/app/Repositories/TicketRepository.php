<?

namespace App\Repositories;

use App\Abstracts\Repository as AbstractRepository;

class TicketRepository extends AbstractRepository implements RepositoryInterface
{
    protected $modelClassName = 'Ticket';
}