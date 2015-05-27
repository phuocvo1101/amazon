<?php
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

$database = new Database();
$query = 'SELECT * FROM reportlist WHERE status=0 limit 0,1';
$database->setQuery($query);
$listreportid = $database->loadAllRows();

foreach($listreportid as $itemReport) {
    $request = new MarketplaceWebService_Model_GetReportRequest();
    $request->setMerchant(MERCHANT_ID);
    $request->setReport(@fopen('php://memory', 'rw+'));
    $request->setReportId($itemReport->report_id);
    invokeGetReport($service, $request,$database);
}

echo 'Imported FeedBack was successful';

function invokeGetReport(MarketplaceWebService_Interface $service, $request,$database)
{
    try {
        $response = $service->getReport($request);
        $fp = $request->getReport();
        $row = array();
        $arrResult=array();
        $i=0;
        while($fields = fgetcsv($fp, 0, "\t")) {

            if($i!=0) {


               $order = invoke_getorder($fields[7]);

                $orderItem = invoke_getorderitem($fields[7]);
                $buyer = $order['GetOrderResponse']['GetOrderResult']['Orders']['Order']['BuyerName'];
                $rating = $fields[1];
                $comment = $fields[2];
                $sku = $orderItem['ListOrderItemsResponse']['ListOrderItemsResult']['OrderItems']['OrderItem']['SellerSKU'];
                $date = $order['GetOrderResponse']['GetOrderResult']['Orders']['Order']['PurchaseDate'];;
                $orderdate = date("U",strtotime($date));
                $arrDate = explode('/',$fields[0]);
                $feedbackdate = mktime(0,0,0,$arrDate[0],$arrDate[1],'20'.$arrDate[2]);
                if($order['GetOrderResponse']['GetOrderResult']['Orders']['Order']['FulfillmentChannel']=='AFN') {
                    $fba = 1;
                } else {
                    $fba=0;
                }

                $query = 'INSERT INTO feedback(amazonorder,buyer,rating,comment,skus,orderdate,feedbackdate,fba)
                          VALUES('.$fields[7].',"'.$buyer.'",'.$rating.',"'.$comment.'","'.$sku.'",'.$orderdate.','.$feedbackdate.','.$fba.')';
                $database->setQuery($query);
                $result = $database->execute();

            }
            $i++;
        }

        fclose($fp);

        $query = 'UPDATE reportlist SET status=1 WHERE report_id='.$request->getReportId();
        $database->setQuery($query);
        $result = $database->execute();
        if($result) {
            echo 'Imported :'.$request->getReportId()."\n";
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

function invoke_getorder($orderId)
{
//    include_once('./mws/order.config.inc.php');



    $config = array (
        'ServiceURL' => 'https://mws.amazonservices.com/Orders/2013-09-01',
        'ProxyHost' => null,
        'ProxyPort' => -1,
        'ProxyUsername' => null,
        'ProxyPassword' => null,
        'MaxErrorRetry' => 3,
    );
    $acces_key =  AWS_ACCESS_KEY_ID;
    $secret_key =  AWS_SECRET_ACCESS_KEY;

    $applicationname =  APPLICATION_NAME;
    $version = '2013-09-01';




    $service = new MarketplaceWebServiceOrders_Client(
        $acces_key,
        $secret_key,
        $applicationname,
        $version, $config);


    $parameters = array (
        'SellerId' => MERCHANT_ID
    );
    $request = new MarketplaceWebServiceOrders_Model_GetOrderRequest($parameters);
    $request->setAmazonOrderId($orderId);
    $response = $service->GetOrder($request);
    $dom = new DOMDocument();
    $dom->loadXML($response->toXML());
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $xmlString = $dom->saveXML();


    return MarketplaceWebServiceOrders_XmlToArray::createArray($xmlString);

}


function invoke_getorderitem($orderId)
{
//    include_once('./mws/order.config.inc.php');



    $config = array (
        'ServiceURL' => 'https://mws.amazonservices.com/Orders/2013-09-01',
        'ProxyHost' => null,
        'ProxyPort' => -1,
        'ProxyUsername' => null,
        'ProxyPassword' => null,
        'MaxErrorRetry' => 3,
    );
    $acces_key =  AWS_ACCESS_KEY_ID;
    $secret_key =  AWS_SECRET_ACCESS_KEY;

    $applicationname =  APPLICATION_NAME;
    $version = '2013-09-01';




    $service = new MarketplaceWebServiceOrders_Client(
        $acces_key,
        $secret_key,
        $applicationname,
        $version, $config);


    $request = new MarketplaceWebServiceOrders_Model_ListOrderItemsRequest();
    $request->setSellerId(MERCHANT_ID);
    $request->setAmazonOrderId($orderId);
    $response = $service->ListOrderItems($request);
    $dom = new DOMDocument();
    $dom->loadXML($response->toXML());
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $xmlString = $dom->saveXML();
    return MarketplaceWebServiceOrders_XmlToArray::createArray($xmlString);

}