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

/**
 * The "filterSets" collection of methods.
 * Typical usage is:
 *  <code>
 *   $adexchangebuyer2Service = new Google_Service_AdExchangeBuyerII(...);
 *   $filterSets = $adexchangebuyer2Service->filterSets;
 *  </code>
 */
class Google_Service_AdExchangeBuyerII_Resource_BiddersFilterSets extends Google_Service_Resource
{
  /**
   * Creates the specified filter set for the account with the given account ID.
   * (filterSets.create)
   *
   * @param string $ownerName Name of the owner (bidder or account) of the filter
   * set to be created. For example:
   *
   * - For a bidder-level filter set for bidder 123: `bidders/123`
   *
   * - For an account-level filter set for the buyer account representing bidder
   * 123: `bidders/123/accounts/123`
   *
   * - For an account-level filter set for the child seat buyer account 456
   * whose bidder is 123: `bidders/123/accounts/456`
   * @param array $optParams Optional parameters.
   *
   * @opt_param int filterSet.relativeDateRange.offsetDays The end date of the
   * filter set, specified as the number of days before today. E.g. for a range
   * where the last date is today, 0.
   * @opt_param bool isTransient Whether the filter set is transient, or should be
   * persisted indefinitely. By default, filter sets are not transient. If
   * transient, it will be available for at least 1 hour after creation.
   * @opt_param int filterSet.absoluteDateRange.startDate.day Day of month. Must
   * be from 1 to 31 and valid for the year and month, or 0 if specifying a
   * year/month where the day is not significant.
   * @opt_param string filterSet.realtimeTimeRange.startTimestamp The start
   * timestamp of the real-time RTB metrics aggregation.
   * @opt_param int filterSet.absoluteDateRange.startDate.month Month of year.
   * Must be from 1 to 12.
   * @opt_param int filterSet.absoluteDateRange.endDate.day Day of month. Must be
   * from 1 to 31 and valid for the year and month, or 0 if specifying a
   * year/month where the day is not significant.
   * @opt_param int filterSet.absoluteDateRange.startDate.year Year of date. Must
   * be from 1 to 9999, or 0 if specifying a date without a year.
   * @opt_param string filterSet.name A user-defined name of the filter set.
   * Filter set names must be unique globally and match one of the patterns:
   *
   * - `bidders/filterSets` (for accessing bidder-level troubleshooting data) -
   * `bidders/accounts/filterSets` (for accessing buyer-level troubleshooting
   * data)
   *
   * This field is required in create operations.
   * @opt_param string filterSet.platforms The list of platforms on which to
   * filter; may be empty. The filters represented by multiple platforms are ORed
   * together (i.e. if non-empty, results must match any one of the platforms).
   * @opt_param int filterSet.relativeDateRange.durationDays The number of days in
   * the requested date range. E.g. for a range spanning today, 1. For a range
   * spanning the last 7 days, 7.
   * @opt_param string accountId Account ID of the buyer.
   * @opt_param string filterSet.dealId The ID of the deal on which to filter;
   * optional. This field may be set only for a filter set that accesses buyer-
   * level troubleshooting data, i.e. one whose name matches the
   * `bidders/accounts/filterSets` pattern.
   * @opt_param int filterSet.absoluteDateRange.endDate.year Year of date. Must be
   * from 1 to 9999, or 0 if specifying a date without a year.
   * @opt_param int filterSet.absoluteDateRange.endDate.month Month of year. Must
   * be from 1 to 12.
   * @opt_param string filterSet.environment The environment on which to filter;
   * optional.
   * @opt_param int filterSet.sellerNetworkIds The list of IDs of the seller
   * (publisher) networks on which to filter; may be empty. The filters
   * represented by multiple seller network IDs are ORed together (i.e. if non-
   * empty, results must match any one of the publisher networks). See [seller-
   * network-ids](https://developers.google.com/ad-exchange/rtb/downloads/seller-
   * network-ids) file for the set of existing seller network IDs.
   * @opt_param string filterSet.filterSetId The ID of the filter set; unique
   * within the account of the filter set owner. The value of this field is
   * ignored in create operations.
   * @opt_param string filterSet.format The format on which to filter; optional.
   * @opt_param string filterSet.timeSeriesGranularity The granularity of time
   * intervals if a time series breakdown is desired; optional.
   * @opt_param string filterSet.creativeId The ID of the creative on which to
   * filter; optional. This field may be set only for a filter set that accesses
   * buyer-level troubleshooting data, i.e. one whose name matches the
   * `bidders/accounts/filterSets` pattern.
   * @return Google_Service_AdExchangeBuyerII_FilterSet
   */
  public function create($ownerName, $optParams = array())
  {
    $params = array('ownerName' => $ownerName);
    $params = array_merge($params, $optParams);
    return $this->call('create', array($params), "Google_Service_AdExchangeBuyerII_FilterSet");
  }
  /**
   * Deletes the requested filter set from the account with the given account ID.
   * (filterSets.delete)
   *
   * @param string $name Full name of the resource to delete. For example:
   *
   * - For a bidder-level filter set for bidder 123:
   * `bidders/123/filterSets/abc`
   *
   * - For an account-level filter set for the buyer account representing bidder
   * 123: `bidders/123/accounts/123/filterSets/abc`
   *
   * - For an account-level filter set for the child seat buyer account 456
   * whose bidder is 123: `bidders/123/accounts/456/filterSets/abc`
   * @param array $optParams Optional parameters.
   *
   * @opt_param string accountId Account ID of the buyer.
   * @opt_param string filterSetId The ID of the filter set to delete.
   * @return Google_Service_AdExchangeBuyerII_Adexchangebuyer2Empty
   */
  public function delete($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('delete', array($params), "Google_Service_AdExchangeBuyerII_Adexchangebuyer2Empty");
  }
  /**
   * Retrieves the requested filter set for the account with the given account ID.
   * (filterSets.get)
   *
   * @param string $name Full name of the resource being requested. For example:
   *
   * - For a bidder-level filter set for bidder 123:
   * `bidders/123/filterSets/abc`
   *
   * - For an account-level filter set for the buyer account representing bidder
   * 123: `bidders/123/accounts/123/filterSets/abc`
   *
   * - For an account-level filter set for the child seat buyer account 456
   * whose bidder is 123: `bidders/123/accounts/456/filterSets/abc`
   * @param array $optParams Optional parameters.
   *
   * @opt_param string accountId Account ID of the buyer.
   * @opt_param string filterSetId The ID of the filter set to get.
   * @return Google_Service_AdExchangeBuyerII_FilterSet
   */
  public function get($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_AdExchangeBuyerII_FilterSet");
  }
  /**
   * Lists all filter sets for the account with the given account ID.
   * (filterSets.listBiddersFilterSets)
   *
   * @param string $ownerName Name of the owner (bidder or account) of the filter
   * sets to be listed. For example:
   *
   * - For a bidder-level filter set for bidder 123: `bidders/123`
   *
   * - For an account-level filter set for the buyer account representing bidder
   * 123: `bidders/123/accounts/123`
   *
   * - For an account-level filter set for the child seat buyer account 456
   * whose bidder is 123: `bidders/123/accounts/456`
   * @param array $optParams Optional parameters.
   *
   * @opt_param int pageSize Requested page size. The server may return fewer
   * results than requested. If unspecified, the server will pick an appropriate
   * default.
   * @opt_param string accountId Account ID of the buyer.
   * @opt_param string pageToken A token identifying a page of results the server
   * should return. Typically, this is the value of
   * ListFilterSetsResponse.nextPageToken returned from the previous call to the
   * accounts.filterSets.list method.
   * @return Google_Service_AdExchangeBuyerII_ListFilterSetsResponse
   */
  public function listBiddersFilterSets($ownerName, $optParams = array())
  {
    $params = array('ownerName' => $ownerName);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_AdExchangeBuyerII_ListFilterSetsResponse");
  }
}
