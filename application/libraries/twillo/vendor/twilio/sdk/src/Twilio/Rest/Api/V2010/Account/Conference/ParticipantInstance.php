<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Conference;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $accountSid
 * @property string $callSid
 * @property string $label
 * @property string $callSidToCoach
 * @property bool $coaching
 * @property string $conferenceSid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property bool $endConferenceOnExit
 * @property bool $muted
 * @property bool $hold
 * @property bool $startConferenceOnEnter
 * @property string $status
 * @property string $uri
 */
class ParticipantInstance extends InstanceResource {
    /**
     * Initialize the ParticipantInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The SID of the Account that created the resource
     * @param string $conferenceSid The SID of the conference the participant is in
     * @param string $callSid The Call SID or URL encoded label of the participant
     *                        to fetch
     */
    public function __construct(Version $version, array $payload, string $accountSid, string $conferenceSid, string $callSid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'callSid' => Values::array_get($payload, 'call_sid'),
            'label' => Values::array_get($payload, 'label'),
            'callSidToCoach' => Values::array_get($payload, 'call_sid_to_coach'),
            'coaching' => Values::array_get($payload, 'coaching'),
            'conferenceSid' => Values::array_get($payload, 'conference_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'endConferenceOnExit' => Values::array_get($payload, 'end_conference_on_exit'),
            'muted' => Values::array_get($payload, 'muted'),
            'hold' => Values::array_get($payload, 'hold'),
            'startConferenceOnEnter' => Values::array_get($payload, 'start_conference_on_enter'),
            'status' => Values::array_get($payload, 'status'),
            'uri' => Values::array_get($payload, 'uri'),
        ];

        $this->solution = [
            'accountSid' => $accountSid,
            'conferenceSid' => $conferenceSid,
            'callSid' => $callSid ?: $this->properties['callSid'],
        ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ParticipantContext Context for this ParticipantInstance
     */
    protected function proxy(): ParticipantContext {
        if (!$this->context) {
            $this->context = new ParticipantContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['conferenceSid'],
                $this->solution['callSid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the ParticipantInstance
     *
     * @return ParticipantInstance Fetched ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ParticipantInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Update the ParticipantInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ParticipantInstance Updated ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): ParticipantInstance {
        return $this->proxy()->update($options);
    }

    /**
     * Delete the ParticipantInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->proxy()->delete();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.ParticipantInstance ' . \implode(' ', $context) . ']';
    }
}