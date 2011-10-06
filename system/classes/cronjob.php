<?php
/**
 * @package Habari
 *
 */

/**
 * CronJob is a single cron task
 *
 * @property string $name The name of the cron job.
 * @property mixed $callback The callback function or plugin action for the cron job to execute.
 * @property HabariDateTime $start_time The time the cron job entry will begin executing.
 * @property HabariDateTime $end_time The time the cron job entry will end executing and delete.
 * @property HabariDateTime $last_run The time job was last run.
 * @property HabariDateTime $next_run The time the job will run next.
 * @property int $increment The amount of time, in seconds, between each execution.
 * @property string $result The result of the last run. Either null, 'executed', or 'failed'.
 * @property string $description The description of the cron job.
 * @property int $cron_class The type of cron job.
 * @property string $notify Not implemented.
 */
class CronJob extends QueryRecord
{
	const CRON_SYSTEM = 1;
	const CRON_THEME = 2;
	const CRON_PLUGIN = 4;
	const CRON_CUSTOM = 8;
	
	/**
	 * The internally stored execution time of this cronjob. (unix timestamp)
	 *
	 * @var int
	 */
	private $now;


	/**
	 * Returns the defined database columns for a cronjob.
	 *
	 * @return array Array of default columns in the crontab table
	 */
	public static function default_fields()
	{
		return array(
			'cron_id' => 0,
			'name' => '',
			'callback' => '',
			'last_run' => null,
			'next_run' => HabariDateTime::date_create(),
			'increment' => 86400, // one day
			'start_time' => HabariDateTime::date_create(),
			'end_time' => null,
			'result' => '',
			'cron_class' => self::CRON_CUSTOM,
			'description' => '',
			'notify' => '',
		);
	}

	/**
	 * Constructor for the CronJob class.
	 *
	 * @see QueryRecord::__construct()
	 * @param array $paramarray an associative array or querystring of initial field values
	 */
	public function __construct( $paramarray = array() )
	{
		$this->now = HabariDateTime::date_create();

		// Defaults
		$this->fields = array_merge(
			self::default_fields(),
			$this->fields
		);

		// maybe serialize the callback
		$paramarray = Utils::get_params( $paramarray );
		if ( isset( $paramarray['callback'] )
			&& (
				is_array( $paramarray['callback'] )
				|| is_object( $paramarray['callback'] )
			)
		) {
			$paramarray['callback'] = serialize( $paramarray['callback'] );
		}

		parent::__construct( $paramarray );
		$this->exclude_fields( 'cron_id' );
	}

	/**
	 * Runs this job.
	 *
	 * Executes the Cron Job callback. Deletes the Cron Job if end_time is reached
	 * or if it failed to execute the last # consecutive attempts. Also sends notification
	 * by email to specified address.
	 * Note: end_time can be null, ie. "The Never Ending Cron Job".
	 *
	 * Callback is passed a param_array of the Cron Job fields and the execution time
	 * as the 'now' field. The 'result' field contains the result of the last execution; either
	 * 'executed' or 'failed'.
	 *
	 * @todo delete job after # failed attempts.
	 * @todo send notification of execution/failure.
	 */
	public function execute()
	{
		$paramarray = array_merge( array( 'now' => $this->now ), $this->to_array() );

		if ( is_callable( $this->callback ) ) {
			$result = @call_user_func( $this->callback, $paramarray );
		}
		else {
			$result = true;
			$result = Plugins::filter( $this->callback, $result, $paramarray );
		}

		if ( $result === false ) {
			$this->result = 'failed';
		}
		else {
			$this->result = 'executed';

			// it ran successfully, so check if it's time to delete it.
			if ( ! is_null( $this->end_time ) && ( $this->now >= $this->end_time ) ) {
				$this->delete();
				return;
			}
		}

		$this->last_run = $this->now;
		$this->next_run = $this->now->int + $this->increment;
		$this->update();
	}

	/**
	 * Magic property setter to set the cronjob properties.
	 * Serializes the callback if needed.
	 *
	 * @see QueryRecord::__set()
	 * @param string $name The name of the property to set.
	 * @param mixed $value The value of the property to set.
	 * @return mixed The new value of the property.
	 */
	public function __set( $name, $value )
	{
		switch ( $name ) {
			case 'callback':
				if ( is_array( $value ) || is_object( $value ) ) {
					$value = serialize( $value );
				}
				break;
			case 'next_run':
			case 'last_run':
			case 'start_time':
			case 'end_time':
				if ( !( $value instanceOf HabariDateTime ) && ! is_null( $value ) ) {
					$value = HabariDateTime::date_create( $value );
				}
				break;
		}
		return parent::__set( $name, $value );
	}

	/**
	 * Magic property getter to get the cronjob properties.
	 * Unserializes the callback if called.
	 *
	 * @see QueryRecord::__get()
	 * @param string $name The name of the property to get.
	 * @return mixed The value of the property, or null if no property by that name.
	 */
	public function __get( $name )
	{
		if ( $name == 'callback' ) {
			if ( false !== $res = @ unserialize( parent::__get( $name ) ) ) {
				return $res;
			}
		}
		return parent::__get( $name );
	}


	/**
	 * Saves a new cron job to the crontab table.
	 *
	 * @see QueryRecord::insertRecord()
	 * @return CronJob The newly inserted cron job, or false if failed.
	 */
	public function insert()
	{
		return parent::insertRecord( DB::table( 'crontab' ) );
	}

	/**
	 * Updates an existing cron job to the crontab table.
	 *
	 * @see QueryRecord::updateRecord()
	 * @return CronJob The updated cron job, or false if failed.
	 */
	public function update()
	{
		return parent::updateRecord( DB::table( 'crontab' ), array( 'cron_id'=>$this->cron_id ) );
	}

	/**
	 * Deletes an existing cron job.
	 *
	 * @see QueryRecord::deleteRecord()
	 * @return bool If the delete was successful
	 */
	public function delete()
	{
		return parent::deleteRecord( DB::table( 'crontab' ), array( 'cron_id'=>$this->cron_id ) );
	}
}

?>
