<?php

namespace App\Service;

use App\Models\Client;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientService
{
    public function clientSave(Client $client, array $clientData): void
    {
        $client->title = $clientData['title'];
        $client->description = $clientData['description'];
        $client->email = $clientData['email'];
        $client->phone = '+' . $clientData['phone'];
        $client->save();
    }
}
