<?php

namespace App\Containers\Documentation\UI\CLI\Commands;

use App\Containers\Documentation\Actions\GenerateDocumentationAction;
use App\Ship\Parents\Commands\ConsoleCommand;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class GenerateApiDocsCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GenerateApiDocsCommand extends ConsoleCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "hive:docs";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate API Documentations (using API-Doc-JS)";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $transporter = new DataTransporter();
        $transporter->setInstance("command_instance", $this);

        Hive::call(GenerateDocumentationAction::class, [$transporter]);
    }

}
