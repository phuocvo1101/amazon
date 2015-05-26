<?php
class ManageModel extends Database
{

    public function getNegatives()
	{
        $where= "IN (1,2,3)";
        $query="SELECT * FROM feedback	WHERE rating ".$where;
        $this->setquery($query);
        
        $result = $this->loadAllRows();
        //var_dump($result);die();

        return $result;
	}
     public function getNegativeslimit($start,$limit)
	{
	  // echo 'sss';die();
        $where= "IN (1,2,3)";
        $query="SELECT * FROM feedback	WHERE rating ".$where." "." LIMIT ?, ?";
       
        $this->setQuery($query);

        $result = $result= $this->loadAllRows(array(
            array($start,PDO::PARAM_INT),
            array($limit,PDO::PARAM_INT)
        ));
        // var_dump($result);die();
        if(!$result) {
            return false;
        }
        return $result;
	}
    
     public function getPositives()
	{
        $where= "IN (4,5)";
        $query="SELECT * FROM feedback	WHERE rating ".$where;
        $this->setquery($query);
        
        $result = $this->loadAllRows();
        //var_dump($result);die();

        return $result;
	}
     public function getPositiveslimit($start,$limit)
	{
	  // echo 'sss';die();
        $where= "IN (4,5)";
        $query="SELECT * FROM feedback	WHERE rating ".$where." "." LIMIT ?, ?";
       
        $this->setQuery($query);

        $result = $result= $this->loadAllRows(array(
            array($start,PDO::PARAM_INT),
            array($limit,PDO::PARAM_INT)
        ));
        // var_dump($result);die();
        if(!$result) {
            return false;
        }
        return $result;
	}


}