<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     MarketplaceWebService
 *  @copyright   Copyright 2009 Amazon Technologies, Inc.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2009-01-01
 */
/******************************************************************************* 

 *  Marketplace Web Service PHP5 Library
 *  Generated: Thu May 07 13:07:36 PDT 2009
 * 
 */

/**
 * Get Feed Submission List  Sample
 */

include_once ('.config.inc.php'); 

/************************************************************************
* Uncomment to configure the client instance. Configuration settings
* are:
*
* - MWS endpoint URL
* - Proxy host and port.
* - MaxErrorRetry.
***********************************************************************/
// IMPORTANT: Uncomment the approiate line for the country you wish to
// sell in:
// United States:
//$serviceUrl = "https://mws.amazonservices.com";
// United Kingdom
//$serviceUrl = "https://mws.amazonservices.co.uk";
// Germany
//$serviceUrl = "https://mws.amazonservices.de";
// France
//$serviceUrl = "https://mws.amazonservices.fr";
// Italy
//$serviceUrl = "https://mws.amazonservices.it";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn";
// Canada
//$serviceUrl = "https://mws.amazonservices.ca";
// India
//$serviceUrl = "https://mws.amazonservices.in";

$config = array (
  'ServiceURL' => $serviceUrl,
  'ProxyHost' => null,
  'ProxyPort' => -1,
  'MaxErrorRetry' => 3,
);

/************************************************************************
 * Instantiate Implementation of MarketplaceWebService
 * 
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants 
 * are defined in the .config.inc.php located in the same 
 * directory as this sample
 ***********************************************************************/
 $service = new MarketplaceWebService_Client(
     AWS_ACCESS_KEY_ID, 
     AWS_SECRET_ACCESS_KEY, 
     $config,
     APPLICATION_NAME,
     APPLICATION_VERSION);
 
/************************************************************************
 * Uncomment to try out Mock Service that simulates MarketplaceWebService
 * responses without calling MarketplaceWebService service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebService/Mock tree
 *
 ***********************************************************************/
 // $service = new MarketplaceWebService_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out 
 * sample for Get Feed Submission List Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as MarketplaceWebService_Model_GetFeedSubmissionListRequest
 // object or array of parameters
 
//$parameters = array (
//  'Merchant' => MERCHANT_ID,
//  'FeedProcessingStatusList' => array ('Status' => array ('_SUBMITTED_')),
//  'MWSAuthToken' => '<MWS Auth Token>', // Optional
//);
//
//$request = new MarketplaceWebService_Model_GetFeedSubmissionListRequest($parameters);

//$request = new MarketplaceWebService_Model_GetFeedSubmissionListRequest();
//$request->setMerchant(MERCHANT_ID);
//$request->setMWSAuthToken('<MWS Auth Token>'); // Optional
//
//$statusList = new MarketplaceWebService_Model_StatusList();
//$request->setFeedProcessingStatusList($statusList->withStatus('_SUBMITTED_'));
//
//invokeGetFeedSubmissionList($service, $request);

                                                                            
/**
  * Get Feed Submission List Action Sample
  * returns a list of feed submission identifiers and their associated metadata
  *   
  * @param MarketplaceWebService_Interface $service instance of MarketplaceWebService_Interface
  * @param mixed $request MarketplaceWebService_Model_GetFeedSubmissionList or array of parameters
  */
  function invokeGetFeedSubmissionList(MarketplaceWebService_Interface $service, $request) 
  {
      try {
              $response = $service->getFeedSubmissionList($request);
              
                echo ("Service Response<br>");
                echo ("=============================================================================<br>");

                echo("        GetFeedSubmissionListResponse<br>");
                if ($response->isSetGetFeedSubmissionListResult()) { 
                    echo("            GetFeedSubmissionListResult<br>");
                    $getFeedSubmissionListResult = $response->getGetFeedSubmissionListResult();
                    if ($getFeedSubmissionListResult->isSetNextToken()) 
                    {
                        echo("                NextToken<br>");
                        echo("                    " . $getFeedSubmissionListResult->getNextToken() . "<br>");
                    }
                    if ($getFeedSubmissionListResult->isSetHasNext()) 
                    {
                        echo("                HasNext<br>");
                        echo("                    " . $getFeedSubmissionListResult->getHasNext() . "<br>");
                    }
                    $feedSubmissionInfoList = $getFeedSubmissionListResult->getFeedSubmissionInfoList();
                    foreach ($feedSubmissionInfoList as $feedSubmissionInfo) {
                        echo("                FeedSubmissionInfo<br>");
                        if ($feedSubmissionInfo->isSetFeedSubmissionId()) 
                        {
                            echo("                    FeedSubmissionId<br>");
                            echo("                        " . $feedSubmissionInfo->getFeedSubmissionId() . "<br>");
                        }
                        if ($feedSubmissionInfo->isSetFeedType()) 
                        {
                            echo("                    FeedType<br>");
                            echo("                        " . $feedSubmissionInfo->getFeedType() . "<br>");
                        }
                        if ($feedSubmissionInfo->isSetSubmittedDate()) 
                        {
                            echo("                    SubmittedDate<br>");
                            echo("                        " . $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT) . "<br>");
                        }
                        if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
                        {
                            echo("                    FeedProcessingStatus<br>");
                            echo("                        " . $feedSubmissionInfo->getFeedProcessingStatus() . "<br>");
                        }
                        if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
                        {
                            echo("                    StartedProcessingDate<br>");
                            echo("                        " . $feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT) . "<br>");
                        }
                        if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
                        {
                            echo("                    CompletedProcessingDate<br>");
                            echo("                        " . $feedSubmissionInfo->getCompletedProcessingDate()->format(DATE_FORMAT) . "<br>");
                        }
                    }
                } 
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata<br>");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId<br>");
                        echo("                    " . $responseMetadata->getRequestId() . "<br>");
                    }
                } 

                echo("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "<br>");
     } catch (MarketplaceWebService_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "<br>");
         echo("Response Status Code: " . $ex->getStatusCode() . "<br>");
         echo("Error Code: " . $ex->getErrorCode() . "<br>");
         echo("Error Type: " . $ex->getErrorType() . "<br>");
         echo("Request ID: " . $ex->getRequestId() . "<br>");
         echo("XML: " . $ex->getXML() . "<br>");
         echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "<br>");
     }
 }
                            
