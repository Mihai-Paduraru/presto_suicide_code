<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:50',
            'description' => 'required|min:20|max:300',
            'category' => 'required',
            'price' => 'required|min:1|max:60000',
            'image' => 'image'
        ];
    }
    public function messages ()
    {
        return [
            'title.required' => 'Devi inserire il titolo dell\'annuncio',
            'title.min' => 'Il titolo deve essere lungo almeno 5 caratteri',
            'title.max' => 'Il titolo deve essere lungo al massimo 50 caratteri',
            'description.required' => 'Devi inserire una descrizione per il tuo annuncio',
            'description.min' => 'La descrizione deve essere lunga almeno 20 caratteri',
            'description.max' => 'La descrizione deve essere lunga al massimo 300 caratteri',
            'category.required' => 'Devi specificare una categoria per il tuo annuncio',
            'price.required' => 'Devi inserire un prezzo per il tuo annuncio',
            'price.min' => 'Il prezzo deve essere maggiore di zero',
            'price.max' => 'Il prezzo non può superare i 60000 euro',
            'image.image' => 'Il file deve essere un\'immagine',
        ];
    }
}
