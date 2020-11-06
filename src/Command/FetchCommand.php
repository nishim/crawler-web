<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Http\Client;

/**
 * Fetch command.
 *
 * @property \Cake\ORM\Table $Pages
 */
class FetchCommand extends Command
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Pages');
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser->addArgument('url', [
            'help' => 'Fetch URL',
            'required' => true,
        ]);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $url = $args->getArgument('url');
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            $this->abort();
        }

        $http = new Client();
        $response = $http->get(env('CRAWLER_URL') . '/?url=' . $url);
        $json = $response->getJson();

        $page = $this->Pages->newEntity($json);
        $this->Pages->save($page);
    }
}
