<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Profile;
use App\Models\Order;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    // マイページ画面表示 //////
    public function index(Request $request){

        $loginId = auth()->id();
        $tab = $request->query('tab');
        $profile = collect();
        $sells = collect();
        $orders = collect();

        // プロフィール情報
        $profile = Profile::where('user_id', $loginId)->first();

        // 出品した商品タブ
        if($tab =='sell'){
            // 出品情報
            $sells = Item::where('user_id', $loginId)->paginate(12);
        // 購入した商品タブ
        }else{
            // 注文情報
            $orders = Order::with('item')->where('user_id', $loginId)->paginate(12);
        }

        return view('mypage/index', compact('profile', 'sells', 'orders'));
    }

    // プロフィール編集画面表示 //////
    public function edit(){

        $loginId = auth()->id();

        // プロフィール情報
        $profile = Profile::where('user_id', $loginId)->first() ?? new Profile();
        return view('mypage/profile', ['profile' => $profile]);
    }

    // 更新処理 //////
    public function update(ProfileRequest $request)
    {
        $loginId = auth()->id();
        $hasprofile = Profile::where('user_id', $loginId)->exists();
        $path = null;

        // 商品画像をアップロード
        if($request->file('image')){
            $path = $request->file('image')->store('images/profiles', 'public');
        }
        // すでにプロフィールが存在する場合はUPDATE
        if($hasprofile){

            $profile = Profile::find($request->id);
            $profile->name = $request->name;
            $profile->zipcode = $request->zipcode;
            $profile->adress  = $request->adress;
            $profile->building = $request->building;

            if ($path) {
                $profile->image = $path;
            }
        
            $profile->save();

        // 存在しない場合はINSERT
        }else{

            $data = [
                'name' => $request->name,
                'user_id' => $loginId,
                'zipcode' => $request->zipcode,
                'adress' => $request->adress,
                'building' => $request->building,
            ];
        
            if ($path) {
                $data['image'] = $path;
            }

            Profile::create($data);
        }
        return redirect('/mypage/profile')->with('status', '設定が完了しました！');
    }

    // 住所編集画面表示 //////
    public function addressEdit(){

        $loginId = auth()->id();
        $profile = collect();
        $sells = collect();
        $orders = collect();

        // プロフィール情報
        $profile = Profile::where('user_id', $loginId)->first() ?? new Profile();
        return view('address', compact('profile'));
    }

    // 住所で入力された値を注文画面へ戻す（プロフィールテーブルは更新しない） //////
    public function AddressUpdate(AddressRequest $request)
    {
        return redirect()->to("/purchase/{$request->item_id}?zipcode={$request->zipcode}&adress={$request->adress}&building={$request->building}&payment={$request->payment}");
    }
}