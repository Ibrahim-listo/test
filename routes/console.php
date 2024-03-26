<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Inspiring
     */
    private $inspiring;

    /**
     * Create a new command instance.
     *
     * @param  LoggerInterface  $logger
     * @param  Inspiring  $inspiring
     * @return void
     */
    public function __construct(LoggerInterface $logger, Inspiring $inspiring)
    {
        parent::__construct();

        $this->logger = $logger;
        $this->inspiring = $inspiring;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $quote = $this->inspiring->quote();
        } catch (\Exception $e) {
            $this->logger->error('Error while fetching quote: ' . $e->getMessage());

            $this->error('An error occurred while fetching the quote.');

            return 1;
        }

        if ($quote === null) {
            $this->error('An error occurred while fetching the quote.');

            return 1;
        }

        $this
