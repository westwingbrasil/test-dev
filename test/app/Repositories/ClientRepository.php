<?

namespace App\Repositories;

use App\Abstracts\Repository as AbstractRepository;

class ClientRepository extends AbstractRepository implements RepositoryInterface
{
    protected $modelClassName = 'Client';
}