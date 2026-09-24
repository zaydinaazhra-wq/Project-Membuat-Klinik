<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_obat'  => 'required|string|max:255',
            'kategori'   => 'required|string',
            'harga'      => 'required|numeric',
            'stok'       => 'required|integer',
            'deskripsis' => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ];
    }
}
