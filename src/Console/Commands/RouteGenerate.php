<?php

namespace kamruljpi\Role\Console\Commands;

use Illuminate\Console\Command;
use kamruljpi\Role\Http\Controllers\DynamicRoutes;

class RouteGenerate extends Command {

    protected $signature = 'route:generate';

    protected $description = 'Generate Route Successfully';

    public function __construct() {
        parent::__construct();
    }
    
    public function handle() {
        $DynamicRoutes = new DynamicRoutes();
        $DynamicRoutes->refreshMenu();
    }

}