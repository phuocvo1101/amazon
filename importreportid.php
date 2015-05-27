<?php
session_start();
include_once('./mws/report.config.inc.php');
include_once('./library/Database.php');


$config = array (
    'ServiceURL' => 'https://mws.amazonservices.com',
    'ProxyHost' => null,
    'ProxyPort' => -1,
    'MaxErrorRetry' => 3,
);

$version = '2009-01-01';
$service = new MarketplaceWebService_Client(
    AWS_ACCESS_KEY_ID,
    AWS_SECRET_ACCESS_KEY,
    $config,
    APPLICATION_NAME,
    $version);

$parameters = array (
    'Merchant' => 'A23G34L9M4O1S0',
    'Acknowledged' => false
);

$request = new MarketplaceWebService_Model_GetReportListRequest($parameters);
$list = new MarketplaceWebService_Model_TypeList();
$list -> setType('_GET_SELLER_FEEDBACK_DATA_');
$request->setReportTypeList($list);
$request->setMaxCount(100);

if(file_exists('token')) {
    $token = file_get_contents('token');
    $parameters = array (
        'Merchant' => 'A23G34L9M4O1S0',
        'NextToken' => $token
    );

    $request = new MarketplaceWebService_Model_GetReportListByNextTokenRequest($parameters);
    invokeGetReportListByNextToken($service,$request);
}

invokeGetReportList($service,$request);

echo 'Imported ReportId was successful';

function invokeGetReportListByNextToken(MarketplaceWebService_Interface $service, $request)
{
    try {
        $response = $service->getReportListByNextToken($request);
        $database = new Database();
        if ($response->isSetGetReportListByNextTokenResult()) {

            $getReportListByNextTokenResult = $response->getGetReportListByNextTokenResult();
            if ($getReportListByNextTokenResult->isSetNextToken())
            {
                file_put_contents('token',$getReportListByNextTokenResult->getNextToken());
            }

            $reportInfoList = $getReportListByNextTokenResult->getReportInfo();
            foreach ($reportInfoList as $reportInfo) {

                if ($reportInfo->isSetReportId())
                {
                    $report_id = $reportInfo->getReportId();
                    $query = 'INSERT INTO reportlist(report_id,status) VALUES('.$report_id.',0)';
                    $database->setQuery($query);
                    $result = $database->execute();
                    if($result) {
                        echo 'Imported :'.$report_id."\n";
                    }

                }

            }
        }else {
            unlink('token');
        }
    } catch (MarketplaceWebService_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
        unlink('token');
    }
}

function invokeGetReportList(MarketplaceWebService_Interface $service, $request)
{
    try {
        $response = $service->getReportList($request);
        $database = new Database();

        if ($response->isSetGetReportListResult()) {

            $getReportListResult = $response->getGetReportListResult();
            if ($getReportListResult->isSetNextToken())
            {
                file_put_contents('token',$getReportListResult->getNextToken());
            }

            $reportInfoList = $getReportListResult->getReportInfoList();

            foreach ($reportInfoList as $reportInfo) {

                if ($reportInfo->isSetReportId())
                {
                    $report_id = $reportInfo->getReportId();
                    $query = 'INSERT INTO reportlist(report_id,status) VALUES('.$report_id.',0)';
                    $database->setQuery($query);
                    $result = $database->execute();
                    if($result) {
                        echo 'Imported :'.$report_id."\n";
                    }
                }

            }
        }
    } catch (MarketplaceWebService_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
}


