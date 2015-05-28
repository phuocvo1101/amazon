 <form action="index.php?controller=order&action=index" method="post">

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
                <td colspan="13" align="center">
                    <ul class="pagination" align="center"> 
                      {if isset($listPage)}      
                            <li>{$listPage}</li> 
                        {/if}  
                     </ul>
                </td>
              </tr>
            </table>
          </div>
          
    </div>
</form>