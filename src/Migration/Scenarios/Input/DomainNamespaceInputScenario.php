<?php

namespace PhpLab\Database\Migration\Scenarios\Input;

use Symfony\Component\Console\Question\Question;

class DomainNamespaceInputScenario extends BaseInputScenario
{

    protected function paramName()
    {
        return 'domainNamespace';
    }

    public function isRequired(): bool
    {
        return true;
    }

    protected function question(): Question
    {
        $question = new Question('Enter domain namespace: ');
        return $question;
    }

}
