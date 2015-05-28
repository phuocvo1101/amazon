<?php
class OrdersModel extends Database
{

    public function getOrders($search='')
	{
 
        $arrSearch=array();
        $strLike = '';
        if(!empty($search)){
                $strLike = ' WHERE (amazonorder like ? OR buyer LIKE ? OR itemspurchased LIKE ?)';
            }   
        $query="SELECT * FROM order "." ".$strLike.' ORDER BY datesend';
        if(!empty($search)) {
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
        }
        
        $this->setquery($query);
        
        $result = $this->loadAllRows($arrSearch);

        return $result;
	}
    
     public function getOrderslimit($start,$limit,$search='')
	{
	  // echo 'sss';die();
       $arrSearch=array();
        $strLike = '';
        if(!empty($search)){
                $strLike = ' WHERE (amazonorder like ? OR buyer LIKE ? OR itemspurchased LIKE ?)';
        }   
        $query="SELECT * FROM order "." ".$strLike." "." ORDER BY datesend desc LIMIT ?, ?";
       
        $this->setQuery($query);
        if(!empty($search)) {
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
        }

        $arrSearch[] =array($start,PDO::PARAM_INT);
        $arrSearch[] =array($limit,PDO::PARAM_INT);

        $result = $result= $this->loadAllRows($arrSearch);
        // var_dump($result);die();
        if(!$result) {
            return array();
        }

        return $result;
	}
    
    
	


}
?>