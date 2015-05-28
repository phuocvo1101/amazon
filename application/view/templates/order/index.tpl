 <form action="index.php?controller=order&action=index" method="post">

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            
          
           <div class="col-xs-6 col-sm-6">
                 <ol class="breadcrumb">   
                  <li><a href="#">Home</a></li>
                  <li class="active"><a href="#">Order</a></li>
                </ol>
            </div>
          <div class="row">
           <div class="col-xs-6 col-sm-3 placeholder">
              <h1 align="left">Feedback</h1>
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
                  <th>orderdate</th>
                  <th>datetosend</th>
                  <th>datesend</th>
                  <th>buyer</th>
                  <th>itemspurchased</th>
                  <th>status</th>
                  <th>fba</th>
                  <th>dns</th>
                  <th>solicitreason</th>
                  <th>email</th>
                </tr>
              </thead>
              <tbody>
              {if isset($orders)}
                    {foreach $orders as $key=>$item}
                <tr>
                  <td>{$item->amazonorder}</td>
                  <td>{$item->orderdate}</td>
                  <td>{$item->datetosend}</td>
                  <td>{$item->datesend}</td>
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