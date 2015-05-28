<script type="text/javascript">
 function answers()
{
  var selectedanswer=document.getElementById("recordlimit").value;
 var frm = document.getElementById("frm");
 frm.action = "index.php?controller=order&action=index&limit="+selectedanswer;
 frm.submit();
}
 </script>
 <form id="frm" action="index.php?controller=order&action=index" method="post">

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            
          <div class="row">
           <div class="col-xs-6 col-sm-12">
                 <ol class="breadcrumb">   
                  <li><a href="#">Home</a></li>
                  <li class="active">Order</li>
                </ol>
            </div>
          </div>
          <div class="row">
           <div class="col-xs-6 col-sm-6 placeholder">
              <h1 class="page-header" align="left"><i class="fa fa-shopping-cart"></i><span>  Orders</span></h1>
            </div>
           <div class="col-sm-2"></div>
          
            <div class="col-sm-4">
                <div class="input-group">
                  <input type="text" class="form-control" id="search" name="search" value="{if isset($search)}{$search}{/if}" placeholder="Search for...">
                  <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" id="go" name="go" value="Go!" />
                  </span>
                </div>
            </div>
             
          </div>
          
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Amazon Order#</th>
                  <th>Order Date</th>
                  <th>Date To Send</th>
                  <th>Date Send</th>
                  <th>Buyer</th>
                  <th>Items Purchased</th>
                  <th>Status</th>
                  <th>FBA?</th>
                  <th>DNS?</th>
                  <th>Solicit Reason</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
              {if isset($orders)}
                    {foreach $orders as $key=>$item}
                <tr>
                  <td>{$item->amazonorder}</td>
                  <td>{$item->orderdate|date_format:"%D"}</td>
                  <td>{$item->datetosend|date_format:"%D"}</td>
                  <td>{$item->datesend|date_format:"%D"}</td>
                  <td>{$item->buyer}</td>
                  <td>{$item->itemspurchased}</td>
                  <td>{$item->status}</td>
                  <td>
                  {if $item->fba==1}
                         AFN
                    {else}
                        MFN
                    {/if}
                  </td>
                  <td><input type="checkbox" {if $item->dns==1}checked="checked"{/if} value="{$item->dns}" /></td>
                  <td>{$item->solicitreason}</td>
                  <td>{$item->email}</td>
                  
                </tr>
                 {/foreach}
              {/if}
                
              </tbody>
             <tr>
                <td colspan="5" align="right">
                        
                    <ul class="pagination" align="center"> 
                        
                      {if isset($listPage)}      
                            <li>{$listPage}</li> 
                        {/if}  
                    </ul>
                </td>
                <td colspan="9" align="center">
                <div>
                Page Size:
                <select id="recordlimit" onchange="answers();">
                    <option {if isset($limit) && $limit==5}selected="selected"{/if} value="5">5 </option>
                    <option {if isset($limit) && $limit==10}selected="selected"{/if} value="10">10 </option>
                    <option {if isset($limit) && $limit==$totalrecords}selected="selected"{/if} value="{$totalrecords}">All</option>
                </select>
                Total Record:<input type="text" size="2" value="{$totalrecords}" disabled="disabaled" />
                Total Page:<input type="text" size="2" value="{$totalpages}" disabled="disabaled"/>
                </div>
                
                </td>
              </tr>
            </table>
          </div>
          
    </div>
</form>