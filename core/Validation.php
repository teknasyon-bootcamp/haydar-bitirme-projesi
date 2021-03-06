<?php

namespace Core;

use Core\Session\Session;

abstract class Validation
{
    protected const RULE_REQUIRED = 'required';
    protected const RULE_EMAIL = 'email';
    protected const RULE_MIN = 'min';
    protected const RULE_MAX = 'max';
    protected const RULE_MATCH = 'match';
    protected const RULE_UNIQUE = 'unique';
    protected const RULE_IMAGE = 'image';
    protected const RULE_MAX_SIZE = 'max_size';

    public array $errors = [];
    public array $realNames = [];

    public function validate(array $rules, ?array $realNames = [])
    {
        $this->realNames = $realNames;

        foreach ($rules as $paramName => $rules) {
            $rules = explode('|', $rules);

            foreach ($rules as $key => $rule) {
                $rulesArray = explode(':', $rule);
                $ruleName = $rulesArray[0];
                $ruleParameter =  $rulesArray[1] ?? null;
                if (self::RULE_REQUIRED === $ruleName && !isset($this->{$paramName})) {
                    $this->addError($paramName, "{{$paramName}} alanı gereklidir.");
                }
                if (self::RULE_EMAIL === $ruleName && !filter_var($this->{$paramName}, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($paramName, "{{$paramName}} alanı geçerli bir e-posta adresi olmalıdır.");
                }
                if (self::RULE_MIN === $ruleName && strlen($this->{$paramName}) < $ruleParameter) {
                    $this->addError($paramName, "{{$paramName}} alanı en az $ruleParameter kadar karakter içermelidir.");
                }
                if (self::RULE_MAX === $ruleName && strlen($this->{$paramName}) > $ruleParameter) {
                    $this->addError($paramName, "{{$paramName}} alanı en fazla $ruleParameter kadar karakter içermelidir.");
                }
                if (self::RULE_MATCH === $ruleName && $this->{$paramName} !== $this->{$ruleParameter}) {
                    $this->addError($paramName, "{{$paramName}} alanı {{$ruleParameter}} ile aynı olmalıdır.");
                }
                if (self::RULE_UNIQUE == $ruleName) {
                    $model =  Model::where(
                        [
                            $paramName => $this->{$paramName}
                        ],
                        $ruleParameter
                    );

                    if ($model != null) {
                        $this->addError($paramName, "Veritabanında zaten aynı {{$paramName}} ile başka bir kayıt mevcut.");
                    }
                }

                $allowedTypes = [
                    'image/png' => 'png',
                    'image/jpeg' => ['jpg', 'jpe', 'jpeg'],
                    'image/gif' => 'gif'
                ];

                if (self::RULE_IMAGE === $ruleName && !$this->{$paramName}->isValidMimeType($allowedTypes)) {
                    $this->addError($paramName, "{{$paramName}} png, jpg veya gif tipinde geçerli bir görsel olmalıdır.");
                }
                if (self::RULE_MAX_SIZE === $ruleName && $this->{$paramName}->size > $ruleParameter) {
                    $this->addError($paramName, "{{$paramName}} en fazla  $ruleParameter KB olabilir.");
                }
            }
        }

        if ($this->anyError()) {
            Session::flash('errors', $this->errors);

            setStatusCode(422);

            return back();
        }

        return true;
    }

    public function getRealName($key)
    {
        return $this->realNames[$key] ?? $key;
    }

    public function anyError()
    {
        return count($this->errors) > 0;
    }


    public function addError(string $paramName, string $message)
    {
        $this->errors[] = str_replace(
            ["{{$paramName}}", "{" . $paramName . "Confirm}"],
            [$this->getRealName($paramName), $this->getRealName($paramName . 'Confirm')],
            $message
        );
    }
}
