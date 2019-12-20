<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 16:34
 */

namespace Photon\Models;


use Photon\Exceptions\ValidException;
use Photon\Traits\ArrayableTrait;
use Photon\Traits\ConfigurableTrait;
use Rakit\Validation\Validator;

abstract class BaseModel
{
    use ConfigurableTrait, ArrayableTrait;

    /**
     * @param array $rules
     * @param array $messages
     * @param Validator|null $validator
     * @return \Rakit\Validation\Validation
     */
    public function validate(array $rules, array $messages = [], Validator $validator = null)
    {
        if (is_null($validator)) {
            $validator = new Validator();
        }

        return $validator->validate($this->toArray(), $rules, $messages);
    }

    /**
     * @param array $rules
     * @param array $messages
     * @param Validator|null $validator
     * @throws ValidException
     */
    public function validateOrExcept(array $rules, array $messages = [], Validator $validator = null)
    {
        $validation = $this->validate($rules, $messages, $validator);
        if ($validation->fails()) {
            $errors = $validation->errors->firstOfAll();
            throw new ValidException(array_shift($errors));
        }
    }


}