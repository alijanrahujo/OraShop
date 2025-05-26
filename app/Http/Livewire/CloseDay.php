<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Load;
use App\Models\Account;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\CloseAccount;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class CloseDay extends Component
{
    public $date, $closeable = true;
    public $accountAll, $loads, $accounts, $data;
    //Loads
    public $load_id, $load_amount;
    public $load=[], $totalPrevious = 0, $totalDeposit = 0, $totalCurrent = 0, $totalLoad = 0, $totalCommission = 0;
    //Accounts
    public $account_ids=[], $account=[],$accountPrevious=0, $accountDeposit=0, $accountCurrent=0,$accountCredit=0, $totalAccount =0, $accountCommission = 0;
    //
    public $accessoryPurchase, $accessorySale,$closingAmount=0, $openingAmount=0, $profit=0;

    public function mount()
    {
        if(Session::has('date'))
        {
            $this->date = Session::get('date', Carbon::today()->format('Y-m-d'));
        }
        else
        {
            $this->date = Carbon::today()->format('Y-m-d');
        }

        $this->accountAll = Account::get();
        $this->loads = Load::get();
        $this->accounts = collect();
        $this->data = collect();

        $this->loadFetch();
        $this->fetchAccount();
        $this->fetchAccessory();
        $this->checkCloseAccount();

        $this->calculateTotals();
    }

    public function updated($propertyName)
    {
        // Check if the updated field is a current value
        if (str_starts_with($propertyName, 'load.') && str_ends_with($propertyName, '.current')) {
            $key = explode('.', $propertyName)[1];

            // Prevent division by zero
            $commValue = $this->load[$key]['comm'] ?? 0;
            if ($commValue != 0) {
                $current = $this->load[$key]['current'] ?? 0;
                $previous = $this->load[$key]['previous'] ?? 0;
                $deposit = $this->load[$key]['deposit'] ?? 0;
                $credit = ($previous+$deposit) - $current;
                $this->load[$key]['credit'] = $credit;
                $per = $commValue*100/1000;
                $this->load[$key]['commission'] = $credit / 100 * $per;
            } else {
                $this->load[$key]['commission'] = 0;
            }
        }
        else if(str_starts_with($propertyName, 'account.') && str_ends_with($propertyName, '.current'))
        {
            $key = explode('.', $propertyName)[1];
            $current = $this->account[$key]['current'] ?? 0;
            $previous = $this->account[$key]['previous'] ?? 0;
            $credit = ($previous - $current >= 0) ? $previous - $current:0;
            $this->account[$key]['deposit'] = ($current - $previous > 0)? $current - $previous:0;
            $this->account[$key]['credit'] = $credit;
        }

        $this->calculateTotals();
    }

    public function updatedDate($value)
    {
        $validatedDate = $this->validateDate($value);

        if ($validatedDate) {
            $this->date = $validatedDate;
            Session::put('date', $this->date);
        }

        $this->accountCommission = 0;

        $this->loadFetch();
        $this->fetchAccount();
        $this->fetchAccessory();
        $this->checkCloseAccount();
        $this->calculateTotals();
    }

    public function loadFetch()
    {
        foreach($this->loads as $key=>$load)
        {
            $deposit = Transaction::where(['transactionable_type'=>'App\Models\Load','transactionable_id'=>$load->id,'type'=>'deposit','transaction_date'=>$this->date])->sum('amount');
            $latestCloseAccount = $load->closeAccounts()->where('date','<',$this->date)->orderBy('date', 'desc')->first();
            $this->load[$key] = [
                'id' => $load->id,
                'comm' => $load->commission,
                'previous' => $latestCloseAccount->current ?? 0,
                'deposit' => $deposit,
                'current' => null,
                'credit' => 0,
                'commission' => null,
            ];
        }
        $this->calculateTotals();
    }

    public function fetchAccessory()
    {
        $this->accessoryPurchase = Transaction::where(['transactionable_type'=>'App\Models\Accessory','type'=>'purchase','transaction_date'=>$this->date])->sum('amount');
        $this->accessorySale = Transaction::where(['transactionable_type'=>'App\Models\Accessory','type'=>'sale','transaction_date'=>$this->date])->sum('amount');
    }

    public function fetchAccount()
    {
        $this->accounts = Account::whereIn('id',$this->account_ids)->get();

        foreach($this->accounts as $key=>$account)
        {
            $this->account[$key] = [
                'id' => $account->id,
                'previous' => 0,
                'deposit' => 0,
                'current' => null,
                'credit' => 0,
            ];
        }
    }

    public function loadDeposit()
    {
        $this->validate([
            'date' => 'required|date',
            'load_id' => 'required|integer',
            'load_amount' => 'required|numeric'
        ]);

        $load = Load::find($this->load_id);
        if($load)
        {
            $load->transactions()->create([
                'user_id' => auth()->id(),
                'type' => 'deposit',
                'transaction_date' => $this->date,
                'amount' => $this->load_amount,
                'previous' => $load->balance,
                'description' => 'Load Deposit',
            ]);

            $load->balance += $this->load_amount;
            $load->save();
        }

        $this->loadFetch();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function filter()
    {
        $this->validate([
            'account_ids' => 'required|array|min:1',
        ]);

        $this->fetchAccount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function calculateTotals()
    {
        $this->totalPrevious = 0;
        $this->totalCurrent = 0;
        $this->totalCommission = 0;
        $this->totalDeposit = 0;
        $this->totalSale = 0;

        foreach ($this->load as $item) {
            $this->totalPrevious += $item['previous'] ?? 0;
            $this->totalCurrent += $item['current'] ?? 0;
            $this->totalCommission += $item['commission'] ?? 0;
            $this->totalDeposit += $item['deposit'] ?? 0;
            $this->totalSale += $item['credit'] ?? 0;
        }
        $this->totalLoad = ($this->totalPrevious + $this->totalDeposit) - $this->totalCurrent;

        $this->accountPrevious= 0;
        $this->accountDeposit = 0;
        $this->accountCurrent= 0;
        $this->accountCredit= 0;
        $this->totalAccount = 0;

        foreach($this->account as $account)
        {
            $this->accountPrevious += $account['previous'];
            $this->accountDeposit += $account['deposit'];
            $this->accountCurrent += $account['current'];
            $this->accountCredit += $account['credit'];
        }

        $this->totalAccount = $this->accountDeposit-$this->accountCredit;

        $this->openingAmount = $this->totalPrevious + $this->accountPrevious;
        $this->closingAmount = ($this->accessoryPurchase-$this->accessorySale) + $this->totalLoad + $this->totalCommission + $this->totalAccount + $this->accountCommission;

        $this->profit = $this->closingAmount-$this->openingAmount;

    }

    public function CloseAccount()
    {

        $this->validate(
        [
            'date' => 'required|date',
            'load.*.current' => 'required|numeric|min:0',
            'account.*.current' => 'required|numeric|min:0',
        ],
        [
            'date.required' => 'The date is required.',
            'load.*.current.required' => 'Current value for load is required.',
            'account.*.current.required' => 'Current value for account is required.',
        ]);

        // LOAD INSERT
        foreach($this->load as $value)
        {
            $load = Load::find($value['id']);
            if($load)
            {
                $load->closeAccounts()->create([
                    'title' => $load->title,
                    'previous' => $value['previous'] ?? 0,
                    'current' => $value['current'] ?? 0,
                    'debit' => $value['deposit'] ?? 0,
                    'credit' => $value['credit'] ?? 0,
                    'commission' => $value['commission'] ?? 0,
                    'balance' => ($value['current'] - $value['previous'])+ $value['commission'],
                    'date' => $this->date,
                    'user_id' => auth()->id(),
                ]);
            }
        }


        //ACCOUNT INSERT
        foreach($this->account as $key=>$value)
        {
            $account = Account::find($value['id']);
            if($account)
            {
                $commission = ($key==0)? $this->accountCommission:0;
                $account->closeAccounts()->create([
                    'title' => $account->title.' ('.$account->bank_name.')',
                    'previous' => $value['previous'] ?? 0,
                    'current' => $value['current'] ?? 0,
                    'debit' => $value['deposit'] ?? 0,
                    'credit' => $value['credit'] ?? 0,
                    'commission' => $commission,
                    'balance' => ($value['current'] - $value['previous'])+ $commission,
                    'date' => $this->date,
                    'user_id' => auth()->id(),
                ]);
            }
        }


    }

    public function checkCloseAccount()
    {
        $closeAccount = CloseAccount::where('date',$this->date)->get();
        if(count($closeAccount)>0)
        {
            $this->closeable = false;
            $loadKey = 0;
            $accountKey = 0;
            $this->account_ids = [];

            foreach($closeAccount as $close)
            {
                if($close->closeable_type == 'App\Models\Load')
                {
                    $this->load[$loadKey] = [
                        'id' => $close->closeable_id,
                        'previous' => $close->previous,
                        'deposit' => $close->debit,
                        'current' => $close->current,
                        'credit' => $close->credit,
                        'commission' => $close->commission,
                    ];
                    $loadKey++;
                }
                else if($close->closeable_type == 'App\Models\Account')
                {
                    $this->account[$accountKey] = [
                        'id' => $close->closeable_id,
                        'previous' => $close->previous,
                        'deposit' => $close->debit,
                        'current' => $close->current,
                        'credit' => $close->credit,
                    ];
                    $accountKey++;
                    $this->accountCommission += $close->commission;
                    $this->account_ids[] = $close->closeable_id;
                }
            }
            $this->accounts = Account::whereIn('id',$this->account_ids)->get();
            $this->calculateTotals();
        }
        else
        {
            $this->closeable = true;
        }

        // dd($this->closeable);
    }


    private function validateDate($date)
    {
        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function render()
    {
        return view('livewire.close-day');
    }
}
