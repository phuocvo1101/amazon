<?php
class DashboardModel extends Database
{
     public function sumNegative()
    {
        $query= "SELECT * from feedback WHERE rating IN(1,2,3)";
        $this->setquery($query);
        
        $result = $this->loadAllRows();
        return $result;
    }
     public function sumPositive()
    {
        $query= "SELECT * from feedback WHERE rating IN(4,5)";
        $this->setquery($query);
        
        $result = $this->loadAllRows();
        return $result;
    }
     public function sumOrder()
    {
        $query= "SELECT * from orders";
        $this->setquery($query);
        
        $result = $this->loadAllRows();
        return $result;
    }
}
?>