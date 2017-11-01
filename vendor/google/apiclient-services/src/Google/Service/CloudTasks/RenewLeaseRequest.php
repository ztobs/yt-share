<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class Google_Service_CloudTasks_RenewLeaseRequest extends Google_Model
{
  public $newLeaseDuration;
  public $responseView;
  public $scheduleTime;

  public function setNewLeaseDuration($newLeaseDuration)
  {
    $this->newLeaseDuration = $newLeaseDuration;
  }
  public function getNewLeaseDuration()
  {
    return $this->newLeaseDuration;
  }
  public function setResponseView($responseView)
  {
    $this->responseView = $responseView;
  }
  public function getResponseView()
  {
    return $this->responseView;
  }
  public function setScheduleTime($scheduleTime)
  {
    $this->scheduleTime = $scheduleTime;
  }
  public function getScheduleTime()
  {
    return $this->scheduleTime;
  }
}
