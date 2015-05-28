<?php
class ManageModel extends Database
{

    public function getNegatives($search='')
	{
 
        $arrSearch=array();
        $strLike = '';
        $where= "IN (1,2,3)";
        if(!empty($search)){
                $strLike = ' AND (amazonorder like ? OR buyer LIKE ? or skus LIKE ?)';
            }   
        $query="SELECT * FROM feedback	WHERE rating ".$where." ".$strLike.' ORDER BY feedbackdate';
        if(!empty($search)) {
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
        }
        
        $this->setquery($query);
        
        $result = $this->loadAllRows($arrSearch);
       // var_dump($result);die();

        return $result;
	}
   
    
     public function getNegativeslimit($start,$limit,$search='')
	{
	  // echo 'sss';die();
       $arrSearch=array();
        $strLike = '';
        $where= "IN (1,2,3)";
        if(!empty($search)){
                $strLike = ' AND (amazonorder like ? OR buyer LIKE ? or skus LIKE ?)';
        }   
        $query="SELECT * FROM feedback	WHERE rating ".$where." ".$strLike." "." ORDER BY feedbackdate desc LIMIT ?, ?";
       
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
    
     public function getPositives($search='')
	{
	   $arrSearch=array();
        $strLike = '';
        $where= "IN (4,5)";
        if(!empty($search)){
                $strLike = ' AND (amazonorder like ? OR buyer LIKE ? or skus LIKE ?)';
            }   
        $query="SELECT * FROM feedback	WHERE rating ".$where." ".$strLike.' ORDER BY feedbackdate';
        if(!empty($search)) {
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
            $arrSearch[] = array('%'.$search.'%',PDO::PARAM_STR);
        }
        
        $this->setquery($query);
        
        $result = $this->loadAllRows($arrSearch);
       // var_dump($result);die();

        return $result;
	   //////
	}
     public function getPositiveslimit($start,$limit,$search='')
	{
	   $arrSearch=array();
        $strLike = '';
        $where= "IN (4,5)";
        if(!empty($search)){
                $strLike = ' AND (amazonorder like ? OR buyer LIKE ? or skus LIKE ?)';
        }   
        $query="SELECT * FROM feedback	WHERE rating ".$where." ".$strLike." "." ORDER BY feedbackdate desc LIMIT ?, ?";
       
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