<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_obat'  => 'required',
            'kategori'   => 'required|in:Tablet,Sirup', 
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga'      => 'required|numeric',
            'stok'       => 'required|integer',
            'deskripsis' => 'required',
        ];
    }
}
