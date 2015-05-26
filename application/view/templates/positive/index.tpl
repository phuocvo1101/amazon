
<form>
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
                  <input type="text" class="form-control" aria-label="...">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">All <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </div>
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
                  <td>{$item->orderdate}</td>
                  <td>{$item->lastsolicited}</td>
                  <td>{$item->feedbackdate}</td>
                  <td>{$item->fba}</td>
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