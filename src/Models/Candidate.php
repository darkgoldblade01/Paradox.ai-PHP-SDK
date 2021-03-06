<?php

namespace darkgoldblade01\Paradox\Olivia\Models;

class Candidate extends Model {

    protected $create_required_fields = [
        'name',
        'phone|email',
    ];

    protected $update_required_fields = [
        'OID',
        'name',
        'phone|email',
    ];
	
	/**
	 * Stage
	 *
	 * Holds the stage that
	 * the candidate is at.
	 *
	 * @var array
	 */
    public $stage = [];
	
	/**
	 * Conversation
	 *
	 * Contains the messages
	 * to and from the candidate.
	 *
	 * @var array
	 */
    public $conversation = [];

    /**
     * Fill
     *
     * Customized fill function for
     * the Candidate to handle the
     * stage from the API.
     *
     * @param $information
     *
     * @return $this
     */
    protected function fill($information) {
        $from_api = false;
        if(isset($information->candidate) && isset($information->stage)) {
            $from_api = true;
        }
        if($from_api) {
            if(isset($information->candidate)) {
                foreach($information->candidate AS $key => $val) {
                    $this->{$key} = $val;
                }
            }
			if(isset($information->stage)) {
				foreach($information->stage AS $key => $val) {
					$this->stage[$key] = $val;
				}
			}
			if(isset($information->conversation)) {
				foreach($information->conversation AS $key => $val) {
					$this->conversation[$key] = $val;
				}
			}
        } else {
            foreach($information AS $key => $val) {
                $this->{$key} = $val;
            }
        }
        return $this;
    }

}