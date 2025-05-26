<div>
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Crovex</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sales</h4>
                    <div class="row">
                        <div class="col-md-3 offset-md-6">
                            <div class="form-group">
                                <input
                                    type="date"
                                    id="date"
                                    name="date"
                                    wire:model.live="date"
                                    class="form-control @error('date') is-invalid @enderror"
                                >
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

        <form wire:submit.prevent="CloseAccount">
            @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body order-list">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title mt-0 mb-3">Load</h4>
                            <div class="ml-auto">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#loadModal" {{ ($closeable)?'':'disabled' }}>Deposit</button>
                            </div>
                        </div>

                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <th>Previous Balance</th>
                                    <th>Deposit</th>
                                    <th>Current Balance</th>
                                    <th>Sale</th>
                                    <th>Comm</th>
                                </tr>
                                @foreach ($loads as $key=>$load)
                                <input type="hidden" name="load_id[]" value="{{$load->id}}">
                                <input type="hidden" name="date" value="{{$date}}">
                                <tr>
                                    <td><label>{{$load->title}}</label></td>
                                    <td><input type="number" wire:model.lazy="load.{{$key}}.previous" readonly class="form-control"></td>
                                    <td><input type="number" wire:model.lazy="load.{{$key}}.deposit" readonly class="form-control"></td>
                                    <td><input type="number" wire:model.lazy="load.{{$key}}.current" class="form-control @error('load.'.$key.'.current') is-invalid @enderror"></td>
                                    <td><input type="number" wire:model.lazy="load.{{$key}}.credit" readonly class="form-control"></td>
                                    <td><input type="number" wire:model.lazy="load.{{$key}}.commission" class="form-control"></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>Rs: <span>{{$totalPrevious}}</span></td>
                                    <td>Rs: <span>{{$totalDeposit}}</span></td>
                                    <td>Rs: <span>{{$totalCurrent}}</span></td>
                                    <td>Rs: <span>{{$totalSale}}</span></td>
                                    <td>Rs: <span>{{$totalCommission}}</span></td>
                                </tr>
                            </table>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

             <div class="col-lg-12">
                <div class="card">
                    <div class="card-body order-list">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title mt-0 mb-3">Accounts</h4>
                            <div class="ml-auto">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#accountModal" {{ ($closeable)?'':'disabled' }}>Select Account</button>
                            </div>
                        </div>
                            <table class="table">
                                <th>Title</th>
                                <th>Previous Amount</th>
                                <th>Current Amount</th>
                                @foreach ($accounts as $key=>$account)
                                <tr>
                                    <td><label>{{$account->title}} ({{$account->bank_name}})</label></td>
                                    <td><input type="number" wire:model.lazy="account.{{$key}}.previous" readonly class="form-control"></td>
                                    <td><input type="number" wire:model.lazy="account.{{$key}}.current" class="form-control @error('account.'.$key.'.current') is-invalid @enderror"></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>Total</th>
                                    <th>Rs {{$accountPrevious}}</th>
                                    <th>Rs {{$accountCurrent}}</th>
                                </tr>
                                <tr>
                                    <th><label>Account Commissions</label></th>
                                    <th><input type="number" wire:model.lazy="accountCommission" class="form-control"></th>
                                </tr>
                            </table>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body order-list">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title mt-0 mb-3">Close Sheet</h4>
                        </div>
                            <table class="table">
                                <tr>
                                    <td>Accessories Purchase</td>
                                    <td class="text-danger">Rs: {{$accessoryPurchase}}</td>
                                </tr>

                                <tr>
                                    <td>Accessories Sale</td>
                                    <td>Rs: {{$accessorySale}}</td>
                                </tr>

                                <tr>
                                    <td>Loads</td>
                                    <td>Rs: {{$totalSale}}</td>
                                </tr>

                                <tr>
                                    <td>Load Commissions</td>
                                    <td>Rs: {{$totalCommission}}</td>
                                </tr>

                                <tr>
                                    <td>Accounts</td>
                                    <td>Rs: {{$totalAccount}}</td>
                                </tr>

                                <tr>
                                    <td>Account Commissions</td>
                                    <td>Rs: {{$accountCommission}}</td>
                                </tr>

                                <tr>
                                    <td>Closing Balance</td>
                                    <td>Rs: {{$closingAmount}}</td>
                                </tr>
                                <tr>
                                    <td>Opening Balance</td>
                                    <td>Rs: {{$openingAmount}}</td>
                                </tr>
                                <tr>
                                    <td>Profit</td>
                                    <td>Rs: {{$profit}}</td>
                                </tr>
                            </table>

                            <button type="submit" class="btn btn-primary w-100" {{ ($closeable)?'':'disabled' }}>Close Sheet</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

        </div><!--end row-->
        </form>

    </div><!-- container -->

     <!-- Account Modal -->
    <div wire:ignore.self class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountModalTitle">Select Accounts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="filter">
                    @csrf
                    <div class="modal-body">

                        @foreach ($accountAll as $account)

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="account_ids" value="{{$account->id}}" id="account_{{$account->id}}">
                            <label class="form-check-label" for="account_{{$account->id}}">
                                {{$account->title}} ({{$account->bank_name}})
                            </label>
                        </div>
                        @endforeach
                        @error('account_ids')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Load Modal -->
    <div wire:ignore.self class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="loadModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loadModalTitle">Deposit Load</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="loadDeposit">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="load_id" class="control-label">Load Account</label>
                            <select name="load_id" wire:model="load_id" class="form-control">
                                <option value="">Select Load Account</option>
                                @foreach ($loads as $load)
                                <option value="{{$load->id}}">{{$load->title}}</option>
                                @endforeach
                            </select>
                            @error('load_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount" class="control-label">Amount</label>
                            <input type="number" name="amount" wire:model="load_amount" class="form-control" id="amount">
                             @error('load_amount')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
     window.addEventListener('close-modal', () => {
        $('#accountModal').modal('hide');
        $('#loadModal').modal('hide');
    });
</script>
