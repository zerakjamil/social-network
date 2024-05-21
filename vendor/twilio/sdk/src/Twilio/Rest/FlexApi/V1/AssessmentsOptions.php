<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Flex
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\FlexApi\V1;

use Twilio\Options;
use Twilio\Values;

abstract class AssessmentsOptions
{
    /**
     * @param string $token The Token HTTP request header
     * @return CreateAssessmentsOptions Options builder
     */
    public static function create(
        
        string $token = Values::NONE

    ): CreateAssessmentsOptions
    {
        return new CreateAssessmentsOptions(
            $token
        );
    }

    /**
     * @param string $segmentId The id of the segment.
     * @param string $token The Token HTTP request header
     * @return ReadAssessmentsOptions Options builder
     */
    public static function read(
        
        string $segmentId = Values::NONE,
        string $token = Values::NONE

    ): ReadAssessmentsOptions
    {
        return new ReadAssessmentsOptions(
            $segmentId,
            $token
        );
    }

    /**
     * @param string $token The Token HTTP request header
     * @return UpdateAssessmentsOptions Options builder
     */
    public static function update(
        
        string $token = Values::NONE

    ): UpdateAssessmentsOptions
    {
        return new UpdateAssessmentsOptions(
            $token
        );
    }

}

class CreateAssessmentsOptions extends Options
    {
    /**
     * @param string $token The Token HTTP request header
     */
    public function __construct(
        
        string $token = Values::NONE

    ) {
        $this->options['token'] = $token;
    }

    /**
     * The Token HTTP request header
     *
     * @param string $token The Token HTTP request header
     * @return $this Fluent Builder
     */
    public function setToken(string $token): self
    {
        $this->options['token'] = $token;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.FlexApi.V1.CreateAssessmentsOptions ' . $options . ']';
    }
}

class ReadAssessmentsOptions extends Options
    {
    /**
     * @param string $segmentId The id of the segment.
     * @param string $token The Token HTTP request header
     */
    public function __construct(
        
        string $segmentId = Values::NONE,
        string $token = Values::NONE

    ) {
        $this->options['segmentId'] = $segmentId;
        $this->options['token'] = $token;
    }

    /**
     * The id of the segment.
     *
     * @param string $segmentId The id of the segment.
     * @return $this Fluent Builder
     */
    public function setSegmentId(string $segmentId): self
    {
        $this->options['segmentId'] = $segmentId;
        return $this;
    }

    /**
     * The Token HTTP request header
     *
     * @param string $token The Token HTTP request header
     * @return $this Fluent Builder
     */
    public function setToken(string $token): self
    {
        $this->options['token'] = $token;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.FlexApi.V1.ReadAssessmentsOptions ' . $options . ']';
    }
}

class UpdateAssessmentsOptions extends Options
    {
    /**
     * @param string $token The Token HTTP request header
     */
    public function __construct(
        
        string $token = Values::NONE

    ) {
        $this->options['token'] = $token;
    }

    /**
     * The Token HTTP request header
     *
     * @param string $token The Token HTTP request header
     * @return $this Fluent Builder
     */
    public function setToken(string $token): self
    {
        $this->options['token'] = $token;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.FlexApi.V1.UpdateAssessmentsOptions ' . $options . ']';
    }
}
