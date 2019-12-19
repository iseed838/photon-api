<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 16:34
 */

namespace Photon\Models;


use Photon\Exceptions\InvalidConfigException;
use Photon\Traits\ArrayableTrait;
use Photon\Traits\ConfigurableTrait;
use Rakit\Validation\Validation;
use Rakit\Validation\Validator;

abstract class BaseModel
{
    use ConfigurableTrait, ArrayableTrait;

    /**
     * Validate model
     * @param array $rules
     * @param array $messages
     * @return Validation
     */
    public function validate(array $rules, array $messages = []): Validation
    {
        $validator  = new Validator();
        $validation = $validator->make($this->toArray(), $rules, $messages);
        $validation->validate();

        return $validation;
    }

    /**
     * Failed validation throw exception
     * @param array $rules
     * @param array $messages
     * @throws InvalidConfigException
     */
    public function validateOrExcept(array $rules, array $messages = [])
    {
        $validation = $this->validate($rules, $messages);
        if ($validation->fails()) {
            $errors = $validation->errors->firstOfAll();
            throw new InvalidConfigException(array_shift($errors));
        }
    }


}