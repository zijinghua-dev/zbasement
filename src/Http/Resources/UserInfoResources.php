<?php

namespace App\Http\Resources;

/**
 * Class UserInfoResources
 * @package App\Http\Resources
 * 1、所有resource 从FoundationListResource上继承
 * 2、返回数据集的时候，返回collection，如果不是collection，FoundationListResource会自己转成collection
 * 3、如果有字段不希望返回给用户，则填入$hiddenFields
 */
class UserInfoResources extends FoundationListResource
{
    protected $hiddenFields=['id','password'];
}
