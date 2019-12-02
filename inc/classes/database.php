<?php


/**
 * Class for the database.
 *
 * The methods contained in this class include ones for connecting, querying and
 * running select statements on the database. There are also methods to handle
 * errors as well as to escape any $_POST variables before inserting into the
 * database via a query string.
 */
class Database
{
    /**
     * Define the connection as a static variable so as to avoid connecting more
     * than once.
     */
    protected static $connection;

    /**
     * Connect to the database.
     *
     * @return bool   False on failure.
     * @return object MySQLi object instance on success.
     */
    private function Connect()
    {
        // Try and connect to the database
        if (!isset(self::$connection)) {
            // Get and Set the environment variables.
            $dbHost     = getenv("DB_HOST");
            $dbUsername = getenv("DB_USERNAME");
            $dbPassword = getenv("DB_PASSWORD");
            $database   = getenv("DB_DATABASE");
            // Create the new database object.
            self::$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $database);
        }

        // If error, return false. You can handle error messages with the
        // Error() method below.
        if (self::$connection === false) {
            return false;
        }

        // If all went well, return the connection to be used in the scripts.
        return self::$connection;
    }

    /**
     * Query the database. This is used by all the public methods below.
     *
     * @param  string $query The query string.
     *
     * @return mixed  The result of the mysqli::query() function.
     */
    private function Query($query)
    {
        // Connect to the database.
        $connection = $this->Connect();

        // Query the database
        $result = $connection->query($query);

        // Return the query result.
        return $result;
    }

    /**
     * Fetch rows from the database using a SELECT query.
     *
     * @param  string $query The query string.
     *
     * @return bool   False on failure.
     * @return array  Array of Database rows on success.
     */
    public function Select($query)
    {
        // Setup an array for the result set.
        $rows = array();
        $result = $this->Query($query);

        // Return false if there is an error with the result query.
        if ($result === false) {
            return false;
        }

        // Build the array based on the query result.
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Return the result as an array.
        return $rows;
    }

    /**
     * Gets the total number of rows in a query.
     *
     * @param  string  $query The query string.
     *
     * @return integer Total number of records.
     */
    public function NumRows($query)
    {
        // Get the result set from the query using the Query method.
        $result = $this->Query($query);

        // Count the number of rows in the query.
        $count = $result->num_rows;

        // Return the total number of rows.
        return $count;
    }

    /**
     * Fetch the last error from the database.
     *
     * @return string Database error message.
     * @todo          The $debug isn't working and only ever returns
     *                $productionMessage. It is not seeing picking up the
     *                variable set in bootstrap.php. Need to work out why.
     */
    public function Error()
    {
        // Setup the connection variable.
        $connection = $this->Connect();

        // If the query was not successful display the error when in a
        // development environment however, simply show a standard text message
        // on a production server.
        if ($debug == true) {
            // Create and append to the error message.
            $debugMessage  = '<div class="alert alert-danger" role="alert">';
            $debugMessage .= 'MySQL Error: There was an error with MySQL.<br>' . PHP_EOL;
            $debugMessage .= 'Debug Error Number: ' . $connection->errno . '<br>' . PHP_EOL;
            $debugMessage .= 'Debug Error Message: ' . $connection->error . '<br>' . PHP_EOL;
            $debugMessage .= '</div>';

            // Return the debug message.
            return $debugMessage;
        } else {
            // Setup the error message.
            $productionMessage  = '<div class="alert alert-danger" role="alert">';
            $productionMessage .= 'There was a problem querying our Database Server. Should the problem persist, please <a href="/contact.php">contact our Support team</a> for additional help.';
            $productionMessage .= '</div>';

            // Return the production message.
            return $productionMessage;
        }
    }

    /**
     * Escapes the value for use in a database query to avoid XSS attacks.
     *
     * @param  string $value The value to be quoted and escaped.
     *
     * @return string The quoted and escaped string.
     */
    public function Quote($value)
    {
        $connection = $this->Connect();
        return $connection->real_escape_string($value);
    }
}
