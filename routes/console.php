<?php

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class InspireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $quote = Inspiring::quote();
        } catch (\Exception $e) {
            $this->error('Error while fetching quote: ' . $e->getMessage());
            return;
        }

        $this->comment($quote);
    }
}
