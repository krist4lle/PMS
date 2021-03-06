<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use App\Service\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::withCount('projects')->paginate(10);

        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    public function create()
    {
        $this->authorize('create', Client::class);

        return view('clients.create');
    }

    public function store(StoreRequest $request, ClientService $service)
    {
        $this->authorize('create', Client::class);

        $clientData = $request->validated();
        $service->clientSave(new Client(), $clientData);

        return redirect()->route('clients.index')->with('success', 'New Client added');
    }

    public function show(Client $client)
    {
        $client->load('projects', 'projects.manager');

        return view('clients.show', [
            'client' => $client,
        ]);
    }

    public function edit(Client $client)
    {
        $this->authorize('update', $client);

        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function update(UpdateRequest $request, Client $client, ClientService $service)
    {
        $this->authorize('update', $client);
        $clientData = $request->validated();
        $service->clientSave($client, $clientData);

        return redirect()->back()->with('success', 'Client successfully updated');
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client successfully deleted');
    }
}
