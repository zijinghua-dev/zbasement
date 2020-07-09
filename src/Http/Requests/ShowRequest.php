<?php
/**
 * Created by PhpStorm.
 * User: shixiaoqing
 * Date: 2020-06-12
 * Time: 15:43
 */
namespace Zijinghua\Zbasement\Http\Requests;

//use App\Exceptions\ValidationException;
use Zijinghua\Zbasement\Rules\Has;
use Zijinghua\Zbasement\Http\Requests\FormRequestWithCode;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Validator;

class ShowRequest extends FormRequestWithCode
{
    protected $bread_action='show';
//    public function __construct(
//        array $query = [],
//        array $request = [],
//        array $attributes = [],
//        array $cookies = [],
//        array $files = [],
//        array $server = [],
//        $content = null
//    ) {
//        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
//        $this->errorCode= 'CODE_USER_SHOW_VALIDATION';
//    }
//
//    protected function loadRules()
//    {
////        $uuid = $this->route('uuid');
////        $this->offsetSet('uuid', $uuid);
//        $rules = getConfigValue('zbasement.validation.fields.uuid');
//        $rules['uuid'][] = new Has($this, ['field'=>'uuid','slug'=>'user']);
//        return $rules;
//    }
//
//    protected function loadMessages()
//    {
//        return getConfigValue('zbasement.validation.message.uuid');
//    }
//
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['uuid'] = $this->route('uuid');
        return $data;
    }
}
