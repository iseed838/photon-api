<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 06.06.19
 * Time: 17:29
 */

namespace Photon\Traits;

use Photon\Exceptions\ValidException;
use Rakit\Validation\Validator;

/**
 * Validate trait
 * Trait Configurable
 */
trait ValidatorTrait
{
    use ArrayableTrait;

    /**
     * Validate rules
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
     * Check validation rules
     * @param array $rules
     * @param array $messages
     * @param Validator|null $validator
     * @throws \Photon\Exceptions\ValidException
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