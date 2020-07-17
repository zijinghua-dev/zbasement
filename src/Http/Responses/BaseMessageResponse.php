<?php


namespace Zijinghua\Zbasement\Http\Responses;

use Zijinghua\Zbasement\Http\Repositories\Contracts\CodeMessageRepositoryInterface;
use Zijinghua\Zbasement\Http\Resources\BaseResource;


/**
 * Class BaseMessageResponse
 * @package App\Http\Responses
 * 自定义信息结构在两个地方定义，其中一个是BaseMessageResponse，这里有一个messagebody数组，
 * 除了code，status，message，还有httpCode，这个对象是内部使用，可以包含更多内容
 * 另外一个地方是FoundationListResource，这里也有messagebody数组，但其中没有httpCode，
 * 因为FoundationListResource是转换数据集给外部响应的，所以仅仅只包含能传递给客户的内容
 */
class BaseMessageResponse
{
//    public $code=null;
    public $messageBody=null;
//    public $status=null;
    public $data=null;
    public $resourceClass=null;
//    public $httpCode=null;
    public $code=null;
//    public $status=null;
//    public $httpCode=null;
    public $message=null;

    protected function getStatus()
    {
        return $this->httpCode;
    }

    protected function getMessage()
    {
        return $this->message;;
    }

    public function set($code, $data, $resourceClass)
    {
        $this->code = $code;
        $this->resourceClass = $resourceClass;
        $this->data = $data;
    }

    private function loadMessageFromCode()
    {
//        if (!isset($this->messageBody['code'])) {
//            return;
//        }
//        if (isEmptyOrNullString($this->messageBody['code'])) {
//            return;
//        }
//        $messageBody = app()->make(CodeMessageRepositoryInterface::class)
//            ->getMessageBodyFromCode($this->messageBody['code']);
//        $this->assignArray(objectToArray($messageBody), $this->messageBody);
        if (!isEmptyOrNullString($this->exceptionMessage)) {
            if (!isEmptyOrNullString($this->messageBody['message'])) {
                $this->messageBody['message']=$this->messageBody['message'].' '.$this->exceptionMessage;
            } else {
                $this->messageBody['message']=$this->exceptionMessage;
            }
        }
//        $hasNewMessage=!isEmptyOrNullString($messageBody->message);
//        $hasOldMessage=!isEmptyOrNullString($this->message);
//
//        if ($hasNewMessage&&$hasOldMessage) {
//            $this->message=$messageBody->message." ".$this->message;
//        }
//        if ($hasNewMessage&&(!$hasOldMessage)) {
//            $this->message=$messageBody->message;
//        }
//
//        if (isset($messageBody->status)) {
//            $this->status=$messageBody->status;
//        }
//        if (!isZeroOrNullInteger($messageBody->httpCode)) {
//            $this->httpCode=$messageBody->httpCode;
//        }
    }

    protected function resource()
    {
//        if(isset())
//        $codeMessage=;
        $res=new BaseResource($this->data, objectToArray($this->code),$this->resourceClass);
//        $res=new $this->resourceClass($this->data);
//        $res=$res->response();
        $res=$res->response()->getData(true);
        return $res;
//        if (isset($this->data)&&isset($this->resourceClass)) {
//            $res=new $this->resourceClass($this->data, $this->messageBody);
//            return $res;
//        } else {
//            return array_merge(['data'=>null], $this->messageBody);
//        }
    }

    public function response()
    {
//        $this->loadMessageFromCode();

        if (isset($this->code->httpCode)&&(!empty($this->code->httpCode))) {
            $response= response()->json(
                $this->resource(),
                $this->code->httpCode,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        } else {
            $response= response()->json(
                $this->resource(),
                200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }
        return $response;
    }

    //根据$destinationArray的结构，从$sourceArray中获取数据
    public function assignArray($sourceArray, &$destinationArray)
    {
        foreach (array_keys($destinationArray) as $key) {
            if (isset($sourceArray[$key])) {
                $destinationArray[$key]=$sourceArray[$key];
            }
        }
//        return $destinationArray;
    }

    public function appendMessages($messages){
        if(is_array($messages)){
            $messages=implode(" ",$messages);
        }
        if(!isset($this->code)){
            $this->code=(object)['message'=>$messages];
        }elseif(isset($this->code->message)){
            $this->code->message=$this->code->message.' '.$messages;
        }
    }
}
