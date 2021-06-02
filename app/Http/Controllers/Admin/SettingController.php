<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Options;
use App\Mail\SendTestEmail;
use Mail;
use App\Trails\MailTrait;



class SettingController extends Controller
{
    use MailTrait;

    public function getDeveloperConfig()
    {
    	$content = Options::where('type', 'dev-config')->first();
    	$content = json_decode($content->content);
    	return view('backend.options.developer-config', compact('content'));
    }

    public function postDeveloperConfig(Request $request)
    {
    	$options = Options::where('type', 'dev-config')->first();
		$options->content = !empty($request->content) ? json_encode($request->content) : null;
    	$options->save();
    	flash('Cập nhật thành công.')->success();
    	return back();
    }

    public function getGeneralConfig()
    {
        $content = Options::where('type', 'general')->first();
        $content = json_decode($content->content);
        return view('backend.options.general', compact('content'));
    }

    public function postGeneralConfig(Request $request)
    {
        $options = Options::where('type', 'general')->first();
        $options->content = !empty($request->content) ? json_encode($request->content) : null;
        $options->save();
        flash('Cập nhật thành công.')->success();
        return back();
    }

    public function getSmtpConfig()
    {
        $data = Options::where('type', 'smtp-config')->first();
        $content = json_decode($data->content);
        return view('backend.options.smtp-config', compact('content'));   
    }

    public function postSmtpConfig(Request $request)
    {
        $content = Options::where('type', 'smtp-config')->first();
        $content->content = !empty($request->content) ? json_encode($request->content) : null;
        $content->save();
        flash('Cập nhật thành công.')->success();
        return back();
    }

    public function postSendTestEmail(Request $request)
    {
        $this->initMailConfig();
        $contact['email'] = $request->smtp_email;
        $contact['title'] = $request->smtp_title;
        $contact['smtp_message'] = $request->smtp_message;
        Mail::to($contact['email'])->send(new SendTestEmail($contact));
        flash('Gửi thành công')->success();
        return back();
    }

    public function getTagsConfig()
    {
        $data = Options::where('type', 'tags-config')->first();
        $content = json_decode($data->content);
        return view('backend.options.tags-config', compact('content'));
    }

    public function postTagsConfig(Request $request)
    {
        $content = Options::where('type', 'tags-config')->first();
        $content->content = !empty($request->content) ? json_encode($request->content) : null;
        $content->save();
        flash('Cập nhật thành công.')->success();
        return back();
    }
}
