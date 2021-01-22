<?php

namespace App\Console\Commands\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantMigrationsCommand extends Command
{
    protected $signature = "tenants:migrate {id?} {--refresh}";
    protected $description = "Run migration tenants";
    private $managerTenant;

    public function __construct(ManagerTenant $managerTenant)
    {
        parent::__construct();
    
        $this->managerTenant = $managerTenant;
    }

    public function handle()
    {
        $command = $this->option('refresh')?'migrate:refresh': 'migrate';

        if($this->argument('id')) {
            $company = Company::find($this->argument('id'));
            
            if($company) {
                $this->executeMigrationCompany($company);
                return;
            }
            
            $this->info("Id Company invalid!");
            return;
        }

        $companies = Company::all();

        foreach ($companies as $company) {
            $this->executeMigrationCompany($company);
        }
    }

    private function executeMigrationCompany(Company $company) {
        $command = $this->option('refresh')?'migrate:refresh': 'migrate';

        $this->managerTenant->setConnection($company);

        $this->info("Connection Company {$company->name}");

        Artisan::call($command, [
            '--force' => true,
            '--path' => '/database/migrations/tenant'
        ]);

        $this->info("End Connection Company {$company->name}");
        $this->info("---------------------------------------");
    }
}