<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dmroom;
use App\Models\DmroomMessage;
use App\Models\User;
use App\Http\Requests\Mypage\DmroomController\MessageRequest;
use App\Services\UserNotificationService;

class DmroomController extends Controller
{
    private $user_notification_service;
    
    public function __construct(UserNotificationService $user_notification_service)
    {
        $this->user_notification_service = $user_notification_service;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Dmroom $dmroom)
    {
        $dmroom_users = Dmroom::where('from_user_id', \Auth::id())->orWhere('to_user_id', \Auth::id())->paginate(10);

        return view('mypage.dm.index',compact('dmroom_users','dmroom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Dmroom $dmroom)
    {
        return view('mypage.dm.create',compact('dmroom','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $dmroom = new Dmroom();
        $dmroom->to_user_id = $request->to_user_id;
        $dmroom->from_user_id = \Auth::id();
        $dmroom->save();
        
        if(isset($request['file_path'])){
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
                'file_path' => $request['file_path']->store('file_paths','public')];
        } else {
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
            ];
        }

        $dmroom_message = $dmroom->dmroomMessages()->create($message);
        $this->user_notification_service->storeUserNotificationDm($dmroom_message);
        return redirect()->route('dm.show', $dmroom->id);
    }

    public function message(MessageRequest $request, Dmroom $dmroom)
    {
        
        if(isset($request['file_path'])){
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
                'file_path' => $request['file_path']->store('file_paths','public')];
        } else {
            $message = [
                'user_id' => \Auth::id(),
                'text' => $request['text'],
                'file_name' => $request['file_name'],
            ];
        }

        $dmroom_message = $dmroom->dmroomMessages()->create($message);
        $this->user_notification_service->storeUserNotificationDm($dmroom_message);
        return redirect()->route('dm.show', $dmroom->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dmroom $dmroom)
    {
        DmroomMessage::where('dmroom_id', $dmroom->id)->where('user_id', '<>', \Auth::id())->update(['is_view' => 1]);

        return view('mypage.dm.show',compact('dmroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
