<?php
namespace App\Trails;


/**
 * summary
 */
trait MailTrait
{
    /**
     * summary
     */
   	public function initMailConfig(){

        $email = getOptions('smtp-config', '', true);

        config()->set('mail.from.name',strlen(@$email['name']) ? $email['name'] : config('mail.from.name'));
        config()->set('mail.from.address',filter_var(@$email['username'],FILTER_VALIDATE_EMAIL) ? $email['username'] : config('mail.username'));
        config()->set('mail.username',filter_var(@$email['username'],FILTER_VALIDATE_EMAIL) ? $email['username'] : config('mail.username'));
        config()->set('mail.password',strlen(@$email['password']) ? $email['password'] : config('mail.password'));
        config()->set('mail.host',strlen(@$email['host']) ? $email['host'] : config('mail.host'));
        config()->set('mail.port',strlen(@$email['port']) ? $email['port'] : config('mail.port'));
        config()->set('mail.encryption',strlen(@$email['encryption']) ? $email['encryption'] : config('mail.encryption'));
        config()->set('mail.driver',strlen(@$email['driver']) ? $email['driver'] : config('mail.driver'));

    }
}