<?php

namespace PhpLab\Database\Migration\Enums;

use PhpLab\Core\Domain\Base\BaseEnum;

class GenerateActionEnum extends BaseEnum
{

    const CREATE_TABLE = 'create table';
    const ADD_COLUMN = 'add column';

}