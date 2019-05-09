<?

namespace App\Repositories;

class ClientRepository implements CreateRepositoryInterface
{

    /**
     * Create a ticket.
     *
     * @param array
     */
    public function create(\Illuminate\Http\Request $request): int
    {
        $client = App\Client::firstOrCreate(
            ['email' => $request->get('email_client')],
            ['name' => $request->get('name_client')]
        );

        return $client->id;
    }
}