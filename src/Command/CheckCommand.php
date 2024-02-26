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
        $xmlDb = new XmlToDatabase($filePath);
        $iterator = new XmlIterator($filePath);
        
        $io->success($iterator->bookPartKwdGroupAttributes());
        $io->success($xmlDb->saveBookPartAttributes());

        return;
    }

    public function fileExists(string $filePath, ConsoleIo $io): void
    {
        if(!file_exists($filePath))
        {
            $io->error('File not found: ' . $filePath . PHP_EOL);
            return;
        }
    }

    public function validateBitsFile(string $filePath, ConsoleIo $io): void
    {   
        $dom = new DOMDocument();
        $loadedXml =  $dom->load($filePath);

        if($loadedXml)
        {
            $io->success('XML loaded successfully!' . PHP_EOL);
            return;
        }

        $io->error('There was an error loading your file!' . PHP_EOL);
        return;
    }
}
