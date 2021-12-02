
<div class="row">
    @foreach ($wallets as $wallet)
        <div class="col-md-4">
            <div class="card bg-primary">
                <div class="card-header">
                    
                        <a href="{{ route('transaction.by_account',$wallet->id) }}" class="text-white">
                            <h4>
                            {{ $wallet->account_name }}
                            </h4>
                        </a>
                    
                </div>
                <div class="card-body">
                    <h4>
                        <i class="ti-credit-card"></i>  @money($wallet->balance * 100,"MYR")
                    </h4>            
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('wallets.topup',['wallet'=>$wallet]) }}" 
                            class="btn btn-sm rounded btn-outline-primary">
                            <i class="ti-upload"></i> Top up</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('wallets.transfer',['wallet'=>$wallet]) }}" 
                            class="btn btn-sm  rounded btn-outline-secondary">
                            <i class="ti-download"></i> Transfer</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('wallets.request_money',['wallet'=>$wallet]) }}" 
                            class="btn btn-sm rounded btn-outline-danger">
                            <i class="ti-money"></i> Request</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>   
    @endforeach      
</div>