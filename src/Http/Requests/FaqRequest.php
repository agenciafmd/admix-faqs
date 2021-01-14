<?php

namespace Agenciafmd\Faqs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function rules()
    {
        $data = [
            'is_active' => [
                'required',
                'boolean',
            ],
            'star' => [
                'required',
                'boolean',
            ],
            'name' => [
                'required',
                'max:150',
            ],
            'description' => [
                'required',
            ],
            'short_description' => [
                'nullable',
            ],
            'video' => [
                'nullable',
            ],
        ];

        if (config('admix-faqs.category')) {
            $data['category_id'] = [
                'required',
                'integer',
            ];
        }

        if (config('admix-faqs.call')) {
            $data['call'] = [
                'nullable',
                'max:250',
            ];
        }

        if (config('admix-faqs.published_at')) {
            $data['published_at'] = [
                'required',
                'date_format:Y-m-d\TH:i',
            ];
        }

        return $data;
    }

    public function attributes()
    {
        return [
            'is_active' => 'ativo',
            'category_id' => 'categoria',
            'star' => 'destaque',
            'name' => 'nome',
            'call' => 'chamada',
            'short_description' => 'resumo',
            'description' => 'descrição',
            'published_at' => 'data de publicação',
            'video' => 'vídeo',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
