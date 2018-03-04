<?php

/**
 * PHP BULK API CLIENT 25.0.0
 * @author Ryan Brainard
 *
 * JobInfo.php
 * Represents a Force.com Bulk API JobInfo object.
 *
 * For reference, see:
 * http://www.salesforce.com/us/developer/docs/api_asynch/Content/asynch_api_reference_jobinfo.htm
 *
 *
 * This client is NOT a supported product of or supported by salesforce.com, inc.
 * For support from the Open Source community, please visit the resources below:
 *
 * * Main Project Site
 *   http://code.google.com/p/forceworkbench
 *
 * * Feedback & Discussion
 *   http://groups.google.com/group/forceworkbench
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF
 * THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

class JobInfo {
    private $payload;
	private $json = false;

    public function __construct($payload = null, $json = false) {
	    if ($json) {
		    $this->json = true;
		    $this->payload = empty($payload) ? new stdClass() : (object) $payload;
		} else {
	        if ($payload != null) {
	            $this->payload = new SimpleXMLElement($payload);
	            
	            $this->payload->id = "";
	            $this->payload->operation = "";
	            $this->payload->object = "";
	            $this->payload->state = "";
	            $this->payload->externalIdFieldName = "";
	            $this->payload->concurrencyMode = "";
	            $this->payload->contentType = "";
	            $this->payload->assignmentRuleId = "";
	            
	        } else {
	            $this->payload = new SimpleXMLElement("<jobInfo xmlns=\"http://www.force.com/2009/06/asyncapi/dataload\"/>");
	
	            //setting writeable fields in their required sequence; otherwise, API can't parse correctly
	            //if any of them are still empty after  setting values, we unset them before converting to XML
	            $this->payload->id = "";
	            $this->payload->operation = "";
	            $this->payload->object = "";
	            $this->payload->state = "";
	            $this->payload->externalIdFieldName = "";
	            $this->payload->concurrencyMode = "";
	            $this->payload->contentType = "";
	            $this->payload->assignmentRuleId = "";
	        }
		}

        if ($this->getExceptionCode() != "") {
            throw new Exception($this->getExceptionCode() . ": " . $this->getExceptionMessage());
        }
    }

    public function asXml() {
        //removing empty fields to allow API to parse correctly
        //two loops are needed to not cause errors
        $emptyFields = array();
        foreach ($this->payload as $field=>$value) {
            if ($value == "") {
                $emptyFields[] = $field;
            }
        }
        foreach ($emptyFields as $field) {
            unset($this->payload->$field);
        }
		if ($this->json) {
			return json_encode($this->payload);
		} else {
	        return $this->payload->asXML();
        }
    }

    //SETTERS
    public function setId($id) {
        $this->payload->id = $id;
    }

    public function setOpertion($operation) {
        $this->payload->operation = $operation;
    }

    public function setObject($object) {
        $this->payload->object = $object;
    }

    public function setExternalIdFieldName($externalIdFieldName) {
        $this->payload->externalIdFieldName = $externalIdFieldName;
    }

    public function setAssignmentRuleId($assignmentRuleId) {
        $this->payload->assignmentRuleId = $assignmentRuleId;
    }

    public function setState($state) {
        $this->payload->state = $state;
    }

    public function setConcurrencyMode($concurrencyMode) {
        $this->payload->concurrencyMode = $concurrencyMode;
    }

    public function setContentType($contentType) {
        $this->payload->contentType = $contentType;
    }

    //GETTERS
    public function getId() {
        return $this->payload->id;
    }

    public function getOpertion() {
        return $this->payload->operation;
    }

    public function getObject() {
        return $this->payload->object;
    }

    public function getExternalIdFieldName() {
        return $this->payload->externalIdFieldName;
    }

    public function getCreatedById() {
        return $this->payload->createdById;
    }

    public function getCreatedDate() {
        return $this->payload->createdDate;
    }

    public function getSystemModstamp() {
        return $this->payload->systemModstamp;
    }

    public function getState() {
        return $this->payload->state;
    }

    public function getStateMessage() {
        return $this->payload->stateMessage;
    }

    public function getConcurrencyMode() {
        return $this->payload->concurrencyMode;
    }

    public function getContentType() {
        return $this->payload->contentType;
    }

    public function getNumberBatchesQueued() {
        return $this->payload->numberBatchesQueued;
    }

    public function getNumberBatchesInProgress() {
        return $this->payload->numberBatchesInProgress;
    }

    public function getNumberBatchesCompleted() {
        return $this->payload->numberBatchesCompleted;
    }

    public function getNumberBatchesFailed() {
        return $this->payload->numberBatchesFailed;
    }

    public function getNumberBatchesTotal() {
        return $this->payload->numberBatchesTotal;
    }

    public function getNumberRecordsProcessed() {
        return $this->payload->numberRecordsProcessed;
    }

    public function getNumberRetries() {
        return $this->payload->numberRetries;
    }

    public function getApiVersion() {
        return $this->payload->apiVersion;
    }

    public function getExceptionCode() {
        return $this->payload->exceptionCode;
    }

    public function getExceptionMessage() {
        return $this->payload->exceptionMessage;
    }

    //New in 19.0 Below:

    public function getTotalProcessingTime() {
        return $this->payload->totalProcessingTime;
    }

    public function getApexProcessingTime() {
        return $this->payload->apexProcessingTime;
    }

    public function getApiActiveProcessingTime() {
        return $this->payload->apiActiveProcessingTime;
    }

    public function getNumberRecordsFailed() {
        return $this->payload->numberRecordsFailed;
    }
}
?>