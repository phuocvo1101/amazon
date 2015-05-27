
<form action="index.php?controller=positive&action=index" method="post">
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <h1 align="left">Feedback</h1>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6">
                 <ol class="breadcrumb">
                  <li><a href="index.php?controller=positive&action=index">Positive Feedback</a></li>
                  <li><a href="index.php?controller=negative&action=index">Negative Feedback</a></li>
                </ol>
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
                  <th>Buyer</th>
                  <th>Rating</th>
                  <th>Comments</th>
                  <th>SKUs</th>
                  <th>Order Date</th>
                  <th>Last Solicited</th>
                  <th>Feedback Date</th>
                  <th>FBA?</th>
                  <th>Removal Requested</th>
                  <th>Case Id</th>
                  <th>Notes</th>
                  <th>Removed?</th>
                </tr>
              </thead>
              <tbody>
              {if isset($positives)}
                    {foreach $positives as $key=>$item}
                <tr>
                  <td>{$item->amazonorder}</td>
                  <td>{$item->buyer}</td>
                  <td>{$item->rating}</td>
                  <td>{$item->comment}</td>
                  <td>{$item->skus}</td>
                  <td>{$item->orderdate|date_format:"%D"}</td>
                  <td>{$item->lastsolicited}</td>
                  <td>{$item->feedbackdate|date_format:"%D"}</td>
                  <td>{if $item->fba==1}
                         AFN
                    {else}
                        MFN
                    {/if}
                    </td>
                  <td>{$item->removalrequested}</td>
                  <td>{$item->caseid}</td>
                  <td>{$item->notes}</td>
                  <td align="center"><input type="checkbox" /></td>
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