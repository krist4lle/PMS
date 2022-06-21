<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Requests\Me\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('me.index');
    }

    public function update(UpdateRequest $request)
    {
        $userChanges = $request->validated();
        $userChanges = $this->nullCheck($userChanges);



        auth()->user()->update($userChanges);

        return redirect(route('me.index'));
    }

    private function nullCheck($userChanges)
    {
        if (in_array(null, $userChanges, true) === true) {
            foreach ($userChanges as $field => $userChange) {
                if ($userChange === null) {
                    unset($userChanges[$field]);
                }
            }
        }

        return $userChanges;
    }
}
