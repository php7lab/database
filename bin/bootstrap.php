<?php

use Symfony\Component\Console\Application;
use PhpLab\Database\Db\Helpers\Manager;

/**
 * @var Application $application
 */

$eloquentConfigFile = $_ENV['ELOQUENT_CONFIG_FILE'];
$capsule = new Manager(null, $eloquentConfigFile);

// --- Fixture ---

use PhpLab\Database\Fixture\Commands\ImportCommand;
use PhpLab\Database\Fixture\Commands\ExportCommand;
use PhpLab\Database\Fixture\Services\FixtureService;
use PhpLab\Database\Fixture\Repositories\DbRepository;
use PhpLab\Database\Fixture\Repositories\FileRepository;

// создаем сервис "Фикстуры" с внедрением двух репозиториев
$fixtureService = new FixtureService(new DbRepository($capsule), new FileRepository($eloquentConfigFile));

// создаем и объявляем команду "Экспорт фикстур"
$exportCommand = new ExportCommand(ExportCommand::getDefaultName(), $fixtureService);
$application->add($exportCommand);

// создаем и объявляем команду "Импорт фикстур"
$importCommand = new ImportCommand(ImportCommand::getDefaultName(), $fixtureService);
$application->add($importCommand);

// --- Migration ---

use PhpLab\Database\Migration\Services\MigrationService;
use PhpLab\Database\Migration\Services\GenerateService;
use PhpLab\Database\Migration\Repositories\File\GenerateRepository;
use PhpLab\Database\Migration\Repositories\HistoryRepository;
use PhpLab\Database\Migration\Repositories\SourceRepository;
use PhpLab\Database\Migration\Commands\UpCommand;
use PhpLab\Database\Migration\Commands\DownCommand;
use PhpLab\Database\Migration\Commands\GenerateCommand;

$migrationService = new MigrationService(new SourceRepository($eloquentConfigFile), new HistoryRepository($capsule));
$generateService = new GenerateService(new GenerateRepository);

// создаем и объявляем команду "UP"
$upCommand = new UpCommand(UpCommand::getDefaultName(), $migrationService);
$application->add($upCommand);

// создаем и объявляем команду "Down"
$downCommand = new DownCommand(DownCommand::getDefaultName(), $migrationService);
$application->add($downCommand);

// создаем и объявляем команду "Generate"
$downCommand = new GenerateCommand(GenerateCommand::getDefaultName(), $generateService);
$application->add($downCommand);

// --- Db ---

use PhpLab\Database\Db\Commands\DeleteAllTablesCommand;

// создаем и объявляем команду "deleteAllTables"
$deleteAllTablesCommand = new DeleteAllTablesCommand(DeleteAllTablesCommand::getDefaultName(), $fixtureService);
$application->add($deleteAllTablesCommand);
