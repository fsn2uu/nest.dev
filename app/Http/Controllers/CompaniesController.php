<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompaniesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $payout = \Stripe\Payout::create([
        //   "amount" => 1000, // amount in cents
        //   "currency" => "usd",
        //   //"recipient" => $recipient_id,
        //   "destination" => 'ba_1F8D4vL9vCMCUJLEWnMSwrdv',
        //   "statement_descriptor" => "JULY SALES"
        // ]);
        // dd($payout);
        $company = Company::where('id', \Auth::user()->company->id)->first();

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $plan = \Stripe\Customer::retrieve($company->stripe_id)->__toArray(true);
        $package = \Stripe\Plan::retrieve(\Auth::user()->package())->__toArray(true);
        if($company->stripe_account_id != '')
        {
            $account = \Stripe\Account::retrieve($company->stripe_account_id)->__toArray(true);
            $bank = \Stripe\Account::retrieveExternalAccount($company->stripe_account_id, $company->stripe_bank_id)->__toArray(true);
        }
        else
        {
            $account = null;
            $bank = null;
        }

        return view('companies.show')
            ->withCompany($company)
            ->withPlan($plan)
            ->withPackage($package)
            ->withAccount($account)
            ->withBank($bank);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'logo'    => 'sometimes|nullable|mimes:jpg,jpeg,bmp,png,heic,heif',
        ]);

        $company = Company::where('id', \Auth::user()->company->id)->first();

        if($request->hasfile('business_logo')):
            if($company->logo != ''):
                \Storage::delete('storage/'.$company->logo);
            endif;
            $path = $request->file('business_logo')->store(\Auth::user()->company_id.'/company/logo', 'public');
            $request->merge(['logo' => $path]);
        endif;

        $company->update($request->except(['_token']));

        return redirect()->back();
    }

    public function add_bank_account_post(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $request->validate([
            'routing_number' => 'required',
            'acount_number' => 'required',
            'tax_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'state' => 'required',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'email' => 'required',
            'id_number' => 'required',
            'phone' => 'required',
            'tos_acceptance' => 'required',
        ]);

        $account = \Stripe\Account::create([
          "type" => "custom",
          "country" => "US",
          "email" => \Auth::user()->email,
          "business_type" => 'company',
          "requested_capabilities" => ["card_payments", "transfers"],
          "external_account" => [
              "object"    => 'bank_account',
              "country"    => 'US',
              "currency"    => 'usd',
              "account_holder_name"    => $request->first_name.' '.$request->last_name,
              "account_holder_type"    => 'company',
              "routing_number"    => $request->routing_number,
              "account_number"    => $request->account_number,
          ],
          "business_profile"    => [
              "mcc"    => 6513,
              "name"    => \Auth::user()->company->name,
              "url"    => \Auth::user()->company->website,
          ],
          "tos_acceptance" => [
              "date"    => time(),
              "ip"    => $request->ip(),
          ],
          "company" => [
              "name"    => \Auth::user()->company->name,
              "phone"    => \Auth::user()->company->phone,
              "tax_id"    => $request->tax_id,
              "address"    => [
                  "city"    => \Auth::user()->company->city,
                  "line1"    => \Auth::user()->company->address,
                  "postal_code"    => \Auth::user()->company->zip,
                  "state"    => \Auth::user()->company->state,
              ],
          ],
        ]);
        //dd($account->__toArray());
        $account = $account->__toArray();
        // the account id needs to go in the company record
        \Auth::user()->company->update([
            'stripe_account_id' => $account['id'],
        ]);

        $person = \Stripe\Account::createPerson(
          $account['id'],
          [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address'    => [
                'city' => $request->city,
                'country' => 'US',
                'line1' => $request->address,
                'postal_code' => $request->postal_code,
                'state' => $request->state,
            ],
            'dob' => [
                'day' => $request->day,
                'month' => $request->month,
                'year' => $request->year,
            ],
            'email' => $request->email,
            'id_number' => $request->id_number,
            'phone' => $request->phone,
            'relationship' => [
                'account_opener' => true,
                'title' => 'CEO',
                'owner' => true,
                'percent_ownership' => 100,
            ],
          ]
        );

        return redirect()->route('companies.show');
    }
}
