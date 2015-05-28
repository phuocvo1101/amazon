<?php
session_start();
include_once('./mws/report.config.inc.php');
include_once('./library/Database.php');
include_once('output.php');

$readOptions = true;
$optionsWithData = array('m');
$longOptionsWithData = array('month');
$month = '';
for ($i = 1; $i < count($argv); ++$i) {
    $arg = $argv[$i];
    if ($readOptions and
        strlen($arg) > 0 and
        $arg[0] == '-'
    ) {
        if (strlen($arg) > 1 and
            $arg[1] == '-'
        ) {
            $flag = substr($arg, 2);
            if (in_array($flag, $longOptionsWithData)) {
                $optionData = $argv[$i + 1];
                ++$i;
            }
            if ($flag == 'help') {
                help();
                exit();
            } else if ($flag == 'month') {
                $month = $optionData;
            }

        } else {
            $flag = substr($arg, 1, 1);
            $optionData = false;
            if (in_array($flag, $optionsWithData)) {
                if (strlen($arg) > 2) {
                    $optionData = substr($arg, 2);
                } else {
                    $optionData = $argv[$i + 1];
                    ++$i;
                }
            }
            if ($flag == 'h') {
                help();
                exit();
            } else if ($flag == 'm') {
                $month = $optionData;
            }
        }
    }

}

if($month=='') {
    $month=12;
}


$config = array (
    'ServiceURL' => 'https://mws.amazonservices.com',
    'ProxyHost' => null,
    'ProxyPort' => -1,
    'MaxErrorRetry' => 3,
);
$colors = new Colors();
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
echo $colors->getColoredString('Begin Imported ReportId',"red","green");
echo "\n";
$request = new MarketplaceWebService_Model_GetReportListRequest($parameters);
$list = new MarketplaceWebService_Model_TypeList();
$list -> setType('_GET_SELLER_FEEDBACK_DATA_');
$request->setReportTypeList($list);
 $request->setAvailableToDate(new DateTime('now', new DateTimeZone('UTC')));
 $request->setAvailableFromDate(new DateTime('-'.$month.' months', new DateTimeZone('UTC')));
$request->setMaxCount(100);

if(file_exists('token')) {
    $token = file_get_contents('token');
    $parameters = array (
        'Merchant' => MERCHANT_ID,
        'NextToken' => $token
    );

    $request = new MarketplaceWebService_Model_GetReportListByNextTokenRequest($parameters);
    invokeGetReportListByNextToken($service,$request);
}

invokeGetReportList($service,$request);

echo $colors->getColoredString('Imported ReportId was successful',"red","blue");
echo "\n";

function invokeGetReportListByNextToken(MarketplaceWebService_Interface $service, $request)
{
    try {
        $colors = new Colors();
        $response = $service->getReportListByNextToken($request);
        $database = new Database();
        if ($response->isSetGetReportListByNextTokenResult()) {
            $getReportListByNextTokenResult = $response->getGetReportListByNextTokenResult();
            if ($getReportListByNextTokenResult->isSetNextToken())
            {
                $token = $getReportListByNextTokenResult->getNextToken();
                echo $colors->getColoredString('invokeGetReportListByNextToken:Put token',"red");
                echo "\n";
                file_put_contents('token',$token);
            } else{
                echo $colors->getColoredString('invokeGetReportListByNextToken:Removed token',"red");
                echo "\n";
                unlink('token');
            }

            $reportInfoList = $getReportListByNextTokenResult->getReportInfoList();
            foreach ($reportInfoList as $reportInfo) {

                if ($reportInfo->isSetReportId())
                {
                    $report_id = $reportInfo->getReportId();
                    $query = 'INSERT INTO reportlist(report_id,status) VALUES('.$report_id.',0)';
                    $database->setQuery($query);
                    $result = $database->execute();
                    if($result) {
                        echo $colors->getColoredString('Imported nexttoken:',"yellow");
                        echo $colors->getColoredString($report_id,"red");
                        echo "\n";
                    }

                }

            }
        }else {
            unlink('token');
        }
    } catch (MarketplaceWebService_Exception $ex) {
        echo $colors->getColoredString('Exception error:',"red");
        echo "\n";
        unlink('token');
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");

    }
}

function invokeGetReportList(MarketplaceWebService_Interface $service, $request)
{
    try {
        $response = $service->getReportList($request);
        $database = new Database();
        $colors = new Colors();
        if ($response->isSetGetReportListResult()) {

            $getReportListResult = $response->getGetReportListResult();
            if ($getReportListResult->isSetNextToken())
            {
                echo $colors->getColoredString('invokeGetReportList:Put token',"red");
                echo "\n";
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
                        echo $colors->getColoredString('Imported nexttoken:',"yellow");
                        echo $colors->getColoredString($report_id,"red");
                        echo "\n";
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

function help()
{
    $argv = $_SERVER['argv'];
    $colors = new Colors();
    echo $colors->getColoredString("Usage: " . $argv[0] . " [OPTION]... [PART]","green");
    echo "\n";
    echo $colors->getColoredString("Executes Audience Media cronjobs.","green");
    echo "\n";
    echo $colors->getColoredString("General options:","green");
    echo "\n";
    echo $colors->getColoredString("  -h,--help          display this help and exit ","green");
    echo "\n";
    echo $colors->getColoredString("  -m,--month          get data follow month ","green");
    echo "\n";

}


