<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Mission;
use App\MissionSetting;
class CustomMessage
{
    public $messaggio = "";
    public function messaggio($messaggio){
            $this->messaggio = $messaggio;
    }
}
class ScheduleCreated extends Notification
{
    use Queueable;

    private $user;
    private $notify_method;
    private $event_type;
    private $message;
    private $to_addr;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notify_method,$to_addr, $message)
    {
        $this->notify_method = $notify_method;
        $this->message = $message;
        $this->to_addr = $to_addr;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail'];
        if ($this->notify_method == 'whatsapp') return ['whatsapp'];
        if ($this->notify_method == 'sms') return ['sms'];
        if ($this->notify_method == 'mail') return ['mail'];
    }
    /* Custom SMS channel */
    public function toSms($notifiable)
    {
        return (new CustomMessage())->messaggio($this->message);
    }
    /* Custom SMS channel */
    public function toWhatsapp($notifiable)
    {
        //dd($this->message);
        return $this->message;//(new CustomMessage())->messaggio($this->message);
    }  
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mslug = session()->get('mslug');
        $mid = session()->get('curmId');
        $m_setting = MissionSetting::where('slug', $mslug)->get()->first();
        $mission = null;
        if ($mid)
            $mission = Mission::find($mid);
        else
            $mission = Mission::find($m_setting->mission_id);
        if (app()->getLocale() == 'en')
            return  (new MailMessage)->subject($mission->name)->view('emails.notify',['text'=>$this->message,'mission'=>$mission]);                
        else
            return  (new MailMessage)->subject($mission->name_ar)->view('emails.notify',['text'=>$this->message,'mission'=>$mission]); 
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}