<?
namespace RaStudio\Api;

require_once ($_SERVER['DOCUMENT_ROOT']."/local/modules/rastudio/lib/sms/sms.class.php");

use \RaStudio\Helper;

class LoggerAdapter
{
    public static function add($message) {
        $postString = json_encode([
            'text' => $message,
        ]);

        $ch = curl_init();

        $options = [
            CURLOPT_URL => 'https://hooks.slack.com/services/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',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
            CURLOPT_POSTFIELDS => $postString
        ];

        $options[CURLOPT_SSL_VERIFYHOST] = false;
        if (defined('CURLOPT_SAFE_UPLOAD')) {
            $options[CURLOPT_SAFE_UPLOAD] = true;
        }

        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
    }

    public static function addFile($message, $file = false) {

        if($file === false) {
            $filepath = ROOT_DIR."/logstandart.txt";
        } else {
            $filepath = ROOT_DIR.$file;
        }

        file_put_contents($filepath, $message);
    }

    public static function sendSms($phone = false, $message = false) {
        if($phone === false || empty($phone)) return false;
        if($message === false || empty($message)) return false;
        $phone = Helper::parsePhone($phone);
        $messages = new \Sms\Xml\Messages('Fsknwsms', 'fsk123');
        $messages->setUrl('https://sms.targetsms.ru');
        $mes = $messages->createNewMessage('FSKNW', $message, 'sms');
        $abonent = $mes->createAbonent($phone);
        $abonent->setNumberSms(0);
        $mes->addAbonent($abonent);
        $messages->addMessage($mes);
        return $messages->send();
    }

}
