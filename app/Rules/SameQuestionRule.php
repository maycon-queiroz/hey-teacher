<?php

namespace App\Rules;

use App\Models\Question;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SameQuestionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->validateRule($value)) {
            $fail('Pergunta já existe!');
        }
    }

    private function validateRule(mixed $value): bool
    {
        return Question::query()->where('question', $value)->exists();
    }
}
