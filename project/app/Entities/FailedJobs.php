<?php



/**
 * FailedJobs
 */
class FailedJobs
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $connection;

    /**
     * @var string
     */
    private $queue;

    /**
     * @var string
     */
    private $payload;

    /**
     * @var string
     */
    private $exception;

    /**
     * @var \DateTime
     */
    private $failedAt = 'CURRENT_TIMESTAMP';


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set connection.
     *
     * @param string $connection
     *
     * @return FailedJobs
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get connection.
     *
     * @return string
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set queue.
     *
     * @param string $queue
     *
     * @return FailedJobs
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue.
     *
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Set payload.
     *
     * @param string $payload
     *
     * @return FailedJobs
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get payload.
     *
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set exception.
     *
     * @param string $exception
     *
     * @return FailedJobs
     */
    public function setException($exception)
    {
        $this->exception = $exception;

        return $this;
    }

    /**
     * Get exception.
     *
     * @return string
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * Set failedAt.
     *
     * @param \DateTime $failedAt
     *
     * @return FailedJobs
     */
    public function setFailedAt($failedAt)
    {
        $this->failedAt = $failedAt;

        return $this;
    }

    /**
     * Get failedAt.
     *
     * @return \DateTime
     */
    public function getFailedAt()
    {
        return $this->failedAt;
    }
}
