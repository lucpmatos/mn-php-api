<?php

namespace Src\Controllers;

use Src\Models\Address;

class AddressController
{

    public function index(): array
    {
        return Address::with(['user','city.state'])->get()->toArray();
    }

    public function show(int $id): array
    {
        return Address::with(['user','city.state'])->find($id)->toArray();
    }

    public function store(array $data)
    {
        try {
            $address = Address::create($data);
        }catch (\Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }

        return $address;
    }

    public function update(int $id, array $data)
    {
        $address = Address::findOrFail($id);

        try {
            $address->update($data);
        }catch (\Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }

        return $address;
    }

    public function destroy(int $id): array
    {
        $address = Address::find($id);
        if(!$address instanceof Address){
            return [
                'error' => 'Address not found.'
            ];
        }

        if($address->delete()){
            return [
                'success' => 'Address has been deleted.'
            ];
        }

        return [
            'error' => 'Unable to delete address.'
        ];
    }

}
