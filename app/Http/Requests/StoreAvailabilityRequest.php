<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvailabilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'interval' => ['required', 'integer', function ($attribute, $value, $fail) {
                $start_time = \Carbon\Carbon::createFromFormat('H:i', $this->start_time);
                $end_time = \Carbon\Carbon::createFromFormat('H:i', $this->end_time);
                $total_minutes = $end_time->diffInMinutes($start_time);
    
                if ($value > $total_minutes) {
                    $fail('The interval minutes cannot be greater than the difference between the start time and end time.');
                }
            }],
        ];
    }
}
