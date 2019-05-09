<?

namespace App\Repositories;

use App\Abstracts\Repository as AbstractRepository;

class OrderRepository extends AbstractRepository implements RepositoryInterfacee
{
    protected $modelClassName = 'Order';
}