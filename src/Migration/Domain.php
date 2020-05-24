<?php

namespace PhpLab\Database\Migration;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'migration';
    }


}

