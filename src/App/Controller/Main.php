<?php

use Juanparati\CSVReader\CSVReader;

/**
 * Default controller entry-point
 */
class Controller_Main extends Controller
{


    /**
     * Maximum lines in buffer.
     */
    const BUFFER_LINES = 100;


    /**
     * CLImate instance.
     *
     * @var \League\CLImate\CLImate
     */
    protected $console;


    /**
     * Controller_Main constructor.
     */
    public function __construct()
    {
        $this->console = new League\CLImate\CLImate();
    }


    /**
     * Entry point
     */
    public function actionMain()
    {

        // Show help.
        // ---------
        if (Params::get('help') || !empty(Params::validate()))
        {
            $this->actionHelp();

            Apprunner::terminate(Apprunner::EXIT_SUCCESS);
        }


        $file = Params::get('file');

        if (!File::exists($file, File::SCOPE_EXTERNAL))
        {
            $this->console->error('File not found: ' . $file);

            Apprunner::terminate(Apprunner::EXIT_DATAERR);
        }


        // Instantiate CSVReader according to parameters passed.
        // -----------------------------------------------------
        $csv = new CSVReader(
            $file,
            Findconst::findOrDefault(CSVReader::class, Params::get('delimiter')     , Params::get('delimiter')     , 'DELIMITER_'),
            Findconst::findOrDefault(CSVReader::class, Params::get('text-enclosure'), Params::get('text-enclosure'), 'ENCLOSURE_'),
            Params::get('charset'),
            Findconst::findOrDefault(CSVReader::class, Params::get('decimal_sep')   , Params::get('decimal_sep')   , 'DECIMAL_SEP_'),
            Params::get('escape-char')
        );

        // Apply a stream filter.
        if ($stream_filter = Params::get('stream-filter'))
            $csv->applyStreamFilter($stream_filter);

        $csv->setAutomaticMapField();


        // Open output file.
        // -----------------
        if ($output = Params::get('output'))
        {
            $out_fp = fopen($output, 'w');
            $interactive = !Params::get('no-interactive');
        }
        else
            $interactive = false;


        if ($interactive)
        {
            $this->console->output('Processing ' . basename($file) . '...');
            $file_stat   = $csv->info();
            $progress    = $this->console->progress()->total($file_stat['size']);
            $total_lines = 0;
            $start_time  = time();
        }

        $buffer = '';
        $buffer_line = 0;


        // Read file and tranform to JSON lines.
        // -------------------------------------
        while ($row = $csv->readLine())
        {
            $json = json_encode($row, JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);

            ++$total_lines;

            if ($output)
            {
                $json .= "\n";

                // Write to file every time that 100 lines are reached.
                // It is just for optimization purposes.
                $buffer .= $json;
                $buffer_line++;

                if ($buffer_line > static::BUFFER_LINES)
                {
                    fwrite($out_fp, $buffer);
                    $buffer = '';
                    $buffer_line = 0;
                }

                if ($interactive)
                    $progress->current($csv->tellPosition());
            }
            else
                echo $json . PHP_EOL;
        }

        // Write last lines.
        if (!empty($buffer))
            fwrite($out_fp, $buffer);

        if ($interactive)
        {
            $progress->current($file_stat['size']);

            $this->console->br()->info('🍺  File parsed in ' . (time() - $start_time) . ' seconds (Lines: ' . $total_lines . ', Bytes: ' . $file_stat['size']  . ')');
        }

        // You app finish here
        Apprunner::terminate(Apprunner::EXIT_SUCCESS);

    }


    /**
     * Display help.
     */
    public function actionHelp()
    {
        $help = file_get_contents(RESOURCESPATH . 'help.txt');
        $help = str_replace('#{{__EXECUTABLE__}}', basename(Phar::running()), $help);

        $this->console->out($help);
    }

}
