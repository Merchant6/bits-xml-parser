<?php
declare(strict_types=1);

namespace App\Command;

use App\Utility\XmlToDatabase;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use DOMDocument;
use App\Utility\XmlIterator;

/**
 * Check command.
 */
class CheckCommand extends Command
{
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

        $parser->addArgument('filepath', [
            'help' => 'Full path to the BITS file to be ingested',
            'required' => true
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
        $filePath = $args->getArgument('filepath');

        /** 
         * Check if the file exists and then validate
         * using the DOMDocument. After validation the
         * file path is passed on to the XMLIterator
         * utility class for parsing.
         * */ 
        $this->fileExists($filePath, $io);
        $this->validateBitsFile($filePath, $io);
        
        /**
         * You can call a method below to do a specific
         * task like saving the data to database or 
         * printing the data to the command line
         */

        return;
    }

    public function fileExists(string $filePath, ConsoleIo $io): void
    {
        if(!file_exists($filePath))
        {
            $io->abort('File not found: ' . $filePath . PHP_EOL);
            return;
        }
    }

    public function validateBitsFile(string $filePath, ConsoleIo $io): void
    {   
        $loadedXml =  simplexml_load_file($filePath);

        if($loadedXml)
        {
            $io->success('XML file loaded successfully!' . PHP_EOL);
            return;
        }

        $io->abort('There was an error validating your file!' . PHP_EOL);
        return;
    }
}
