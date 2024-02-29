<?php

namespace Src\Controllers;

use Illuminate\Support\Facades\DB;
use Src\Models\User;

class UserController
{

    public function index(): array
    {
        return User::with(['addresses.city.state'])->get()->toArray();
    }

    public function show(int $id): array
    {
        return User::with(['addresses'])->find($id)->toArray();
    }

    public function store(array $data)
    {
        try {
            $data['password'] = md5(sha1($data['password']));
            $user = User::create($data);
        }catch (\Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }

        return $user;
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);

        try {
            $data['password'] = md5(sha1($data['password']));
            $user->update($data);
        }catch (\Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }

        return $user;
    }

    public function destroy(int $id): array
    {
        $user = User::find($id);
        if(!$user instanceof User){
            return [
                'error' => 'User not found.'
            ];
        }

        try {
            $user->addresses()->delete();
            $user->delete();
        }catch (\Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }
        return [
            'success' => 'User has been deleted.'
        ];
    }

}
