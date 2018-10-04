
<?php


class Model_Mongo
{

    /**
     * MongoDB client.
     *
     * @var MongoClient
     */
    protected $client;


    /**
     * Collection name
     *
     * @var string
     */
    protected $collection;


    /**
     * Model_Mongo constructor.
     *
     * @param $server
     * @param $db
     * @param string $collection
     * @throws MongoConnectionException
     */
    public function __construct($server, $collection = 'csvmigration.main')
    {
        $this->client = new MongoDB\Driver\Manager('mongodb://' . $server);
        $this->collection = $collection;
    }


    public function insert($documents)
    {
        $bulk = new MongoDB\Driver\BulkWrite();

        foreach ($documents as $document)
            $bulk->insert($document);

        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
        $this->client->executeBulkWrite($this->collection, $bulk, $writeConcern);
    }


}