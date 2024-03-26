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
     * This class property stores the name and signature of the console command.
     * The name is used to identify the command, and the signature is used to
     * parse the command's arguments and options.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * This class property stores the description of the console command. It
     * provides a brief explanation of what the command does.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * @var LoggerInterface
     *
     * This class property is an instance of Psr\Log\LoggerInterface, which
     * provides a common interface for logging in PHP applications. It is used
     * to log any errors that occur while fetching the quote.
     */
    private $logger;

    /**
     * @var Inspiring
     *
     * This class property is an instance of Illuminate\Foundation\Inspiring,
     * which provides a simple way to fetch inspiring quotes from various
     * sources.
     */
    private $inspiring;

    /**
     * Create a new command instance.
     *
     * This method is the constructor of the InspireCommand class. It is called
     * when a new instance of the class is created. It takes two arguments:
     * $logger and $inspiring, which are injected by Laravel's service container.
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
     * This method is the main entry point of the InspireCommand class. It is
     * called when the command is executed from the command line. It fetches
     * an inspiring quote using the $this->inspiring property and displays it
     *
