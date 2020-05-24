<?php

namespace PhpLab\Database\Migration\Repositories\File;

use PhpLab\Database\Migration\Entities\GenerateEntity;
use PhpLab\Database\Migration\Interfaces\Repositories\GenerateRepositoryInterface;

class GenerateRepository implements GenerateRepositoryInterface
{

    protected $tableName = 'migration_generate';

    public function getEntityClass(): string
    {
        return GenerateEntity::class;
    }
}
